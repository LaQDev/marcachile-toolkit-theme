<?php
if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/ingresa' ) );
    exit;
}

get_header();
 
 

$term = get_queried_object(); 
global $wp;

 
?> 
 
 
 
    <section class="marca-chile-toolkit marca-chile-toolkit--padd">
        <div class="container-fluid px-0">
            <div class="row gx-6 mx-0">
                <div class="col-md-3 marca-chile-col-toolkit px-md-0 mb-4 ms-0 me-auto">
                    <?php get_template_part("sidebar");?>
       
                </div>
                <div class="col-md-9 marca-chile-col-toolkit pt-md-0 px-md-0 mb-4">
                    <div class="marca-chile-cover marca-chile-cover__img v-02 px-md-0">
                        <div class="marca-chile-cover__img-caption v-12">
                            <picture>
                                <img src="<?php echo get_field( 'iconotax', $term); ?>">
                            </picture>
                            <h2><?php echo get_queried_object()->name;?></h2>
                        </div>
                        <picture class="marca-chile-image__cover">
                            <source media="(max-width: 768px)"
                                srcset="<?php echo get_field('destacada', $term); ?>" />
                            <img src="<?php  echo get_field('destacada', $term);  ?>" alt="banner" />
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
                                        <p><?php echo get_queried_object()->name;?></p>
                                    </div>
                                    <div class="marca-chile-filter-wrap">
                                        <picture>
                                            <img src="<?php bloginfo('template_url'); ?>/images/ico/toolkit/ico-toolkit-filter-02.svg">
                                        </picture>
                                        <p>Filtrar por</p>
                                        <div class="marca-chile-filter-buttons">
	 
											
											
			                                            <a class="filtrolink <?php if( isset( $_GET["todo"] ) && $_GET["todo"] === "1" ): echo "active"; endif;?>" href="<?php echo esc_url( home_url( '/categorias/' . get_queried_object()->slug . '/?todo=1&cat=' . get_queried_object()->slug ) ); ?>">Todo</a>
											
                                        
											
										 
                                            <a class="filtrolink <?php if( isset( $_GET["temas"] ) && $_GET["temas"] === "sustentabilidad" ): echo "active"; endif;?>" href="<?php echo esc_url( home_url( '/categorias/' . get_queried_object()->slug . '/?temas=sustentabilidad&cat=' . get_queried_object()->slug ) ); ?>">Sustentabilidad</a>
										    
											
											 
							                <a class="filtrolink <?php if( isset( $_GET["temas"] ) && $_GET["temas"] === "democracia" ): echo "active"; endif;?>" href="<?php echo esc_url( home_url( '/categorias/' . get_queried_object()->slug . '/?temas=democracia&cat=' . get_queried_object()->slug ) ); ?>">Democracia</a>
											 
											
											 
											<a class="filtrolink <?php if( isset( $_GET["temas"] ) && $_GET["temas"] === "diversidad" ): echo "active"; endif;?>" href="<?php echo esc_url( home_url( '/categorias/' . get_queried_object()->slug . '/?temas=diversidad&cat=' . get_queried_object()->slug ) ); ?>">Diversidad</a>
											
											 
                                             
                                            <div class="effect"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  

					
					
				
                        <div class="row gx-6">
	<?php
	$count= 0;
	while ( have_posts() ) : the_post(); $count++;
 
	?>
							
							
    <div class="modal fade" id="modalFoto<?php echo $count;?>" tabindex="-1" aria-labelledby="modalFoto<?php echo $count;?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="marca-chile-card-toolkit-foto-modal">
                        <picture class="foto-modal">
                            <img class="w-100" src="<?php $imagen_ppal = get_field('imagen_principal', get_the_ID()); echo esc_url( $imagen_ppal["url"] ); ?>">
                        </picture>
                    </div>
                </div>
            </div>
        </div>
    </div>
                            <div class="col-md-4 marca-chile-filt-box-toolkit">
								
								<?php if (!empty(get_field( 'video_preview'))):?>
                                <div class="marca-chile-card-toolkit-video">
                                    <picture class="video-ico" id="videoIcon<?php echo $count;?>">
                                        <img src="<?php bloginfo('template_url'); ?>/images/ico/toolkit/ico-toolkit-content-04.svg" alt="">
                                    </picture>
                                    <video id="myVideo<?php echo $count;?>">
                                        <source src="<?php the_field( 'video_preview'); ?>" type="video/mp4">
                                        Your browser does not support HTML5 video.
                                    </video>
                                </div>
                                <div class="marca-chile-card-toolkit-video-box">
                                    <p><?php echo the_title();?></p>
                                    <span></span>
                                    <div class="video-link">
                                        <div class="video-link-descarga">
 
											
						<?php if( have_rows('datos_archivos') ): ?>
											
                                            <picture class="video-ico">
                                                <img src="<?php bloginfo('template_url'); ?>/images/ico/toolkit/ico-toolkit-content-01.svg" alt="">
                                            </picture>			
											
						<?php while( have_rows('datos_archivos') ): the_row(); ?>
						<?php $datos_archivos = get_sub_field( 'ruta_de_archivo', get_the_ID());?>
                        
											
											
