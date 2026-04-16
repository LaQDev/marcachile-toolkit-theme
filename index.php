<?php
/* 
Template Name: Inicio - Home
*/

if ( is_user_logged_in() ) {
  wp_redirect( home_url( '/toolkit/' ) );
  exit;
}

get_header();

?>


<!-- Section 2 - Cover -->



<section class="marca-chile-cover marca-chile-cover__img v-02 marca-chile-toolkit"
  style="background-image: url('<?php the_field('imagen_toolkithome'); ?>')">
  <div class="container-fluid px-0">
    <div class="container">
      <div class="row mx-0 imgLiquid bannerTop">

        <div class="col-12 col-sm-6 bannerTop-title">
          <div class="bannerTop-title-content">
            <h1 class="bannerTop-title-h1">
              <?php the_field('titulo_toolkithome'); ?>
            </h1>
            <p class="bannerTop-title-p">
              <?php the_field('descripcion_toolkithome'); ?>
            </p>
          </div>
        </div>

        <div class="col-12 col-sm-6 px-0 bannerTop-form">

          <div class="login-wrapper">

            <div class="login-card" id="registro">
              <h2 class="login-title">Regístrate</h2>

              <p class="hero">Completa tus datos para obtener acceso inmediato.</p>

              <form method="post" id="toolkit-register-form">

                <?php wp_nonce_field('tk_register_action', 'tk_register_nonce'); ?>
                <input type="hidden" name="action" value="tk_register_user">

                <label class="field-label" for="user">Nombre</label>
                <input id="tk_nombre" name="tk_nombre" type="text" class="field-input" placeholder="Diego Araya"
                  required>

                <label class="field-label" for="user">Email</label>
                <input id="tk_user" name="tk_user" type="email" class="field-input" placeholder="juan@gmail.com"
                  required>

                <label class="field-label" for="pass">Contraseña</label>
                <div class="field-password">
                  <input id="tk_pass" name="tk_pass" type="password" class="field-input" placeholder="•••••" required>
                </div>
                <p>Deber tener al menos:</p>
                <p id="goalcantidad">Mínimo 8 caracteres.</p>
                <p id="goalmayuscula">Al menos un caracter en minúscula y uno en mayúscula.</p>
                <p id="goalletranumero">Al menos una letra y número.</p>

                <label class="field-label" for="pass">Repite tu contraseña</label>
                <div class="field-password">
                  <input id="tk_pass2" name="tk_pass2" type="password" class="field-input" placeholder="•••••" required>
                </div>
                <p id="goalcoinciden">Las contraseñas deben coincidir.</p>

                <label class="field-label" for="pass">País de origen</label>
                <div class="field-password">
                  <select name="pais" id="pais" class="field-input" required>
                    <option value="">- Seleccione -</option>
                    <option value="Afganistán">Afganistán</option>
                    <option value="Albania">Albania</option>
                    <option value="Alemania">Alemania</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Antigua y Barbuda">Antigua y Barbuda</option>
                    <option value="Arabia Saudita">Arabia Saudita</option>
                    <option value="Argelia">Argelia</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaiyán">Azerbaiyán</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bangladés">Bangladés</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Baréin">Baréin</option>
                    <option value="Bélgica">Bélgica</option>
                    <option value="Belice">Belice</option>
                    <option value="Benín">Benín</option>
                    <option value="Bielorrusia">Bielorrusia</option>
                    <option value="Birmania">Birmania</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
                    <option value="Botsuana">Botsuana</option>
                    <option value="Brasil">Brasil</option>
                    <option value="Brunéi">Brunéi</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Bután">Bután</option>
                    <option value="Cabo Verde">Cabo Verde</option>
                    <option value="Camboya">Camboya</option>
                    <option value="Camerún">Camerún</option>
                    <option value="Canadá">Canadá</option>
                    <option value="Catar">Catar</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Chipre">Chipre</option>
                    <option value="Ciudad del Vaticano">Ciudad del Vaticano</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoras">Comoras</option>
                    <option value="Corea del Norte">Corea del Norte</option>
                    <option value="Corea del Sur">Corea del Sur</option>
                    <option value="Costa de Marfil">Costa de Marfil</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Croacia">Croacia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Dinamarca">Dinamarca</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egipto">Egipto</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Eslovaquia">Eslovaquia</option>
                    <option value="Eslovenia">Eslovenia</option>
                    <option value="España">España</option>
                    <option value="Estados Unidos">Estados Unidos</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Esuatini">Esuatini</option>
                    <option value="Etiopía">Etiopía</option>
                    <option value="Filipinas">Filipinas</option>
                    <option value="Finlandia">Finlandia</option>
                    <option value="Fiyi">Fiyi</option>
                    <option value="Francia">Francia</option>
                    <option value="Gabón">Gabón</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Granada">Granada</option>
                    <option value="Grecia">Grecia</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bisáu">Guinea-Bisáu</option>
                    <option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haití">Haití</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hungría">Hungría</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Irak">Irak</option>
                    <option value="Irán">Irán</option>
                    <option value="Irlanda">Irlanda</option>
                    <option value="Islandia">Islandia</option>
                    <option value="Islas Marshall">Islas Marshall</option>
                    <option value="Islas Salomón">Islas Salomón</option>
                    <option value="Israel">Israel</option>
                    <option value="Italia">Italia</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japón">Japón</option>
                    <option value="Jordania">Jordania</option>
                    <option value="Kazajistán">Kazajistán</option>
                    <option value="Kenia">Kenia</option>
                    <option value="Kirguistán">Kirguistán</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Laos">Laos</option>
                    <option value="Lesoto">Lesoto</option>
                    <option value="Letonia">Letonia</option>
                    <option value="Líbano">Líbano</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libia">Libia</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lituania">Lituania</option>
                    <option value="Luxemburgo">Luxemburgo</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malasia">Malasia</option>
                    <option value="Malaui">Malaui</option>
                    <option value="Maldivas">Maldivas</option>
                    <option value="Malí">Malí</option>
                    <option value="Malta">Malta</option>
                    <option value="Marruecos">Marruecos</option>
                    <option value="Mauricio">Mauricio</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="México">México</option>
                    <option value="Micronesia">Micronesia</option>
                    <option value="Moldavia">Moldavia</option>
                    <option value="Mónaco">Mónaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Níger">Níger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Noruega">Noruega</option>
                    <option value="Nueva Zelanda">Nueva Zelanda</option>
                    <option value="Omán">Omán</option>
                    <option value="Países Bajos">Países Bajos</option>
                    <option value="Pakistán">Pakistán</option>
                    <option value="Palaos">Palaos</option>
                    <option value="Panamá">Panamá</option>
                    <option value="Papúa Nueva Guinea">Papúa Nueva Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Perú">Perú</option>
                    <option value="Polonia">Polonia</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Reino Unido">Reino Unido</option>
                    <option value="República Centroafricana">República Centroafricana</option>
                    <option value="República Checa">República Checa</option>
                    <option value="República del Congo">República del Congo</option>
                    <option value="República Democrática del Congo">República Democrática del Congo</option>
                    <option value="República Dominicana">República Dominicana</option>
                    <option value="Ruanda">Ruanda</option>
                    <option value="Rumania">Rumania</option>
                    <option value="Rusia">Rusia</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Cristóbal y Nieves">San Cristóbal y Nieves</option>
                    <option value="San Marino">San Marino</option>
                    <option value="San Vicente y las Granadinas">San Vicente y las Granadinas</option>
                    <option value="Santa Lucía">Santa Lucía</option>
                    <option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leona">Sierra Leona</option>
                    <option value="Singapur">Singapur</option>
                    <option value="Siria">Siria</option>
                    <option value="Somalia">Somalia</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudáfrica">Sudáfrica</option>
                    <option value="Sudán">Sudán</option>
                    <option value="Sudán del Sur">Sudán del Sur</option>
                    <option value="Suecia">Suecia</option>
                    <option value="Suiza">Suiza</option>
                    <option value="Surinam">Surinam</option>
                    <option value="Tailandia">Tailandia</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Tayikistán">Tayikistán</option>
                    <option value="Timor Oriental">Timor Oriental</option>
                    <option value="Togo">Togo</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad y Tobago">Trinidad y Tobago</option>
                    <option value="Túnez">Túnez</option>
                    <option value="Turkmenistán">Turkmenistán</option>
                    <option value="Turquía">Turquía</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Ucrania">Ucrania</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistán">Uzbekistán</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Yibuti">Yibuti</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabue">Zimbabue</option>
                  </select>
                </div>

                <div class="row-forgot">
                  <input type="checkbox" name="politicas" id="politicas"> Acepto las <a
                    href="https://www.marcachile.cl/toolkit/wp-content/uploads/2024/04/Terminos-de-Uso-Toolkit-Marca-Chile_2024.pdf"
                    class="strong">Políticas de privacidad</a>
                </div>

                <button type="submit" id="tk_submit" class="btn-primary">Continuar</button>

                <div class="login-footer">
                  <a href="#" id="irallogin">
                    ¿Ya te encuentras registrado?
                  </a>
                </div>

                <p id="tk_msg_registro" class="tk_msg" style="display:none;"></p>
              </form>
            </div>


            <div class="login-card" id="login">
              <h2 class="login-title">Iniciar sesión</h2>

              <form method="post" id="toolkit-login-form">

                <label class="field-label" for="user">Usuario</label>
                <input id="tk_user" name="tk_user" type="email" class="field-input" placeholder="juan@gmail.com">

                <label class="field-label" for="pass">Contraseña</label>
                <div class="field-password">
                  <input id="tk_pass" name="tk_pass" type="password" class="field-input" placeholder="•••••">
                </div>

                <div class="row-forgot">
                  <a href="<?php echo site_url(); ?>/cambiar-contrasena/">¿Olvidaste tu contraseña?</a>
                </div>

                <label class="remember">
                  <input type="checkbox" name="tk_remember" id="tk_remember" value="1">
                  <span>Recuérdame</span>
                </label>

                <button type="submit" id="tk_submit" class="btn-primary">Continuar</button>

                <div class="login-footer">
                  <a href="#" id="iralregistro">
                    ¿Aún no estás registrado?
                  </a>
                </div>

                <p id="tk_msg" class="tk_msg" style="display:none;"></p>
                <input type="hidden" id="tk_nonce" value="<?php echo wp_create_nonce('toolkit_login_nonce'); ?>">
              </form>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</section>


