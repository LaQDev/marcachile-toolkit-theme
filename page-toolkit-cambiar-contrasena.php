<?php   
/* Template Name: Toolkit - Mi cuenta / Cambiar Contraseña 
*/ 

  get_header();   

  ?>

 <div class="recover-wrap">

  <h1 class="recover-title">Recupera tu acceso</h1>
  <?php echo do_shortcode( '[ultimatemember_password]' ); ?>

  <a class="recover-back" href="<?php echo esc_url( site_url() ); ?>">Volver a Iniciar Sesión</a>

</div>

  <?php 
  get_footer(); 

  ?>