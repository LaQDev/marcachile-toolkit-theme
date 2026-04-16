document.addEventListener('DOMContentLoaded', function () {
    generateCarousel("#marcaChileCoverSliderMain", { arrows: false, paginationDirection: 'ttb' });
    // Accesibilidad...
    const btnOpen = document.getElementById("btnOpenAccessib");
    const showAccess = document.getElementById("showAccessib");
    const btnClose = document.getElementById("btnCloseAccessib");
    if (btnOpen && showAccess) btnOpen.addEventListener('click', () => showAccess.classList.toggle('open'));
    if (btnClose && showAccess) btnClose.addEventListener('click', () => showAccess.classList.remove('open'));
});

function generateCarousel(className, options) {
    let el = document.querySelector(className);
    if (el) new Splide(className, options).mount();
}

jQuery(document).ready(function ($) {

    // 1. Sidebar Toggle Mobile
    $(document).on("change", ".burger__toggle", function () {
        var $m = $("ul.sidebar-toolkit");
        if ($m.length === 0) $m = $("#menu-sidebar");
        if ($(this).is(":checked")) {
            $m.addClass("open").stop(true, true).slideDown(200);
            $('body').css('overflow', 'hidden');
        } else {
            $m.stop(true, true).slideUp(200, function () { $(this).removeClass("open").css('display', ''); });
            $('body').css('overflow', '');
        }
    });

    $(window).resize(function () {
        if ($(window).width() > 1024) {
            $("ul.sidebar-toolkit").css('display', '').removeClass("open");
            $(".burger__toggle").prop('checked', false);
            $('body').css('overflow', '');
        }
    });

    $(".sidebar-toolkit a").filter(function () { return this.href === document.location.href; }).parent().addClass("active");

    // 2. INFINITE SCROLL SIN INCEPTION
    var loading = false;
    $(window).scroll(function () {
        var $grid = $('#content_category');
        var $pagination = $('#pagination-hidden');

        if ($grid.length && $pagination.length && !loading) {
            var hT = $grid.offset().top, hH = $grid.outerHeight(), wH = $(window).height(), wS = $(this).scrollTop();

            if (wS > (hT + hH - wH - 300)) {
                var nextLink = $pagination.find('a').attr('href');
                if (nextLink) {
                    loading = true;

                    $.ajax({
                        url: nextLink,
                        dataType: 'html',
                        success: function (data) {
                            var $data = $(data);
                            // BUSCAR DIRECTAMENTE LAS CARDS
                            var $newItems = $data.find('.marca-chile-filt-box-toolkit');
                            var $newPagination = $data.find('#pagination-hidden').html();

                            if ($newItems.length > 0) {
                                $grid.append($newItems); // Pegar cards
                                if ($newPagination && $newPagination.trim() !== "") {
                                    $pagination.html($newPagination);
                                } else {
                                    $pagination.empty();
                                }
                            } else {
                                $pagination.empty();
                            }
                            loading = false;
                        },
                        error: function () { loading = false; }
                    });
                }
            }
        }
    });

    // 3. Fix Modales
    $(document).on('hidden.bs.modal', '.modal', function () {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css({ 'padding-right': '', 'overflow': '' });
    });

    // 4. Validación Buscador
    $('form[name="search"]').on('submit', function (e) {
        var $input = $(this).find('input[name="s"]');
        if ($input.val().trim().length === 0) {
            e.preventDefault();
            $input.css('border-color', 'red');
        }
    });
    $('input[name="s"]').on('input', function () { $(this).css('border-color', ''); });
});