<section class="toolkit">
  <div class="toolkit__inner container">
    <h2 class="toolkit__title"><?php echo get_field("toolkittitulo");?></h2>

    <p class="toolkit__lead">
      <?php echo get_field("toolkitdescripcion");?>
    </p>

    <div class="toolkit__grid">
      <!-- Item 1 -->

      <?php if (have_rows('tabs')): ?>
      <?php while (have_rows('tabs')): the_row(); ?>
      <article class="toolkit-item">
        <div class="toolkit-item__icon">
          <img src="<?php echo get_sub_field("icono");?>" alt="<?php echo get_sub_field("titulo");?>">
        </div>
        <h3 class="toolkit-item__title"><?php echo get_sub_field("titulo");?></h3>

        <?php echo get_sub_field("contenido");?>
        
      </article>
      <?php endwhile; ?>
      <?php endif; ?>

      <!-- Item 2 -->
      <!--<article class="toolkit-item">
        <div class="toolkit-item__icon"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/2025/icon2.svg" alt="Banco de imágenes"></div>
        <h3 class="toolkit-item__title">Banco de imágenes</h3>
        <ul class="toolkit-item__list">
          <li>Imágenes corporativas</li>
          <li>Eventos</li>
          <li>Territorios</li>
        </ul>
      </article>

      <article class="toolkit-item">
        <div class="toolkit-item__icon"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/2025/icon3.svg" alt="Branding y piezas"></div>
        <h3 class="toolkit-item__title">Branding y piezas</h3>
        <ul class="toolkit-item__list">
          <li>Manual de marca</li>
          <li>Logotipos</li>
          <li>Plantillas</li>
        </ul>
      </article>

      <article class="toolkit-item">
        <div class="toolkit-item__icon"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/2025/icon4.svg" alt="Datos y publicaciones"></div>
        <h3 class="toolkit-item__title">Datos y publicaciones</h3>
        <ul class="toolkit-item__list">
          <li>Estudios</li>
          <li>Informes</li>
          <li>Reportes</li>
        </ul>
      </article>-->
    </div>
  </div>
</section>


<?php

get_footer();

?>