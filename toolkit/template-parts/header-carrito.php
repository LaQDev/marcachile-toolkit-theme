<div class="box-user">
    <?php 
    if(is_login()==true){
        ?>
        <a href="<?php echo $siteURL; ?>/mi-cuenta/">Hola <span class="user"><i class="fas fa-user"></i> <?php echo $_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['user']['nombre'];?></span>
        <i class="fas fa-caret-right"></i> Ver Cuenta</a> 
        <br />
        <a href="<?php echo $siteURL; ?>/mi-cuenta/logout"><i class="fas fa-caret-right"></i> Cerrar Sesión</a>
        <?php 
    }else{
        ?>
        <a href="<?php echo $siteURL; ?>/ingresa/"><i class="fas fa-caret-right"></i> Iniciar sesión</a> 
        <a href="<?php echo $siteURL; ?>/ingresa/"><i class="fas fa-caret-right"></i> Crear cuenta</a>
        <?php 
    } 
    ?>
</div>

<!-- Si el usuario ha iniciado sesión y no ha aceptado las nuevas políticas, mostrar el modal -->

<?php if( is_login() && $_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['user']['acepta_correos'] == 0 ) { ?>

<!-- div id="modal_actualizar_permisos" class="modal">
    <div class="modal-content">
        <form name="tk_form_actualizar_permisos" id="tk_form_actualizar_permisos" method="post">
            <p>Necesitamos que aceptes lo siguiente:</p>
            <input type="checkbox" name="acepto" id="acepto" value="1">
            <label for="acepto">He leído y acepto los <a href="<?php echo $siteURL; ?>/Terminos-de-Uso-Toolkit-MARCA-CHILE-2022.pdf" target="_blank">términos y condiciones de uso.</a> </label>
            <br>
            <input type="checkbox" name="correo" id="correo" value="1"> 
            <label for="correo">Acepto recibir información de Imagen de Chile.</label>
            <br>
            <input type="hidden" name="id_usuario" value="<?= $_SESSION[NOMBRE_SESSION][RAIZ_SESSION]['user']['id'] ?>">
            <input type="hidden" name="action" value="tk_form_actualizar_permisos">
            <?php wp_nonce_field( 'tk_form_actualizar_permisos_nonce', 'name_of_nonce_field' ); ?>
            <div id="ajax_results_actualizar_permisos" class="ajax_results"></div>
            <button type="submit" class="btn-enviar-modal">Guardar</button>
        </form>
    </div>
</div -->

<?php } ?>