<?php
$is_ajax = isset( $_GET["ajax"] ) && absint( $_GET["ajax"] ) === 1;

if ( ! is_user_logged_in() ) {
	wp_redirect( home_url( '/ingresa' ) );
	exit;
}

$term = get_queried_object();
global $wp;

$palabra = sanitize_text_field($_GET['palabra']);


if ( ! $is_ajax ) {
get_header();
 

?> 
 

    <section class="marca-chile-toolkit marca-chile-toolkit--padd">
        <div class="container-fluid" id="content">
            <div class="row">
                <div class="marca-chile-col-toolkit">
                    <?php get_template_part("sidebar");?>

                </div>
                <div class="marca-chile-col-toolkit">
                    <div class="marca-chile-cover marca-chile-cover__img marca-chile-cover__img--internal v-02">

                        <div class="marca-chile-cover__img-caption v-12">
                            <!--<div class="pathway">
                                Inicio > <strong><?php echo esc_html( get_queried_object()->name ); ?></strong>
                            </div>-->

                            <div class="hero-title-row">
                                <?php
                                $icon_url = get_field( 'iconotax', $term );
                                if ( $icon_url ) : ?>
                                    <picture>
                                        <img src="<?php echo esc_url( $icon_url ); ?>" alt="">
                                    </picture>
                                <?php endif; ?>
                                <h2><?php echo esc_html( get_queried_object()->name ); ?></h2>
                            </div>
                        </div>
                        <picture class="marca-chile-image__cover">
                            <source media="(max-width: 768px)"
                                srcset="<?php echo esc_url( get_field('destacada', $term) ); ?>" />
                            <img src="<?php echo esc_url( get_field('destacada', $term) ); ?>" alt="banner" />
                        </picture>
                    </div>
                    <div class="marca-chile-toolkit-wrap">
                        <div class="row">
                            <div class="col-md-12">

                            	<form name="search" id="search" method="get" action="">
                            		<div class="toolkit-search">
                                        <label class="toolkit-search__label" for="s-archive">Buscar</label>
                                        <div class="toolkit-search__row">
                                            
                                            
                                            <input id="s-archive" name="palabra"
                                                type="search"
                                                class="toolkit-search__input"
                                                placeholder="Buscar por palabra clave (ej: 'Cobre', 'Patagonia', 'Logo')..." 
                                                value="<?php echo $palabra;?>" 
                                            >
                                            <button class="toolkit-search__btn" type="submit">
                                                <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="8" cy="8" r="6"></circle>
                                                    <line x1="13" y1="13" x2="17" y2="17"></line>
                                                </svg>
                                            </button>
                                        </div>
								</div>
								</form>
                            </div>
                        </div>
                  
				 

<div class="row row-cols-1 row-cols-md-3 g-4" id="content_category">

	<?php
	}

	$count= 0;
	while ( have_posts() ) : the_post(); $count++;
 
	?>
							
							
						    <div class="modal fade" id="modalFoto<?php echo get_the_ID();?>" tabindex="-1" aria-labelledby="modalFoto<?php echo get_the_ID();?>Label" aria-hidden="true">
						        <div class="modal-dialog modal-dialog-centered">
						            <div class="modal-content">
						                <div class="modal-header">
						                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						                </div>
						                <div class="modal-body">
						                    <div class="marca-chile-card-toolkit-foto-modal">
						                        <picture class="foto-modal">
						                            <img class="w-100" src="<?php $imagen_ppal = get_field('imagen_principal', get_the_ID()); echo esc_url( $imagen_ppal["url"] );?>">
						                        </picture>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </div>

                            <div class="col marca-chile-filt-box-toolkit">
							
								
                               <div class="marca-chile-card-toolkit-foto">
                                    <picture class="foto-ico">
									    <?php 
									        $terms = get_the_terms( get_the_ID(), 'categorias' ); 
									        if($terms){
									            foreach($terms as $term) {
									                //echo "<span>" . esc_html( $term->name ) . "</span>";  
									            }
									        }
									    ?>
									</picture>

									<div class="media-wrapper">

									    <?php if ( get_field('video_preview') ) : ?>

									        <video id="myVideo<?php echo get_the_ID();?>" class="video-item" muted>
									            <source src="<?php the_field('video_preview'); ?>" type="video/mp4">
									            Your browser does not support HTML5 video.
									        </video>

									        <!-- ICONO PLAY -->
									        <div class="media-overlay play-btn">
									            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/2025/icon-play.svg">
									        </div>

									    <?php else : ?>

									        <picture class="foto-thumbnail">
									            <img class="w-100" src="<?php echo esc_url( get_field('imagen_principal')['url'] ); ?>">
									        </picture>

									        <!-- ICONO LUPA -->
									        <div class="media-overlay zoom-btn">
									        	<a href="" class="previsualizar" data-bs-toggle="modal" data-bs-target="#modalFoto<?php echo get_the_ID();?>">
									            	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/2025/icon-lupa.svg">
									        	</a>
									        </div>

									    <?php endif; ?>

									</div>

 
                                </div>
                                <div class="marca-chile-card-toolkit-foto-box">
                                    <p><?php echo the_title();?></p>
										
				
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

                                                <div class="lang-select__option <?php if($iterador==1){ echo "is-active"; } ?>" data-value="<?php the_ID();?>-<?php echo $iterador;?>" data-label="<?php echo $value;?>" data-flag="<?php echo $flag;?>">
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
endwhile;
if ( ! $is_ajax ) {
			?>
                 </div>

            <center id="loading_noticias" style="display:none">
            	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/2025/load.gif"> Cargando...
          	</center>
     
                       
				   </div>
						
					
                </div>
            </div>
        </div>
    </section>
		 		
<?php 
if ( ! empty( $_POST["archivo"] ) && ! empty( $_POST["my_nonce"] ) && wp_verify_nonce( $_POST["my_nonce"], 'descargar' ) ):
	$archivo_raw = sanitize_text_field( $_POST["archivo"] );
	$userid_raw  = absint( $_POST["userid"] );
	$nombre_raw  = sanitize_text_field( $_POST["nombre"] );
	$fecha_raw   = sanitize_text_field( $_POST["fecha"] );

	$filename = "https://s3.amazonaws.com/cdn.marcachile2.redon.cl/" . rawurlencode( $archivo_raw );
	?>
	   <script>
	         window.open(<?php echo wp_json_encode( $filename ); ?>, "_blank");
	   </script>
	<?php
	global $wpdb;
	$wpdb->insert(
		"toolkit_descargas",
		array(
			"id_usuario"     => $userid_raw,
			"archivo_zip"    => $nombre_raw,
			"fecha_registro" => $fecha_raw,
			"ruta_archivo"   => $archivo_raw,
		),
		array( '%d', '%s', '%s', '%s' )
	);
endif;
}
if ( ! $is_ajax ) {
 get_footer(); 
}
?> 