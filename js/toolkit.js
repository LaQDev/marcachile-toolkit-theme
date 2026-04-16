document.addEventListener("DOMContentLoaded", function () {
  // Variable para mantener el estado de las clases agregadas
  var isCollapsed = false;

  // Función para agregar la clase "sidebar-toolkit-mob-collapse" a todos los elementos "sidebar-toolkit-mob-link" que no tienen la clase "active"
  function collapseLinks() {
    var links = document.querySelectorAll(".sidebar-toolkit-mob-link:not(.active)");
    links.forEach(function (link) {
      link.classList.add("sidebar-toolkit-mob-collapse");
    });
  }

  // Función para eliminar la clase "sidebar-toolkit-mob-collapse" de los elementos "sidebar-toolkit-mob-link"
  function uncollapseLinks() {
    var links = document.querySelectorAll(".sidebar-toolkit-mob-link");
    links.forEach(function (link) {
      link.classList.remove("sidebar-toolkit-mob-collapse");
      link.classList.remove("show"); // Eliminar la clase "show" también
    });
  }


  // 6.1.5 Sidebar overlay for lightbox effect
  var overlay = document.querySelector(".sidebar-overlay");

  // Agregar un event listener de clic al sidebar toggle
  var sidebarToggle = document.querySelector(".sidebar-toolkit-mob-toggle");
  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", function () {
      if (!isCollapsed) {
        collapseLinks();
        isCollapsed = true;
        // Show overlay
        if (overlay) overlay.classList.add("active");
      } else {
        uncollapseLinks();
        isCollapsed = false;
        // Hide overlay
        if (overlay) overlay.classList.remove("active");
      }
    });
  }

  // Close sidebar when clicking overlay (6.1.5)
  if (overlay) {
    overlay.addEventListener("click", function () {
      uncollapseLinks();
      isCollapsed = false;
      overlay.classList.remove("active");
      // Also uncheck the burger toggle
      var burgerToggle = document.querySelector(".burger__toggle");
      if (burgerToggle) burgerToggle.checked = false;
    });
  }

// Agregar event listeners a los subelementos
var toggles = document.querySelectorAll(".sidebar-toolkit-show-toggle");
toggles.forEach(function (toggle) {
  toggle.addEventListener("click", function (event) {
    event.stopPropagation(); // Evitar que el clic se propague a elementos superiores

    // Obtener el elemento padre (el div con clase "sidebar-toolkit-mob-link")
    var link = toggle.closest(".sidebar-toolkit-mob-link");

    // Buscar el div con clase "sidebar-toolkit-mob-link-wrap" dentro del elemento padre
    var linkWrap = link.querySelector(".sidebar-toolkit-mob-link-wrap");

    // Verificar si se encontró el div interior y agregar/eliminar la clase "show" en consecuencia
    if (linkWrap) {
      link.classList.toggle("show");
    }
  });
});

});


function initFlags(){
jQuery(function($){

    $('.lang-select').each(function(){

        var $select  = $(this);
        var $options = $select.find('.lang-select__option');
        var $current = $select.find('.lang-select__current');
        var $hidden  = $select.find('input[type="hidden"]');

        function setCurrent($option){

          var value = $option.data('value');
          var label = $option.data('label');
          var flag  = $option.data('flag');

          // 👉 actualizar UI
          $current.html(
            '<img src="' + flag + '" alt="' + label + '" class="lang-select__flag">' +
            '<span>' + label + '</span>'
          );

          // 👉 hidden
          if($hidden.length){
            $hidden.val(value);
          }

          // 👉 tu lógica de formularios
          $option.closest(".foto-link-descarga").find("form").hide();
          $("#FormID"+value).show();
        }

        // 🔥 INIT: tomar activo o primero
        var $active = $options.filter('.is-active');

        if(!$active.length){
          $active = $options.first().addClass('is-active');
        }

        setCurrent($active);

        // 👉 abrir / cerrar
        $select.find('.lang-select__trigger').on('click', function(e){
          e.stopPropagation();
          $('.lang-select').not($select).removeClass('is-open');
          $select.toggleClass('is-open');
        });

        // 👉 seleccionar opción
        $options.on('click', function(){

          var $option = $(this);

          $options.removeClass('is-active');
          $option.addClass('is-active');

          setCurrent($option);

          $select.removeClass('is-open');
        });

    });
});
}

jQuery(function($){

  initFlags();

  // 👉 cerrar al hacer click fuera
  $(document).on('click', function(){
    $('.lang-select').removeClass('is-open');
  });

});

