<?php  
/* 
Template Name: Toolkit - Presentaciones Resultados
*/  


get_header();   
$temas = get_terms( array(
    'taxonomy' => 'temas',
    'hide_empty' => false,
) );
$categorias = get_terms( array(
    'taxonomy' => 'categorias',
    'hide_empty' => false,
) );  



 if ( is_user_logged_in() ) {
	  // logeado
 }

else{
	wp_redirect(home_url('/ingresa'));
}

/* Query  */  
$get_buscar=""; 
$get_tema=""; 
$get_categoria=""; 
$get_idioma=""; 

if ( (isset($_GET["buscar"]))||(isset($_GET["tema"]))||(isset($_GET["categoria"]))||(isset($_GET["idioma"])) ) {   
    if(rgp('buscar')){
        $get_buscar=rgp('buscar'); 
    }
    $operador="OR";
    $cont_filtros=0; 
    if(rgp('tema')){ 
        $get_tema=rgp('tema'); 
        $cont_filtros++;
    }
    if(rgp('categoria')){
        $get_categoria=rgp('categoria'); 
        $cont_filtros++;
    }
    if(rgp('idioma')){
        $get_idioma=rgp('idioma'); 
        $cont_filtros++;
    }
    if($cont_filtros>1){
        $operador="AND";
    }

    $tax_query = array('relation' => $operador);
    if($get_tema!=""){
        $tax_query[] =  array(
            'taxonomy' => 'temas',
            'field' => 'slug',
            'terms' => $get_tema
        );
    } 
    if($get_categoria!=""){
        $tax_query[] =  array(
            'taxonomy' => 'categorias',
            'field' => 'slug',
            'terms' => $get_categoria
        );
    } 

    $args="";
    if(rgp('buscar')){ 
        $args=array(
            's'=>$get_buscar,
            'posts_per_page'   => 60,
            'post_type'        => 'toolkit',
            'post_status'      => 'publish', 
        );
    }else{ 
        if(($get_tema!="")||($get_categoria!="")||($get_idioma!="")){ 
            if($get_idioma!=""){
                if(($get_tema!="")||($get_categoria!="")){ 
                    $args = array(
                        'posts_per_page'   => 60,
                        'post_type'        => 'toolkit',
                        'post_status'      => 'publish',
                        'orderby' => 'menu_order',
                        'order' => 'DESC',
                        'tax_query' => $tax_query,
                        'meta_query'	=> array(
                            'relation'		=> 'OR',
                            array(
                                'key'	 	=> 'idiomas',
                                'value'	  	=> array($get_idioma),
                                'compare' 	=> 'IN',
                            ),
                        ),
                    ); 
                }else{
                    $args = array(
                        'posts_per_page'   => 60,
                        'post_type'        => 'toolkit',
                        'post_status'      => 'publish',
                        'orderby' => 'menu_order',
                        'order' => 'DESC',
                        'meta_query'	=> array(
                            'relation'		=> 'OR',
                            array(
                                'key'	 	=> 'idiomas',
                                'value'	  	=> $get_idioma,
                                'compare' 	=> 'LIKE',
                            ),
                        ),
                    ); 
                } 
            }else{
                $args = array(
                    'posts_per_page'   => 60,
                    'post_type'        => 'toolkit',
                    'post_status'      => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'DESC',
                    'tax_query' => $tax_query,
                ); 
            }  
        }else{
            $args = array(
                'posts_per_page'   => 60,
                'post_type'        => 'toolkit',
                'post_status'      => 'publish',
                'order' => 'ASC',
            ); 
        }
    } 
    /*
    'meta_key' => 'idiomas',
    'meta_value' => array('ES'), 
    */ 
}else{  
    $args = array(
        'posts_per_page'   => 60,
        'post_type'        => 'toolkit',
        'post_status'      => 'publish',
        'order' => 'ASC',
    ); 
} 
 
$tema_slug=$get_tema;
$categoria_slug=$get_categoria; 
//get_template_part( 'template-parts/filtros' ); 
$posts_ = get_posts( $args );   
?> 
<div class="banner-toolkit small">
    <?php 
    include ( get_template_directory() . '/toolkit/template-parts/header-carrito.php' );
    ?> 
    <div class="carrusel">
        <div class="c-toolkit">
            <div class="item">
                <img src="<?php echo esc_url( $themeURL ); ?>/images/toolkit/banner4.jpg" alt="">
            </div>
        </div>
    </div>
    <?php 
    include ( get_template_directory() . '/toolkit/template-parts/selectores.php' );
    ?> 
