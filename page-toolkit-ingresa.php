<?php   
/* 
Template Name: Toolkit - Ingresa
*/ 

if ( is_user_logged_in() ) {
	wp_redirect( home_url( '/toolkit' ) );
	exit;
}

get_header();



?>

    <!-- Section 2 - Cover -->

 
 
 
    <section class="marca-chile-cover marca-chile-cover__img marca-chile-toolkit v-02">
        <div class="container-fluid px-0">
            <div class="row mx-0">
                <div class="col px-0">
					
                    <div class="marca-chile-cover__img-caption v-04">
                        <h3>Ingresar</h3>
                        <div class="marca-chile-form-portal">
                            <div class="marca-chile-form-portal__message">
                                <div class="invalid-msg">
                                    El inicio de sesión o la contraseña son incorrectos
                                </div>
                              </div>                            
 
	 
           
      <?php
if (is_user_logged_in()) {
	echo '<p class="logged-in">Ya estas logeado</p>';
} else {
 echo do_shortcode( '[ultimatemember form_id="78803"]' );  
}
 ?>
							
                        </div>
					 
 				
                    </div>

                    <picture class="marca-chile-image__cover v-02">
                        <img src="<?php bloginfo('template_url'); ?>/images/picture/toolkit/toolkit-banner-login-01-824x633.png" alt="banner">
                    </picture>
                </div>
            </div>
        </div>
    </section>
	
 
					 
<?php
 get_footer(); 
?> 