<?php
$url = esc_url( home_url( '/wp-json/wp/v2/descargar?video=' . get_the_ID() ) );
?>							

<form action="" method="post">
	<input type="hidden" name="archivo" value="<?php echo esc_attr( get_sub_field( 'ruta_de_archivo', get_the_ID()) ); ?>">
	<input type="hidden" name="archivosize" value="<?php echo esc_attr( get_sub_field( 'peso', get_the_ID()) ); ?>">
	<input type="hidden" name="nombre" value="<?php echo esc_attr( get_sub_field( 'nombre_archivo', get_the_ID()) ); ?>">
	 <?php wp_nonce_field( 'descargar', 'my_nonce' ); ?>
 
	
      <?php $user = get_current_user_id(); ?>
    <input type="hidden" name="userid" value="<?php echo absint( $user ); ?>">
	<input type="hidden" name="fecha" value="<?php echo date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ) );?>">
	
	<button type="submit" class="btn" style="padding-left: 0px;">
		Descargar
	</button>
</form>
											
				 

						<?php endwhile; ?>
					    <?php endif;?>		
											
				
				
                                        </div>
                                    </div>
                                </div>
								
							  <?php else:?>
								
								
                               <div class="marca-chile-card-toolkit-foto">
                                    <picture class="foto-ico">
                                        <img src="<?php bloginfo('template_url'); ?>/images/ico/toolkit/ico-toolkit-content-03.svg" alt="">
                                    </picture>
                                    <picture class="foto-thumbnail">
                                        <img class="w-100" src="<?php $imagen_ppal = get_field('imagen_principal', get_the_ID()); echo esc_url( $imagen_ppal["url"] ); ?>">
                                    </picture>
                                </div>
                                <div class="marca-chile-card-toolkit-foto-box">
                                    <p><?php echo the_title();?></p>
                                    <span> </span>
                                    <div class="foto-link">
                                        <div class="foto-link-descarga">
											<?php if(get_field("link_vermas", get_the_ID())){} else{?>
                                            <picture class="foto-ico">
                                                <img src="<?php bloginfo('template_url'); ?>/images/ico/toolkit/ico-toolkit-content-01.svg" alt="">
                                            </picture>
											<?php }?>
											
											
											
											
						<?php if( have_rows('datos_archivos') ): ?>
						<?php while( have_rows('datos_archivos') ): the_row(); ?>
											
<?php
$url = esc_url( home_url( '/wp-json/wp/v2/descargar?video=' . get_the_ID() ) );
?>							

<form action="" method="post">
	<input type="hidden" name="archivo" value="<?php echo esc_attr( get_sub_field( 'ruta_de_archivo', get_the_ID()) ); ?>">
	<input type="hidden" name="archivosize" value="<?php echo esc_attr( get_sub_field( 'peso', get_the_ID()) ); ?>">
	<input type="hidden" name="nombre" value="<?php echo esc_attr( get_sub_field( 'nombre_archivo', get_the_ID()) ); ?>">
	 <?php wp_nonce_field( 'descargar', 'my_nonce' ); ?>
 
	
      <?php $user = get_current_user_id(); ?>
    <input type="hidden" name="userid" value="<?php echo absint( $user ); ?>">
	<input type="hidden" name="fecha" value="<?php echo date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ) );?>">
	
	<button type="submit" class="btn" style="padding-left: 0px;">
		Descargar
	</button>
</form>
											

						<?php endwhile; ?>
					    <?php endif;?>		
											
											<?php if(get_field("link_vermas", get_the_ID())){?>
											 
											<a href="<?php echo the_field("link_vermas", get_the_ID());?>">Ver más</a>
											<?php } ?>	
                                        </div>
                     
                                    </div>
                                </div>
								

								
 
								
							 <?php endif;?>
						     </div>
 
              <?php
 
	 
				endwhile;
			?>
                             
<?php if ( function_exists( 'wp_pagenavi' ) ) { wp_pagenavi(); } ?>
     
                        </div>
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
 
 get_footer(); 
?> 