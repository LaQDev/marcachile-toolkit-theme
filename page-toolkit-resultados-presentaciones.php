<?php  
/* 
Template Name: Toolkit - Resultados
*/  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
get_header('toolkit');   
$temas = get_terms( array(
    'taxonomy' => 'temas',
    'hide_empty' => false,
) );
$categorias = get_terms( array(
    'taxonomy' => 'categorias',
    'hide_empty' => false,
) );  

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
      <div class="bloque-res">
        <h2>PRESENTACIONES 2021</h2>
        <div class="row row-small">
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile4.redon.cl/toolkit/chile-la-experiencia/">
                  <img src="https://marcachile4.redon.cl/wp-content/uploads/toolkit/previews/2020/11/0_ppt_chile_la_experiencia_es-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                  <p>Chile: La experiencia</p>
                  <div class="botones">
                      <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53458,1);" id="btn_dwn_53458">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Chile: La experiencia">
                      </a>
                      <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53458);" id="btn_53458">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Chile: La experiencia">
                      </a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bloque-res">
        <h2>PRESENTACIONES 2019</h2>
        <div class="row row-small">
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile4.redon.cl/toolkit/chile-la-experiencia/">
                  <img src="https://marcachile4.redon.cl/wp-content/uploads/toolkit/previews/2020/11/0_ppt_chile_la_experiencia_es-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                  <p>Chile: La experiencia</p>
                  <div class="botones">
                      <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53458,1);" id="btn_dwn_53458">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Chile: La experiencia">
                      </a>
                      <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53458);" id="btn_53458">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Chile: La experiencia">
                      </a>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                <a href="https://marcachile4.redon.cl/toolkit/exportaciones-chilenas-pdf/">
                  <img src="https://marcachile4.redon.cl/wp-content/uploads/toolkit/previews/2020/11/0_ppt_exportaciones_chilenas_es-300x225.jpg" alt="">
                </a>
              </figure>
              <div class="texto">
                  <p>Exportaciones chilenas (PDF)</p>
                  <div class="botones">
                      <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53461,1);" id="btn_dwn_53461">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Exportaciones chilenas (PDF)">
                      </a>
                      <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53461);" id="btn_53461">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Exportaciones chilenas (PDF)">
                      </a>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                  <a href="https://marcachile4.redon.cl/toolkit/inversiones-extranjeras/">
                      <img src="https://marcachile4.redon.cl/wp-content/uploads/toolkit/previews/2020/11/0_ppt_inversiones_extranjeras_es-300x225.jpg" alt="">
                  </a>
              </figure>
              <div class="texto">
                  <p>Inversiones extranjeras</p>
                  <div class="botones">
                      <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53464,1);" id="btn_dwn_53464">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Inversiones extranjeras">
                      </a>
                      <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53464);" id="btn_53464">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Inversiones extranjeras">
                      </a>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                  <a href="https://marcachile4.redon.cl/toolkit/ciencia-e-innovacion/">
                      <img src="https://marcachile4.redon.cl/wp-content/uploads/toolkit/previews/2020/11/0_ppt_ciencia_e_innovacion_es-300x225.jpg" alt="">
                  </a>
              </figure>
              <div class="texto">
                  <p>Ciencia e Innovación</p>
                  <div class="botones">
                      <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53467,1);" id="btn_dwn_53467">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Ciencia e Innovación">
                      </a>
                      <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53467);" id="btn_53467">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Ciencia e Innovación">
                      </a>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6">
            <div class="box-resultado">
              <figure>
                  <a href="https://marcachile4.redon.cl/toolkit/patrimonio-e-identidad/">
                      <img src="https://marcachile4.redon.cl/wp-content/uploads/toolkit/previews/2020/11/0_ppt_patrimonio_e_identidad_es-300x225.jpg" alt="">
                  </a>
              </figure>
              <div class="texto">
                  <p>Patrimonio e identidad</p>
                  <div class="botones">
                      <a href="javascript:void(0);" class="ic-download" onclick="tk_add_to_cart(53470,1);" id="btn_dwn_53470">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-descargar.svg" alt="Patrimonio e identidad">
                      </a>
                      <a href="javascript:void(0);" class="ic-add-cart  " onclick="tk_add_to_cart(53470);" id="btn_53470">
                          <img src="https://marcachile4.redon.cl/wp-content/themes/marcachile2020/toolkit/images/toolkit/ic-add.svg" alt="Patrimonio e identidad">
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