<?php 
get_header('toolkit'); 
global $siteURL;  
global $themeURL; 
$categorias = get_terms( array(
    'taxonomy' => 'categorias',
    'hide_empty' => false,
) );  
/* Datos POost */ 
$post_id = $post->ID;
/*
echo "the post id ".$post->ID."<br />";  
*/

$autor = ucfirst(get_field( 'autor', $post->ID)); 
$licencia = ucfirst(get_field( 'licencia', $post->ID)); 
$medidas = ucfirst(get_field( 'medidas', $post->ID)); 
$formatos = ucfirst(get_field( 'formatos', $post->ID)); 
$datos_archivos = get_field( 'datos_archivos', $post->ID); 
$imagen_ppal = get_field( 'imagen_principal', $post->ID); 

if( empty($imagen_ppal["url"]) ) {
    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
} else {
    $thumbnail = [$imagen_ppal["url"]];
}

$fields = get_fields($post->ID);
// Campos accesibles via $fields['nombre_campo'] en vez de extract()

$temas_relacionados = get_the_terms( $post->ID, 'temas' );
$array_temas=array();
//$temas_relacionados = join(', ', wp_list_pluck($temas, 'name'));

$palabras_relacionadas = get_the_terms( $post->ID, 'palabras_relacionadas' );
$array_palabras=array();
//$palabras_relacionadas2 = join(', ', wp_list_pluck($palabras_relacionadas, 'name'));



$class_active="";
if ( defined('NOMBRE_SESSION') && defined('RAIZ_SESSION') && isset($_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['cart']) ) {
    if ( isset($_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['cart'][$post->ID]['cant']) ) {
        $class_active="activo";
    }
}


//echo "datos_archivos <br />";

$array_formatos=array(); 
$array_idiomas=array(); 
foreach ($datos_archivos AS $datos){ 

    // echo "ruta_de_archivo ".$datos['ruta_de_archivo']."<br />"; 
    // echo "idioma ".$datos['idioma']."<br />"; 

    if (!in_array($datos['formato'], $array_formatos)) {
        $array_formatos[]=$datos['formato']; 
    }      
    if (!in_array($datos['idioma'], $array_idiomas)) {
        $array_idiomas[]=$datos['idioma']; 
    }                      
}

/*
print "array_formatos <pre>"; 
print_r($array_formatos);
print "</pre>"; 

print "array_idiomas <pre>"; 
print_r($array_idiomas);
print "</pre>"; 
*/
?> 

<div class="banner-toolkit small">
         <?php  
        include ( get_template_directory() . '/toolkit/template-parts/header-carrito.php' );
        ?>  
    <div class="carrusel">
        <div class="c-toolkit">
            <div class="item">
                <img src="<?php echo $themeURL; ?>/images/toolkit/banner4.jpg"  alt="Toolkit | Marca Chile">
            </div>
        </div>
    </div>
    <?php 
    include ( get_template_directory() . '/toolkit/template-parts/selectores.php');  
    ?>  
</div>