jQuery(function ($) {

  $('.imgLiquid').each(function(){
      var src = $(this).find('img.imgLiquid').attr('src');
      $(this).css('backgroundImage', 'url('+src+')');
      $(this).find('img.imgLiquid').remove();
  });

  $("#iralregistro").click(function(e){
    e.preventDefault();
    $(".login-card#login").hide();
    $(".login-card#registro").fadeIn("normal");
  });

  $("#irallogin").click(function(e){
    e.preventDefault();
    $(".login-card#registro").hide();
    $(".login-card#login").fadeIn("normal");
  }); 

  $('#toolkit-login-form').on('submit', function (e) {
    e.preventDefault();

    var $btn = $('#toolkit-login-form #tk_submit');
    const originalText = $btn.text();
    var $msg = $('#tk_msg');
    var nonce = $("#tk_nonce").val();

    $msg.hide().removeClass('ok error');
    $btn.prop('disabled', true).addClass("is-loading");

    $.ajax({
      url: marcachile_ajax.ajax_url,
      type: 'POST',
      dataType: 'json',
      data: {
        action: 'toolkit_login',
        security: nonce,
        log: $('#toolkit-login-form #tk_user').val(),
        pwd: $('#toolkit-login-form #tk_pass').val(),
        rememberme: $('#tk_remember').is(':checked') ? 1 : 0
      }
    })
      .done(function (resp) {
        if (resp.success) {
          // redirigir al perfil toolkit o a donde tú quieras
          window.location.href = resp.data.redirect;
        } else {
          $msg
            .text(resp.data || 'Usuario o contraseña incorrectos.')
            .addClass('error')
            .show();

            $btn.removeClass('is-loading');
            $btn.text(originalText);
        }
      })
      .fail(function () {
        $msg
          .text('Ocurrió un error al iniciar sesión, intenta nuevamente.')
          .addClass('error')
          .show();

          $btn.removeClass('is-loading');
          $btn.text(originalText);

      })
      .always(function () {
        $btn.prop('disabled', false);
      });

  });


    $('#toolkit-register-form').on('submit', function(e) {
        e.preventDefault();

        var $form   = $(this);
        var $btn    = $('#toolkit-register-form #tk_submit');
        var $msgBox = $('#tk_msg_registro');

        $msgBox.hide().removeClass('error success').html('');
        $btn.prop('disabled', true).addClass('is-loading'); // si tienes clase de loading

        $.ajax({
            url: marcachile_ajax.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: $form.serialize(),
            success: function(response) {

                if (response.success) {
                    $msgBox
                        .addClass('success')
                        .html(response.data.message || 'Registro exitoso.')
                        .show();

                    if (response.data.redirect) {
                        window.location.href = response.data.redirect;
                    }
                } else {
                    var html = '';
                    if (response.data && response.data.errors) {
                        html = response.data.errors.join('<br>');
                    } else {
                        html = 'Ocurrió un error inesperado. Intenta de nuevo.';
                    }

                    $msgBox
                        .addClass('error')
                        .html(html)
                        .show();
                }
            },
            error: function() {
                $msgBox
                    .addClass('error')
                    .html('Error de conexión, por favor inténtalo nuevamente.')
                    .show();
            },
            complete: function() {
                $btn.prop('disabled', false).removeClass('is-loading');
            }
        });

    });


    function validarPasswordLive() {
        let pass = $('#tk_pass').val();

        // Reglas
        let cantidad      = pass.length >= 8;
        let mayuscula     = /[A-Z]/.test(pass) && /[a-z]/.test(pass);
        let letraNumero   = /[a-zA-Z]/.test(pass) && /\d/.test(pass);

        // Cambia color para cada regla
        $('#goalcantidad').toggleClass('valid', cantidad).toggleClass('invalid', !cantidad);
        $('#goalmayuscula').toggleClass('valid', mayuscula).toggleClass('invalid', !mayuscula);
        $('#goalletranumero').toggleClass('valid', letraNumero).toggleClass('invalid', !letraNumero);
    }

    // Ejecutar en cada tecla
    $('#tk_pass').on('keyup blur', validarPasswordLive);

    function validarCoincidencia() {
        let pass1 = $('#tk_pass').val();
        let pass2 = $('#tk_pass2').val();

        let ok = pass1.length > 0 && pass1 === pass2;

        $('#goalcoinciden').toggleClass('valid', ok).toggleClass('invalid', !ok);
    }

    $('#tk_pass, #tk_pass2').on('keyup blur', validarCoincidencia);
    $('#tk_pass2').on('keyup blur', function(){
      $('#goalcoinciden').show();
    });


    // 6.3.2 CLICK EN PLAY → abrir video en modal lightbox
    $('.play-btn').on('click', function(e){
        e.preventDefault();
        let $btn = $(this);
        let video = $btn.siblings('video').get(0);

        if (!video) return;

        let videoSrc = $(video).find('source').attr('src');

        // Create/reuse video modal
        let $modal = $('#videoPreviewModal');
        if ($modal.length === 0) {
            $modal = $('<div class="modal fade" id="videoPreviewModal" tabindex="-1" aria-hidden="true">' +
                '<div class="modal-dialog modal-dialog-centered modal-lg">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                '</div>' +
                '<div class="modal-body">' +
                '<video id="modalVideo" controls autoplay style="width:100%;max-height:80vh;">' +
                '<source src="" type="video/mp4">' +
                '</video>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>');
            $('body').append($modal);

            // Stop video when modal closes
            $modal.on('hidden.bs.modal', function(){
                var mv = document.getElementById('modalVideo');
                if (mv) { mv.pause(); mv.currentTime = 0; }
            });
        }

        // Set the source and show
        var modalVideo = $modal.find('#modalVideo');
        modalVideo.find('source').attr('src', videoSrc);
        modalVideo.get(0).load();
        var bsModal = new bootstrap.Modal($modal.get(0));
        bsModal.show();
    });

    // CUANDO EL VIDEO TERMINA → mostrar play y resetear video
    $('video.video-item').on('ended', function(){
        let video = this;
        let $wrapper = $(this).parent();
        let $btn = $wrapper.find('.play-btn');

        video.currentTime = 0; // volver al inicio
        video.pause();

        $btn.fadeIn(200); // mostrar nuevamente el play
    });


    // ---------- ACTUALIZAR PERFIL ----------
    $('#tk_profile_form').on('submit', function(e){
        e.preventDefault();

        var $form = $(this);
        var $btn  = $('#tk_profile_submit');
        var $msg  = $('#tk_profile_msg');

        $msg.hide().removeClass('error success').html('');
        $btn.prop('disabled', true).addClass("is-loading");

        $.ajax({
            url: marcachile_ajax.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: $form.serialize(),
            success: function(resp){
                if(resp.success){
                    $msg.addClass('success').html(resp.data.message).show();
                } else {
                    var txt = (resp.data && resp.data.errors) ? resp.data.errors.join('<br>') : 'Error inesperado.';
                    $msg.addClass('error').html(txt).show();
                }
            },
            error: function(){
                $msg.addClass('error').html('Error de conexión. Intenta nuevamente.').show();
            },
            complete: function(){
                $btn.prop('disabled', false).removeClass("is-loading");
            }
        });
    });

    // ---------- GOALS LIVE NUEVA CONTRASEÑA ----------
    function validarGoalsPass() {
        var pass = $('#tk_new_pass').val();
        var pass2 = $('#tk_new_pass2').val();

        var okLen   = pass.length >= 8;
        var okCase  = /[a-z]/.test(pass) && /[A-Z]/.test(pass);
        var okMix   = /[a-zA-Z]/.test(pass) && /\d/.test(pass);
        var okMatch = pass.length > 0 && pass === pass2;

        $('#goal_pass_len').toggleClass('valid', okLen).toggleClass('invalid', !okLen);
        $('#goal_pass_case').toggleClass('valid', okCase).toggleClass('invalid', !okCase);
        $('#goal_pass_mix').toggleClass('valid', okMix).toggleClass('invalid', !okMix);
        $('#goal_pass_match').toggleClass('valid', okMatch).toggleClass('invalid', !okMatch);
    }

    $('#tk_new_pass, #tk_new_pass2').on('keyup blur', validarGoalsPass);

    // ---------- CAMBIAR CONTRASEÑA ----------
    $('#tk_password_form').on('submit', function(e){
        e.preventDefault();

        var $form = $(this);
        var $btn  = $('#tk_password_submit');
        var $msg  = $('#tk_password_msg');

        $msg.hide().removeClass('error success').html('');
        $btn.prop('disabled', true).addClass("is-loading");

        $.ajax({
            url: marcachile_ajax.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: $form.serialize(),
            success: function(resp){
                if(resp.success){
                    $msg.addClass('success').html(resp.data.message).show();
                    $('#tk_current_pass, #tk_new_pass, #tk_new_pass2').val('');
                    validarGoalsPass();
                } else {
                    var txt = (resp.data && resp.data.errors) ? resp.data.errors.join('<br>') : 'Error inesperado.';
                    $msg.addClass('error').html(txt).show();
                }
            },
            error: function(){
                $msg.addClass('error').html('Error de conexión. Intenta nuevamente.').show();
            },
            complete: function(){
                $btn.prop('disabled', false).removeClass("is-loading");
            }
        });
    });

    var pagina = 2;
    var url = window.location.pathname;
    var cargando = 0;
  
    $(window).scroll(function() {

        //console.log(parseInt(jQuery(window).height())+"---"+parseInt($(window).scrollTop()));
        //console.log(parseInt(jQuery(window).height()+$(window).scrollTop()) +"---"+ parseInt($(document).height()-100));

      if (jQuery(window).height()+$(window).scrollTop() >= $(document).height()-100 && cargando==0) {
          cargando = 1;
          
          jQuery("#loading_noticias").show();

            const params = new URLSearchParams(window.location.search);
            const palabra = params.get('palabra') || '';
                       
            let finalUrl = url + '?pagina=' + pagina + '&ajax=1';
            if (palabra && palabra.trim() !== '') {
                finalUrl += '&palabra=' + encodeURIComponent(palabra);
            }

            $.ajax({
            url: finalUrl, 
            type: 'GET',
            success: function(response){
                jQuery("#content_category").append(response);
                pagina = pagina + 1;
                jQuery("#loading_noticias").hide();
                cargando=0;

                initFlags();
            },
            error: function(xhr, status, error) {
                jQuery("#loading_noticias").remove();
                cargando=1;
            }

        });
            
            
      }
  });

});


