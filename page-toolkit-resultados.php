<?php
/* Template Name: Toolkit - Resultados */

if (!is_user_logged_in()) {
    wp_redirect(home_url('/ingresa'));
    exit;
}

get_header();
the_post();

$paged = (get_query_var('paged')) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
$current_page_id = get_the_ID();
$current_slug = $post->post_name; // El slug de la página define la categoría (ej: videos, fotografias)
?>

<section class="marca-chile-toolkit marca-chile-toolkit--padd">
    <div class="container-fluid" id="content">
        <div class="row">
            <div class="col-md-3 marca-chile-col-toolkit px-md-0 mb-4 ms-0 me-auto">
                <?php get_template_part("sidebar"); ?>
            </div>

            <div class="col-md-9 marca-chile-col-toolkit pt-md-0 px-md-0 mb-4">

                <div class="marca-chile-cover marca-chile-cover__img v-02 px-md-0">
                    <div class="marca-chile-cover__img-caption v-12">
                        <picture>
                            <img src="<?php echo isset($image['url']) ? esc_url($image['url']) : ''; ?>">
                        </picture>
                        <h2><?php the_title(); ?></h2>
                    </div>
                    <picture class="marca-chile-image__cover">
                        <source media="(max-width: 768px)"
                            srcset="<?php bloginfo('template_url'); ?>/images/picture/toolkit/toolkit-galeria-02-280x280.png" />
                        <img src="<?php bloginfo('template_url'); ?>/images/picture/toolkit/toolkit-galeria-02-banner.png"
                            alt="banner" />
                    </picture>
                </div>

                <div class="marca-chile-toolkit-wrap">

                    <div class="row">
                        <div class="col-md-12">
                            <form name="search" id="search" method="get"
                                action="<?php echo esc_url(home_url('/')); ?>">
                                <div class="toolkit-search">
                                    <label class="toolkit-search__label" for="s">Buscar en <?php the_title(); ?></label>
                                    <div class="toolkit-search__row">
                                        <input type="hidden" name="post_type" value="toolkit">

                                        <input type="hidden" name="source_id"
                                            value="<?php echo esc_attr($current_page_id); ?>">

                                        <input type="hidden" name="cat_filter"
                                            value="<?php echo esc_attr($current_slug); ?>">

                                        <input id="s" name="s" type="search" class="toolkit-search__input" value=""
                                            placeholder="Buscar en esta categoría...">

                                        <button class="toolkit-search__btn" type="submit">
                                            <svg width="18" height="18" fill="none" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="8" cy="8" r="6"></circle>
                                                <line x1="13" y1="13" x2="17" y2="17"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="search-alert-msg"
                                        style="display:none; color: #E4032C; font-size: 1.4rem; margin-top: 1rem;">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row g-4 mt-4" id="content_category">
                        <?php
                        // Detectar Idioma (Igual que en search.php)
                        $lang = 'ES';
                        if (function_exists('weglot_get_current_language')) {
                            $wg = weglot_get_current_language();
                            $map = ['es' => 'ES', 'en' => 'EN', 'pt' => 'PT'];
                            $lang = $map[$wg] ?? 'ES';
                        }

                        // Consulta Principal de la Categoría
                        $args = [
                            'post_type' => 'toolkit',
                            'posts_per_page' => 15,
                            'paged' => $paged,
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'tax_query' => [
                                [
                                    'taxonomy' => 'categorias',
                                    'field' => 'slug',
                                    'terms' => $current_slug,
                                ]
                            ],
                            'meta_query' => [
                                [
                                    'key' => 'datos_archivos_0_idioma',
                                    'value' => $lang,
                                    'compare' => '='
                                ]
                            ]
                        ];

                        $query = new WP_Query($args);

                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $post_id = get_the_ID();
                                $img_url = get_field('imagen_principal')['url'] ?? '';
                                ?>

                                <div class="modal fade" id="modalResult<?php echo $post_id; ?>" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="marca-chile-card-toolkit-foto-modal">
                                                    <picture class="foto-modal">
                                                        <img class="w-100" src="<?php echo esc_url($img_url); ?>">
                                                    </picture>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 marca-chile-filt-box-toolkit">
                                    <div class="marca-chile-card-toolkit-foto">
                                        <picture class="foto-ico">
                                            <?php
                                            // Badge Correcto: Categoría
                                            $terms = get_the_terms($post_id, 'categorias');
                                            if ($terms && !is_wp_error($terms)) {
                                                foreach ($terms as $term) {
                                                    echo "<span>" . esc_html($term->name) . "</span>";
                                                }
                                            }
                                            ?>
                                        </picture>
                                        <div class="media-wrapper">
                                            <?php if (get_field('video_preview')): ?>
                                                <video class="video-item" muted>
                                                    <source src="<?php the_field('video_preview'); ?>" type="video/mp4">
                                                </video>
                                                <div class="media-overlay play-btn">
                                                    <img
                                                        src="<?php echo esc_url(get_template_directory_uri()); ?>/images/2025/icon-play.svg">
                                                </div>
                                            <?php else: ?>
                                                <picture class="foto-thumbnail">
                                                    <img src="<?php echo esc_url($img_url); ?>"
                                                        alt="<?php echo esc_attr(get_the_title()); ?>">
                                                </picture>
                                                <div class="media-overlay zoom-btn">
                                                    <a href="" class="previsualizar" data-bs-toggle="modal"
                                                        data-bs-target="#modalResult<?php echo $post_id; ?>">
                                                        <img
                                                            src="<?php echo esc_url(get_template_directory_uri()); ?>/images/2025/icon-lupa.svg">
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="marca-chile-card-toolkit-foto-box">
                                        <p><?php echo get_the_title(); ?></p>
                                        <div class="foto-link">
                                            <div class="foto-link-descarga">
                                                <?php if (have_rows('datos_archivos')):
                                                    while (have_rows('datos_archivos')):
                                                        the_row();
                                                        $ruta = get_sub_field('ruta_de_archivo');
                                                        if (!$ruta)
                                                            continue;
                                                        ?>
                                                        <form action="" method="post" target="_blank">
                                                            <input type="hidden" name="archivo"
                                                                value="<?php echo esc_attr($ruta); ?>">
                                                            <input type="hidden" name="nombre"
                                                                value="<?php echo esc_attr(get_the_title()); ?>">
                                                            <input type="hidden" name="my_nonce"
                                                                value="<?php echo wp_create_nonce('descargar'); ?>">
                                                            <input type="hidden" name="userid"
                                                                value="<?php echo absint(get_current_user_id()); ?>">

                                                            <button type="submit" class="btn-descarga">
                                                                Descargar
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 16L7 11L8.4 9.55L11 12.15V4H13V12.15L15.6 9.55L17 11L12 16ZM6 20C5.45 20 4.979 19.804 4.587 19.413C4.196 19.021 4 18.55 4 18V15H6V18H18V15H20V18C20 18.55 19.804 19.021 19.413 19.413C19.021 19.804 18.55 20 18 20H6Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    <?php endwhile; endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<div class="col-12"><p>No se encontraron recursos en esta categoría.</p></div>';
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

<?php
// Lógica de descarga Legacy (por si acaso falla el hook de init, aunque el form usa target blank)
if (!empty($_POST["archivo"]) && !empty($_POST["my_nonce"]) && wp_verify_nonce($_POST["my_nonce"], 'descargar')):
    $archivo_raw = sanitize_text_field($_POST["archivo"]);
    $filename = "https://s3.amazonaws.com/cdn.marcachile2.redon.cl/" . rawurlencode($archivo_raw);
    ?>
    <script>window.open(<?php echo wp_json_encode($filename); ?>, "_blank");</script>
    <?php
endif;

get_footer();
?>