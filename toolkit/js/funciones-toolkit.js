const cToolkit = document.getElementsByClassName('c-toolkit');
if(cToolkit){
[].forEach.call(document.querySelectorAll('.c-toolkit'), function (el) {
  var slider = tns({
    container: el,
    items: 1,
    controls: true,
    autoplay: true,
    autoplayTimeout: 4500,
    nav: true,
    navPosition: 'bottom',
    preventScrollOnTouch: "force"
    });
    slider.events.on('transitionEnd', function(){
    });
    slider.events.on('transitionEnd', function(){
    });
  });
}

$(document).ready(function(){
  $('.olvidaste').click(function(e){
    e.preventDefault();
    $('.recuperacion').addClass('visible');
  });

  // ============================================
  // Validador de Contraseña (Reset Password Page)
  // ============================================
  // Detectamos si estamos en la página de reset buscando el contenedor de validadores
  var $validators = $('#password-validators');
  
  if ($validators.length > 0) {
      // Ultimate Member suele usar input[name="user_password"] en el formulario de reset
      var $passInput = $('input[name="user_password"]'); 
      
      // Si no encuentra ese name, intenta buscar por tipo password dentro del form
      if ($passInput.length === 0) {
          $passInput = $('.um-form input[type="password"]').first();
      }

      if ($passInput.length > 0) {
          // Mostrar los validadores cuando el usuario hace focus
          $passInput.on('focus input', function() {
              $validators.slideDown(); // O .show()
              validatePassword($(this).val());
          });

          $passInput.on('keyup', function() {
              validatePassword($(this).val());
          });

          function validatePassword(password) {
              // 1. Mínimo 8 caracteres
              if (password.length >= 8) {
                  $('#val-length').addClass('valid').removeClass('invalid');
              } else {
                  $('#val-length').removeClass('valid').addClass('invalid');
              }

              // 2. Una letra mayúscula
              if (/[A-Z]/.test(password)) {
                  $('#val-upper').addClass('valid').removeClass('invalid');
              } else {
                  $('#val-upper').removeClass('valid').addClass('invalid');
              }

              // 3. Un número
              if (/\d/.test(password)) {
                  $('#val-number').addClass('valid').removeClass('invalid');
              } else {
                  $('#val-number').removeClass('valid').addClass('invalid');
              }
          }
      }
  }
});