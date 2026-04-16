<?php


get_header();

?>



<section class="marca-chile-cover marca-chile-cover__img v-02">
    <div class="container-fluid px-0">
        <div class="row mx-0">
            <div class="col px-0">
                <div class="marca-chile-cover__img-caption v-08">
                    <h1>404</h1>
                    <h3><span>Aquí no hay nada</span></h3>
                    <p>La página que buscas no existe</p>
                    <div class="marca-chile-form-portal">
                        <div class="marca-chile-form-portal__button">
                            <a href="<?php bloginfo('url'); ?>" class="btn">Volver al inicio</a>
                        </div>
                    </div>
                </div>
                <picture class="marca-chile-image__cover v-03">
                    <source media="(max-width: 768px)" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/images/picture/banner-error-mobile.png">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/picture/banner-error-original.png" alt="banner">
                </picture>
            </div>
        </div>
    </div>
</section>


<?php


get_footer();

?>