</div>

<section class="interior-toolkit">
    <div class="wrap">
    <div class="resultados-toolkit">
      <!-- <h1>Presentaciones</h1> -->
      <div class="bloque-presentaciones">
        <h3>Presentaciones 2021</h3>
        <div class="row row-small">
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile.cl/toolkit/parra/">
                  <img src="https://marcachile.cl/wp-content/uploads/toolkit/previews/2020/11/0_img_parra-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                <p>Parra</p>
                <div class="botones">
                  <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53174,1);" id="btn_dwn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Parra">
                  </a>
                  <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53174);" id="btn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Parra">
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile.cl/toolkit/parra/">
                  <img src="https://marcachile.cl/wp-content/uploads/toolkit/previews/2020/11/0_img_parra-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                <p>Parra</p>
                <div class="botones">
                  <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53174,1);" id="btn_dwn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Parra">
                  </a>
                  <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53174);" id="btn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Parra">
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile.cl/toolkit/parra/">
                  <img src="https://marcachile.cl/wp-content/uploads/toolkit/previews/2020/11/0_img_parra-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                <p>Parra</p>
                <div class="botones">
                  <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53174,1);" id="btn_dwn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Parra">
                  </a>
                  <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53174);" id="btn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Parra">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bloque-presentaciones">
        <h3>Presentaciones 2020</h3>
        <div class="row row-small">
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile.cl/toolkit/parra/">
                  <img src="https://marcachile.cl/wp-content/uploads/toolkit/previews/2020/11/0_img_parra-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                <p>Parra</p>
                <div class="botones">
                  <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53174,1);" id="btn_dwn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Parra">
                  </a>
                  <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53174);" id="btn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Parra">
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile.cl/toolkit/parra/">
                  <img src="https://marcachile.cl/wp-content/uploads/toolkit/previews/2020/11/0_img_parra-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                <p>Parra</p>
                <div class="botones">
                  <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53174,1);" id="btn_dwn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Parra">
                  </a>
                  <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53174);" id="btn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Parra">
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile.cl/toolkit/parra/">
                  <img src="https://marcachile.cl/wp-content/uploads/toolkit/previews/2020/11/0_img_parra-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                <p>Parra</p>
                <div class="botones">
                  <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53174,1);" id="btn_dwn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Parra">
                  </a>
                  <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53174);" id="btn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Parra">
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile.cl/toolkit/parra/">
                  <img src="https://marcachile.cl/wp-content/uploads/toolkit/previews/2020/11/0_img_parra-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                <p>Parra</p>
                <div class="botones">
                  <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53174,1);" id="btn_dwn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Parra">
                  </a>
                  <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53174);" id="btn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Parra">
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile.cl/toolkit/parra/">
                  <img src="https://marcachile.cl/wp-content/uploads/toolkit/previews/2020/11/0_img_parra-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                <p>Parra</p>
                <div class="botones">
                  <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53174,1);" id="btn_dwn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Parra">
                  </a>
                  <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53174);" id="btn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Parra">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bloque-presentaciones">
        <h3>Presentaciones 2019</h3>
        <div class="row row-small">
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile.cl/toolkit/parra/">
                  <img src="https://marcachile.cl/wp-content/uploads/toolkit/previews/2020/11/0_img_parra-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                <p>Parra</p>
                <div class="botones">
                  <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53174,1);" id="btn_dwn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Parra">
                  </a>
                  <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53174);" id="btn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Parra">
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile.cl/toolkit/parra/">
                  <img src="https://marcachile.cl/wp-content/uploads/toolkit/previews/2020/11/0_img_parra-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                <p>Parra</p>
                <div class="botones">
                  <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53174,1);" id="btn_dwn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Parra">
                  </a>
                  <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53174);" id="btn_53174">
                    <img src="https://marcachile.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Parra">
                  </a>
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
get_footer('toolkit'); 
?> 