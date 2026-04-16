<?php

/* 
Template Name: Pagina Manual 2
*/
get_header();

?>



<!-- Section 4 - Contenido -->
<section class="marca-chile-toolkit marca-chile-toolkit--padd">
    <div class="container-fluid px-0">
        <div class="row gx-6 mx-0">

            <div class="col-md-3 marca-chile-col-toolkit px-md-0 mb-4 ms-0 me-auto">

                <?php get_template_part("sidebar"); ?>


            </div>



            <div class="col-md-9 marca-chile-col-toolkit pt-md-0 px-md-0 mb-4">
                <div class="marca-chile-cover marca-chile-cover__img v-02 px-md-0">
                    <div class="marca-chile-cover__img-caption v-12">
                        <picture>
                            <img src="<?php the_field("iconopagina"); ?>">
                        </picture>
                        <h2><?php the_title(); ?></h2>
                    </div>
                    <picture class="marca-chile-image__cover">
                        <source media="(max-width: 768px)" srcset="<?php the_field("bannerpagina"); ?>" />
                        <img src="<?php the_field("bannerpagina"); ?>" alt="banner" />
                    </picture>
                </div>
                <div class="marca-chile-toolkit-wrap">
                    <div class="row gx-6">
                        <div class="col-md-12">
                            <div class="marca-chile-filter">
                                <div class="marca-chile-filter-title">
                                    <picture>
                                        <img src="<?php bloginfo('template_url'); ?>/images/ico/toolkit/ico-toolkit-filter-01.svg">
                                    </picture>
                                    <p><?php the_title(); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-6">
                        <div class="col-md-4">

                            <div class="marca-chile-card-toolkit-foto">
                                <picture class="foto-thumbnail">
                                    <img class="w-100" src="<?php the_field("insumo_preview"); ?>">
                                </picture>
                            </div>


 
                            <div class="marca-chile-card-toolkit-foto-box">
                                <p><?php the_field("descripcion_insumo"); ?></p>
                                <h6><?php the_field("insumopagina"); ?></h6>
                                <div class="foto-link">
                                    <div class="foto-link-descarga">
                                        <picture class="foto-ico">
                                            <img src="<?php bloginfo('template_url'); ?>/images/ico/toolkit/ico-toolkit-content-01.svg" alt="">
                                        </picture>
                                        <a href="<?php the_field("descargapagina"); ?>">Descargar</a>
                                    </div>
                                </div>
                            </div>


                        </div>





                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php


get_footer();

?>