<!-- 6.1.5 Sidebar overlay for lightbox effect -->
<div class="sidebar-overlay"></div>

<footer class="mc-footer">
    <div class="container">
        <div class="mc-footer__center">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/2025/logo_marcaChile_blanco.svg"
                alt="Marca Chile" class="mc-footer__logo">
        </div>

        <div class="mc-footer__inner">

            <div class="mc-footer__left">
                <a href="https://www.marcachile.cl" class="mc-footer__link" target="_blank">Ir a Marca Chile</a>
                <span class="mc-footer__divider"></span>
                <a href="/toolkit/politica-de-privacidad/" class="mc-footer__link">Política de Privacidad</a>
            </div>

            <div class="mc-footer__right">
                Copyright: © 2026 Marca Chile
            </div>

        </div>
    </div>
</footer>

<!-- Section 5 - Modals -->
<!-- Search Modal -->
<div class="modal fade marca-chile-modal-searchbar" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <a class="navbar-brand" href="index.html">
                    <span class="navbar-brand-logo"></span>
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid h-100">
                    <div class="row h-100">
                        <div class="col-md-10 d-flex m-auto">
                            <div class="marca-chile-form-searchbar__input">

                                <form id="searchform" action="<?php echo esc_url( home_url() ); ?>" method="get"
                                    onblur="if (this.value == '') {this.value = 'Buscar por...';}"
                                    onfocus="if (this.value == 'Buscar por...') {this.value = '';}">


                                    <input type="text" class="form-control" name="s" id="inputSearch"
                                        placeholder="Buscar por...">

                                    <input type="hidden" name="post_type" value="toolkit">

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>

</html>