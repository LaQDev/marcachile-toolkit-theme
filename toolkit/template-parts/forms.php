<?php 
if(!isset($ur_form_form)){
    $ur_form_form="";
}
?>
<section class="formularios">
    <div class="wrap">
        <div class="w-form">
            <form action="" name="tk_form_ingresa" id="tk_form_ingresa" method="post" class="formulario">
                <input type="hidden" name="recaptcha_response" id="tk_form_ingresa_recaptchaResponse">
                <h3>INGRESAR</h3>
                <div class="form-group">
                    <input type="text" placeholder="E-mail" name="email" />
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Contraseña" name="clave" />
                </div>
                <div class="form-group right">
                    <input type="submit" value="INICIAR" name="INICIAR" class="btn_enviar" />
                </div>
                <div id="ajax_results_ingresa" class="ajax_results"></div> 
                <input type="hidden" name="action" value="tk_form_ingresa">
                <input type="hidden" name="ur_form_form" value="<?php echo $ur_form_form;?>">
                <?php wp_nonce_field( 'tk_form_ingresa_nonce', 'name_of_nonce_field' ); ?>
                <a href="#" class="olvidaste">¿Olvidaste la contraseña?</a>
            </form> 
            <form action="" name="tk_form_recuperar" id="tk_form_recuperar" method="post" class="formulario">
                <input type="hidden" name="recaptcha_response" id="tk_form_recuperar_recaptchaResponse">
                <div class="recuperacion">
                    <p>No te preocupes, le pasa a los mejores</p>
                    <input type="text" placeholder="E-mail" name="email" />
                    <input type="submit" value="ENVIAR ENLACE DE RECUPERACIÓN" name="RECUPERAR" />
                </div>
                <input type="hidden" name="action" value="tk_form_recuperar">
                <?php wp_nonce_field( 'tk_form_recuperar_nonce', 'name_of_nonce_field' ); ?>
                <div id="ajax_results_recuperar" class="ajax_results"></div> 
            </form>
        </div>
        <div class="w-form">
            <form action="" name="tk_form_registro" id="tk_form_registro" method="post" class="formulario">
                <input type="hidden" name="recaptcha_response" id="tk_form_registro_recaptchaResponse">
                <h3>REGÍSTRATE</h3>
                <div class="form-group">
                    <input type="text" placeholder="Nombre y Apellido" name="nombre_y_apellido" />
                </div>
                <div class="form-group">
                    <input type="text" placeholder="E-mail" name="email" />
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Institución" name="institucion" />
                </div>
                <div class="form-group">
                    <input type="text" placeholder="País" name="pais" />
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Contraseña" name="clave" />
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Confirmar contraseña" name="clave2" />
                </div>
                <div class="form-group">
                    <input type="checkbox" name="acepto" id="acepto"> 
                    <label for="acepto"><i>He leído y acepto los <a href="<?php echo $siteURL; ?>/Terminos-de-Uso-Toolkit-MARCA-CHILE-2022.pdf" target="_blank">términos y condiciones de uso</i>.</a> </label>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="correo" id="correo"> 
                    <label for="correo"><i>Acepto recibir información de Imagen de Chile</i>.</label>
                </div>
                <div class="form-group right">
                    <input type="submit" value="ENVIAR" name="ENVIAR" class="btn_enviar" />
                </div>
                <input type="hidden" name="action" value="tk_form_registro">
                <input type="hidden" name="ur_form_form" value="<?php echo $ur_form_form;?>">
                <?php wp_nonce_field( 'tk_form_registro_nonce', 'name_of_nonce_field' ); ?>
                <div id="ajax_results_registro" class="ajax_results"></div> 
            </form>
        </div>
    </div>
</section>


<script type="text/javascript">  
jQuery(document).ready(function($) { 
	$(".formulario").submit(function(e) { 
                 
        var formu=$(this); 
        formu.find('.ajax_results').html("<h3>enviando...</h3>");  
        var id_form=formu.attr("id");  
        formu.find('.btn_enviar').hide();

        grecaptcha.ready(function () {
            grecaptcha.execute('6LeRmiApAAAAAG-jBlNNbnpg2jAOvXVpFU9doMv6', { action: id_form }).then(function (token) {
                $('#' + id_form + '_recaptchaResponse').val(token);
                var formData  = new FormData(document.getElementById(id_form));  
                console.log(token);
                $.ajax({ 
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false, 
                    success: function(data) {	
                        var str = data;
                        var res = str.replace("\"0\"", "");
                        var res = res.replace("0", "");
                        var res = res.replace(" 0 ", "");
                        var res = res.replace("0 ", "");
                        var res = res.replace(0, "");
                        formu.find('.ajax_results').html(res); 
                        formu.find('.btn_enviar').show(); 
                        var data_html=formu.find('.ajax_results').html(); 
                        var str = data_html;
                        var res = str.replace("\"0\"", "");
                        var res = res.replace("0", "");
                        var res = res.replace(" 0 ", "");
                        var res = res.replace("0 ", "");
                        var res = res.replace(0, "");
                        formu.find('.ajax_results').html(res); 
                    }
                }); 
            });
        });
		e.preventDefault();
    /*
        

        alert( '.btn_enviar' );

        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: formData,
            cache: false,
            processData: false,
            success: function ( resp ) {
                alert( resp );
                formu.find('.ajax_results').html(resp); 
                formu.find('.btn_enviar').show(); 
            }
        });
        return false; 
        
        */

       // e.preventDefault();			
    }); 
}); 
</script>