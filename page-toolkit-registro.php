<?php   
//Template Name: Toolkit - Registro
get_header();   



 if ( is_user_logged_in() ) {
	  wp_redirect(home_url('/toolkit'));
 }




?>
 
 

    <!-- Section 2 - Cover -->

   <section class="marca-chile-cover2 marca-chile-cover__text">
    <div class="container-fluid px-0">
      <div class="row mx-0">
        <div class="col-md-6 mx-auto px-0">
          <div class="marca-chile-cover__text-title">
            <h3><span>Crear </span>Cuenta</h3>
          </div>
        </div>
      </div>
    </div>
  </section>

 
 
  <section class="marca-chile-card marca-chile-toolkit">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="marca-chile-form-crear-cuenta">
 
      <?php
if (is_user_logged_in()) {
	echo '<p class="logged-in">Ya estas logeado</p>';
} else {
 echo do_shortcode( "[ultimatemember form_id='78802']" );  
}
 ?>
							
         <script>

window.addEventListener('load', function () {
  console.log('window load ok');
  var form = document.querySelector('.um-form[data-mode="register"] form');
  var nativeSubmit = form.submit; // guardamos el submit original
  var allowSubmit = false;
  form.submit = function () {
    return;
  }
});

jQuery(function($){

  $(document).on('click', '#um-submit-btn', function(e){

      e.preventDefault(); // evita que recargue la página

      var $form = $(this).closest("form");
      var hasErrors = false;

      // limpia errores previos
      clearUmErrors($form);

      // EJEMPLOS DE CAMPOS: ajusta los name="" según tus campos UM
      var $email  = $form.find('input[name="username-78802"]');
      var $nombre = $form.find('input[name="first_name-78802"]');
      var $password = $form.find('input[name="user_password-78802"]');

      if (!$email.val().trim()) {
        setUmError($email, 'Ingresa tu correo electrónico');
        hasErrors = true;
      }

      if ($nombre.val().trim().length < 3) {
        setUmError($nombre, 'El nombre es obligatorio');
        hasErrors = true;
      }

      if (!$password.val().trim()) {
        setUmError($password, 'Ingresa tu contraseña');
        hasErrors = true;
      }

      setTimeout(function(){
        $("#um-submit-btn").removeAttr("disabled");
      },1000);

      // si hay errores, nos quedamos aquí (no se envía)
      if (hasErrors) {
        return;
      }

      // si todo OK y quieres que se envíe normal:
      // quitamos nuestro handler para evitar loop y enviamos
      $form.submit();
  });

  // Helpers para mostrar errores con el estilo de UM
  function setUmError($field, message) {
    var $wrap = $field.closest('.um-field');

    if (!$wrap.length) {
      $wrap = $field.parent();
    }

    $wrap.find('.um-field-error').remove();

    $('<div class="um-field-error"/>')
      .html('<span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>'+message)
      .appendTo($wrap);
  }

  function clearUmErrors($form) {
    $form.find('.um-field-error').remove();
  }

});


         </script>          
						

						
          </div>
        </div>
      </div>
    </div>
  </section>
	 

						
 
	
 
					 
<?php
 get_footer(); 
?> 
