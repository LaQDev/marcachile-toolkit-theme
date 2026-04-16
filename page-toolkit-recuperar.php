<?php
/*
Template Name: Toolkit - Recuperar contraseña
*/

get_header();

?>

<div class="recover-wrap">

  <h1 class="recover-title">Crea tu nueva contraseña</h1>
  <p class="recover-desc">Ingresa una nueva contraseña segura para tu cuenta.</p>
  
  <div class="field-label-custom">
      <?php echo do_shortcode( '[ultimatemember_password]' ); ?>
  </div>

  <ul class="password-validators" id="password-validators" style="display:none;">
      <li id="val-length">Mínimo 8 caracteres</li>
      <li id="val-upper">Una letra mayúscula</li>
      <li id="val-number">Un número</li>
  </ul>

  <a class="recover-back" href="<?php echo esc_url( site_url() ); ?>">Volver a Iniciar Sesión</a>

</div>

<?php
get_footer();
?>