<section class="interior-toolkit pb-small">
    <div class="wrap">
        <div class="ficha-detalle">
            <div class="row">
                <div class="col-md-5">
                    <figure>
                        <img src="<?php echo $thumbnail[0];?>" alt="<?php echo get_the_title();?> | Marca Chile | Toolkit" />
                    </figure>
                </div>
                <div class="col-md-6">
                    <div class="ficha-texto">
                        <h1><?php echo get_the_title();?></h1>
                        <p><?php echo get_the_excerpt();?></p>
                    
                        <div class="datos">
                           <div class="item">
                                <p><b>Autor:</b> <?php echo $autor;?></p>
                                <!-- <p><b>Región:</b> Región de Antofagasta</p> -->
                            </div>
                            <div class="item">
                                <p>
                                    <b>Temas:</b> 
                                    <?php 
                                    if( (isset($temas_relacionados))&&(!empty($temas_relacionados)) ){ 
                                        foreach($temas_relacionados AS $tema){ 
                                            $array_temas[]=$tema->slug;
                                            ?>
                                            <em><a href="<?php echo get_term_link( $tema->term_id);?>"><?php echo ucfirst($tema->name);?></a></em>
                                            <?php 
                                        }  
                                    }  
                                    //echo $temas_relacionados; 
                                    ?>
                                </p>
                                <p>
                                    <b>Licencia:</b> <?php echo $licencia;?>
                                </p>
                            </div>
                        </div>
                        <?php
                        foreach ($datos_archivos as $archivo) {
                        ?>
                        <div class="archivos">
                            <div class="descargas">
                                        
                                <div class="formatos">
        
                                    <?php 
                                    if($archivo['medidas'] != ""){?>
                                        <div class="item">
                                            <label for="tipo1">Medidas: <?php echo $archivo['medidas'];?> pixeles</label>
                                        </div>
                                    <?php } ?>

                                    <form action="" style="width: 100%; min-width: 100%;">
                                        <div class="i-formato">
                                            <span class="s-formato">Archivo:</span>    
                                                <div class="item-formato">
                                                <label for="formato_<?= $archivo['nombre_archivo'] ?>"> <?= $archivo['nombre_archivo'] ?></label>
                                                </div>
                                        </div>
                                        <div class="i-formato">
                                            <span class="s-formato">Formato:</span>   
                                            <?php 
                                            // foreach ($array_formatos AS $formatos){   ?>
                                                <div class="item-formato">
                                                <!-- <input type="checkbox" name="formatos[]" value="<?php echo $formatos;?>" id="formato_<?php echo $formatos;?>"> -->
                                                <label for="formato_<?= $archivo['formato'] ?>"><?= $archivo['formato'] ?> </label>
                                                </div>
                                                <?php 
                                            // }
                                            ?>
                                        </div>
                                        <div class="i-formato">
                                            <span class="s-formato">Idioma:</span>    
                                                <div class="item-formato">
                                                <!-- <input type="checkbox" name="idiomas[]" value="<?php echo $idiomas;?>" id="formato_<?php echo $idiomas;?>"> -->
                                                <label for="formato_<?= $archivo['idioma'] ?>"> <?= !empty($archivo['idioma'])?$archivo['idioma']:'ES'; ?> </label>
                                                </div>
                                        </div>
                                    </form>

                                    <?php  
                                    $cont_formatos=0;
                                    /*
                                    if(isset($datos_archivos)){
                                        foreach ($datos_archivos AS $datos){ 
                                            ?>
                                            <div class="item">
                                                <!-- <input type="checkbox" name="formatos[]" value="<?php echo $cont_formatos;?>" id="formato_<?php echo $cont_formatos;?>" class="formatos_descarga"> -->
                                                <label for="formato_<?php echo $cont_formatos;?>">Formato <b><?php echo $datos['formato'];?></b> Idioma <b><?php echo $datos['idioma'];?></b> </label> 
                                            </div>
                                            <?php   
                                            $cont_formatos++;             
                                        } 
                                    }
                                    */
                                    ?>
                                </div>
                                <div class="icono">
                                    <img src="<?php echo $themeURL; ?>/images/toolkit/iconos/ic-<?php echo strtolower($archivo['formato']); ?>.svg" alt="" />  
                                </div>

                            </div>
							
							
						<?php
                       if( is_user_logged_in() ){
                       ?> 

                            <div class="botones" style="margin-bottom: 1rem">
                                <a href="https://s3.amazonaws.com/toolkit.marcachile.cl/<?php echo $archivo['ruta_de_archivo'];?>" class="btn-descargar"  target="_blank">
                                    <img src="<?php echo $themeURL; ?>/images/toolkit/ic-descargar-blanco.svg" alt=""> DESCARGAR
                                </a> 
                                <!-- a href="#" class="btn-agregar <?php echo $class_active; ?>" onclick="tk_add_to_cart(<?php echo $post_id;?>, 0, '<?php echo $archivo['ruta_de_archivo'];?>');"  id="btn_single_<?php echo $post_id;?>">
                                    <img src="<?php echo $themeURL; ?>/images/toolkit/ic-add-blanco.svg" alt="" > AGREGAR AL CARRO
                                </a -->
                            </div>
					  <?php }  else{ ?>
                                <a href="https://toolkit-marcachile.lfi.cl/ingresa/" class="btn-descargar">
                                    <img src="<?php echo $themeURL; ?>/images/toolkit/ic-descargar-blanco.svg" alt=""> Ingresa para poder acceder a la descarga
                                </a> 
							
							
							
 	
							
 
							
							
					   <?php }?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="palabras-claves">
            <h4>Palabras claves</h4>
            <div class="tags">
                <?php 
                if( (isset($palabras_relacionadas))&&(!empty($palabras_relacionadas)) ){ 
                    foreach($palabras_relacionadas AS $palabra){ 
                        $array_palabras[]=$palabra->slug;
                        ?>
                        <a href="<?php echo get_term_link( $palabra->term_id);?>"><?php echo ucfirst($palabra->name);?></a>
                        <?php 
                    } 
                }
                ?>
            </div>
        </div>


    </div>
</section>



<section class="interior-toolkit pt-0">
    <div class="wrap">
        <div class="resultados-toolkit">
            <h4>Imágenes relacionadas</h4>
            <div class="row row-small">
                <?php 
                $relacion_taxonomy="";
                $relacion="";
                if( (isset($palabras_relacionadas))&&(!empty($palabras_relacionadas)) ){  
                    $relacion=$palabras_relacionadas[0]; 
                    $relacion_taxonomy="palabras_relacionadas";
                }else{
                    $relacion=$temas_relacionados[0]; 
                    $relacion_taxonomy="temas";
                }
                

                $args_rels = array(
                    'posts_per_page'   => 8,
                    'post_type'        => 'toolkit',
                    'post_status'      => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'DESC',
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => $relacion_taxonomy,
                            'field'    => 'slug',
                            'terms'    => $relacion,
                        )
                    )
                ); 
                $posts_x_palabras = get_posts( $args_rels ); 	
                foreach ($posts_x_palabras as $post_){ 
                    setup_postdata( $post_ );  	
                    $imagen_ppal = get_field( 'imagen_principal', $post_->ID); 
                    if( empty($imagen_ppal["url"]) ) {
                        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_->ID ), 'medium' );
                    } else {
                        $thumbnail = [$imagen_ppal["url"]];
                    }
                    $link=get_permalink( $post_->ID); 
                    $post_id=$post_->ID; 
                    $class_active="";
                    if ( defined('NOMBRE_SESSION') && defined('RAIZ_SESSION') && isset($_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['cart']) ) {
                        if ( isset($_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['cart'][$post_id]['cant']) ) {
                            $class_active="activo";
                        }
                    }
                    ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="box-resultado">
                            <figure>
                                <a href="<?php echo $link;?>">
                                    <img src="<?php echo $thumbnail[0]; ?>" alt="<?php echo $post_->post_title;?> | Toolkit | Marca Chile" />
                                </a>
                            </figure>
                            <div class="texto">
                                <p><?php echo $post_->post_title;?></p>
        
                            </div>
                        </div>
                    </div>
                    <?php 
                } 
                ?>
            </div>
        </div>
    </div>
</section>

<?php  
get_footer('toolkit');
?>