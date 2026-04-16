<?php
/* Template Name: Toolkit - Home (Todos) */
if (!is_user_logged_in()) {
    wp_redirect(home_url('/ingresa'));
    exit;
}

$thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
$paged = intval($_GET['pagina']);

get_header();
?>

<section class="marca-chile-toolkit marca-chile-toolkit--padd">
    <div class="container-fluid" id="content">
        <div class="row">
            <div class="marca-chile-col-toolkit">
                <?php get_template_part("sidebar"); ?>
            </div>
            <div class="marca-chile-col-toolkit">
                <div class="marca-chile-cover marca-chile-cover__img v-02">
                    <div class="marca-chile-cover__img-caption v-12">
                        <h2><?php the_title(); ?></h2>
                    </div>
                    <picture class="marca-chile-image__cover">
                        <?php 
                        // El primer parámetro es el ID del post (null para el actual) y el segundo es el tamaño ('full')
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); 
                        ?>
                        <img src="<?php echo esc_url($thumb_url); ?>" alt="banner">
                    </picture>
                </div>

                <div class="marca-chile-toolkit-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <form name="search" method="get" action="<?php echo esc_url(home_url('/')); ?>/buscador">
                                <div class="toolkit-search">
                                    <label class="toolkit-search__label" for="s">Buscar</label>
                                    <div class="toolkit-search__row">
                                        
                                        <input id="palabra" name="palabra" type="search" class="toolkit-search__input"
                                            placeholder="Buscar...">
                                        <button class="toolkit-search__btn" type="submit"><svg width="18" height="18"
                                                fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <circle cx="8" cy="8" r="6"></circle>
                                                <line x1="13" y1="13" x2="17" y2="17"></line>
                                            </svg></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                            $terms = get_terms(array(
                                'taxonomy'   => 'categorias', // cambia esto por el slug real de tu taxonomía
                                'hide_empty' => true,
                            ));

                            if (!is_wp_error($terms) && !empty($terms)) {
                            foreach ($terms as $term) {

                                $query = new WP_Query(array(
                                    'post_type'      => 'toolkit',
                                    'posts_per_page' => 1,
                                    'orderby'        => 'date',
                                    'order'          => 'DESC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'categorias',
                                            'field'    => 'term_id',
                                            'terms'    => $term->term_id,
                                        ),
                                    ),
                                ));

                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();

                                        $post_id = get_the_ID();
                                        $img_url = get_field('imagen_principal')['url'] ?? '';
                                ?>
                                <div class="modal fade" id="modalFoto<?php echo $post_id; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header"><button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button></div>
                                            <div class="modal-body">
                                                <picture class="foto-modal"><img class="w-100"
                                                        src="<?php echo esc_url($img_url); ?>"></picture>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col marca-chile-filt-box-toolkit">
                                    <div class="marca-chile-card-toolkit-foto">
                                        <picture class="foto-ico">
                                            <?php $terms = get_the_terms($post_id, 'categorias');
                                            if ($terms)
                                                foreach ($terms as $t)
                                                    echo "<span>" . esc_html($t->name) . "</span>"; ?>
                                        </picture>
                                        <div class="media-wrapper">
                                            <?php if (get_field('video_preview')): ?>
                                                <video class="video-item" muted>
                                                    <source src="<?php the_field('video_preview'); ?>" type="video/mp4">
                                                </video>
                                                <div class="media-overlay play-btn"><img
                                                        src="<?php echo esc_url(get_template_directory_uri()); ?>/images/2025/icon-play.svg">
                                                </div>
                                            <?php else: ?>
                                                <picture class="foto-thumbnail"><img src="<?php echo esc_url($img_url); ?>">
                                                </picture>
                                                <div class="media-overlay zoom-btn"><a href="" class="previsualizar"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalFoto<?php echo $post_id; ?>"><img
                                                            src="<?php echo esc_url(get_template_directory_uri()); ?>/images/2025/icon-lupa.svg"></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="marca-chile-card-toolkit-foto-box">
                                        <p><?php the_title(); ?></p>
                                                                            <div class="foto-link">
                                        <div class="foto-link-descarga">
                                           
                                            <div class="lang-select" id="langSelect">
                                                <button type="button" class="lang-select__trigger">
                                                  <span class="lang-select__current"></span>
                                                  <span class="lang-select__arrow">▾</span>
                                                </button>

                                              <div class="lang-select__dropdown">

                                                <?php 
                                                $iterador = 0;
                                                if( have_rows('datos_archivos') ): 
                                                while( have_rows('datos_archivos') ): the_row(); ++$iterador; 

                                                $idioma = get_sub_field( 'idioma', get_the_ID());

                                                if($idioma=="ES"){
                                                    $flag = esc_url(get_template_directory_uri())."/images/icon-chile.svg";
                                                    $value = "ES";
                                                }
                                                if($idioma=="EN"){
                                                    $flag = esc_url(get_template_directory_uri())."/images/icon-eng.svg";
                                                    $value = "EN";
                                                }
                                                if($idioma=="PT"){
                                                    $flag = esc_url(get_template_directory_uri())."/images/icon-br.svg";
                                                    $value = "PT";
                                                }

                                                ?>

                                                <div class="lang-select__option is-active" data-value="<?php the_ID();?>-<?php echo $iterador;?>" data-label="<?php echo $value;?>" data-flag="<?php echo $flag;?>">
                                                  <img src="<?php echo $flag;?>" alt="Español" class="lang-select__flag">
                                                  <span><?php echo $value;?></span>
                                                </div>
                                                <?php 
                                                endwhile;
                                                endif;
                                                ?>
                                                
                                              </div>

                                            </div>

                                            <?php 
                                            $iterador = 0;
                                            if( have_rows('datos_archivos') ): 
                                            while( have_rows('datos_archivos') ): the_row(); ++$iterador; 
                                            ?>
                                                                
                                                <?php
                                                $url = esc_url( home_url( '/wp-json/wp/v2/descargar?video=' . get_the_ID() ) );
                                                ?>                          

                                                <form id="FormID<?php the_ID();?>-<?php echo $iterador;?>" action="" method="post" <?php if($iterador>1){?>style="display: none;"<?php } ?>>
                                                    <input type="hidden" name="archivo" value="<?php echo esc_attr( get_sub_field( 'ruta_de_archivo', get_the_ID()) ); ?>">
                                                 
                                                    <input type="hidden" name="nombre" value="<?php echo esc_attr( get_the_title() ); ?>">
                                                     <?php wp_nonce_field( 'descargar', 'my_nonce' ); ?>
                                                 
                                                    
                                                      <?php  
                                                      $user = get_current_user_id();?>
                                                    <input type="hidden" name="userid" value="<?php echo absint( $user ); ?>">
                                                    <input type="hidden" name="fecha" value="<?php echo esc_attr( date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ) ) ); ?>">
                                                    
                                                    <button type="submit" class="btn-descarga">
                                                        Descargar
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 16L7 11L8.4 9.55L11 12.15V4H13V12.15L15.6 9.55L17 11L12 16ZM6 20C5.45 20 4.979 19.804 4.587 19.413C4.196 19.021 4 18.55 4 18V15H6V18H18V15H20V18C20 18.55 19.804 19.021 19.413 19.413C19.021 19.804 18.55 20 18 20H6Z" fill="white"/></svg>
                                                    </button>
                                                </form>
                                                                

                                            <?php endwhile; ?>
                                            <?php endif;?>      
                                            
                                            <?php if(get_field("link_vermas", get_the_ID())){?>
                                             
                                            <a target="_blank" class="previsualizar" href="<?php echo esc_url( get_field("link_vermas", get_the_ID()) ); ?>">Ver más</a>
                                            <?php } ?>  
                                        </div>
                                        
                            
                                    </div>
                                    </div>
                                </div>
                             <?php
                                }
                            }
                        }
                    }
                    ?>
                    </div>

                    <div id="pagination-hidden" style="display:none;">
                        <?php
                        echo paginate_links(array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'format' => '?paged=%#%',
                            'current' => max(1, $paged),
                            'total' => $query->max_num_pages,
                            'prev_text' => '',
                            'next_text' => 'Siguiente'
                        ));
                        ?>
                    </div>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer();  ?>