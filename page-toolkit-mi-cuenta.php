<?php  
/* 
Template Name: Toolkit - Mi cuenta
*/  
 
 if ( ! is_user_logged_in() ) {
	wp_redirect( home_url( '/ingresa' ) );
	exit;
 }

    get_header();   

$term = get_queried_object(); 
global $wp;


$current_user = wp_get_current_user();

$nombre   = get_user_meta( $current_user->ID, 'first_name', true );
$apellido = get_user_meta( $current_user->ID, 'last_name', true );
$empresa  = get_user_meta( $current_user->ID, 'empresa', true );
$pais     = get_user_meta( $current_user->ID, 'pais_origen', true );
$newsletter = get_user_meta( $current_user->ID, 'newsletter_aceptado', true );
 
?>

    <section class="marca-chile-toolkit marca-chile-toolkit--padd">
        <div class="container-fluid px-0" id="content">
            <div class="row gx-6 mx-0">
                <div class="col-md-3 marca-chile-col-toolkit px-md-0 mb-4 ms-0 me-auto">
                    <?php get_template_part("sidebar");?>
       
                </div>
                <div class="col-md-9 marca-chile-col-toolkit pt-md-0 px-md-0 mb-4">
                    <div class="marca-chile-cover nobefore marca-chile-cover__img v-02 px-md-0">

                        <div class="marca-chile-cover__img-caption v-12">
                            <!--<div class="pathway">
                                Inicio > <strong>Mi Perfil</strong>
                            </div>-->
                            <div class="hero-title-row">
                                <h2>Mi Perfil</h2>
                            </div>
                        </div>
                        <picture class="marca-chile-image__cover">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/2025/head_profile.png?v=2" alt="banner" />
                        </picture>
                    </div>
                    <div class="g-0">
                        <div class="row g-0">
                            <div class="col-md-12">
 
                                     <!-- Section 4 - Form -->
                                    <section class="marca-chile-toolkit profile-section">
                                      <div class="container">
                                        <div class="row">
                                          <div class="col-md-8">
                                            <div class="row marca-chile-form-crear-cuenta">

                                  <div class="col-md-6 px-0">
                                            <div class="marca-chile-cover__text-title">
                                              <h2 class="noupper">Mis Datos</h2>
                                            </div>
                                          </div>  
                                  			  
                                      
                                      <form id="tk_profile_form">

                                          <?php wp_nonce_field( 'tk_profile_action', 'tk_profile_nonce' ); ?>
                                          <input type="hidden" name="action" value="tk_update_profile">

                                          <label class="field-label" for="tk_nombre">Nombre</label>
                                          <input type="text" id="tk_nombre" name="tk_nombre" class="field-input" 
                                                 value="<?php echo esc_attr( $nombre ); ?>">

                                          <label class="field-label" for="tk_email">Correo electrónico</label>
                                          <input type="email" id="tk_email" name="tk_email" class="field-input"
                                                 value="<?php echo esc_attr( $current_user->user_email ); ?>">

                                          <label class="field-label" for="tk_empresa">Empresa</label>
                                          <input type="text" id="tk_empresa" name="tk_empresa" class="field-input"
                                                 value="<?php echo esc_attr( $empresa ); ?>">

                                          <label class="field-label" for="tk_pais">País</label>
                                          <select id="tk_pais" name="tk_pais" class="field-input">
                                              <option value="">- Seleccione -</option>
                                              <?php 
                                              $paises_lista = [
                                              "Afganistán", "Albania", "Alemania", "Andorra", "Angola", "Antigua y Barbuda",
                                              "Arabia Saudita", "Argelia", "Argentina", "Armenia", "Australia", "Austria",
                                              "Azerbaiyán", "Bahamas", "Bangladés", "Barbados", "Baréin", "Bélgica", "Belice",
                                              "Benín", "Bielorrusia", "Birmania", "Bolivia", "Bosnia y Herzegovina", "Botsuana",
                                              "Brasil", "Brunéi", "Bulgaria", "Burkina Faso", "Burundi", "Bután", "Cabo Verde",
                                              "Camboya", "Camerún", "Canadá", "Catar", "Chad", "Chile", "China", "Chipre",
                                              "Ciudad del Vaticano", "Colombia", "Comoras", "Corea del Norte", "Corea del Sur",
                                              "Costa de Marfil", "Costa Rica", "Croacia", "Cuba", "Dinamarca", "Dominica",
                                              "Ecuador", "Egipto", "El Salvador", "Emiratos Árabes Unidos", "Eritrea",
                                              "Eslovaquia", "Eslovenia", "España", "Estados Unidos", "Estonia", "Esuatini",
                                              "Etiopía", "Filipinas", "Finlandia", "Fiyi", "Francia", "Gabón", "Gambia",
                                              "Georgia", "Ghana", "Granada", "Grecia", "Guatemala", "Guinea", "Guinea-Bisáu",
                                              "Guinea Ecuatorial", "Guyana", "Haití", "Honduras", "Hungría", "India", "Indonesia",
                                              "Irak", "Irán", "Irlanda", "Islandia", "Islas Marshall", "Islas Salomón", "Israel",
                                              "Italia", "Jamaica", "Japón", "Jordania", "Kazajistán", "Kenia", "Kirguistán",
                                              "Kiribati", "Kuwait", "Laos", "Lesoto", "Letonia", "Líbano", "Liberia", "Libia",
                                              "Liechtenstein", "Lituania", "Luxemburgo", "Madagascar", "Malasia", "Malaui",
                                              "Maldivas", "Malí", "Malta", "Marruecos", "Mauricio", "Mauritania", "México",
                                              "Micronesia", "Moldavia", "Mónaco", "Mongolia", "Montenegro", "Mozambique",
                                              "Namibia", "Nauru", "Nepal", "Nicaragua", "Níger", "Nigeria", "Noruega",
                                              "Nueva Zelanda", "Omán", "Países Bajos", "Pakistán", "Palaos", "Panamá",
                                              "Papúa Nueva Guinea", "Paraguay", "Perú", "Polonia", "Portugal", "Reino Unido",
                                              "República Centroafricana", "República Checa", "República del Congo",
                                              "República Democrática del Congo", "República Dominicana", "Ruanda", "Rumania",
                                              "Rusia", "Samoa", "San Cristóbal y Nieves", "San Marino",
                                              "San Vicente y las Granadinas", "Santa Lucía", "Santo Tomé y Príncipe", "Senegal",
                                              "Serbia", "Seychelles", "Sierra Leona", "Singapur", "Siria", "Somalia",
                                              "Sri Lanka", "Sudáfrica", "Sudán", "Sudán del Sur", "Suecia", "Suiza", "Surinam",
                                              "Tailandia", "Tanzania", "Tayikistán", "Timor Oriental", "Togo", "Tonga",
                                              "Trinidad y Tobago", "Túnez", "Turkmenistán", "Turquía", "Tuvalu", "Ucrania",
                                              "Uganda", "Uruguay", "Uzbekistán", "Vanuatu", "Venezuela", "Vietnam", "Yemen",
                                              "Yibuti", "Zambia", "Zimbabue"
                                          ];
                                          ?>
                                              <?php foreach ( $paises_lista as $p ): ?>
                                                  <option value="<?php echo esc_attr($p); ?>" 
                                                          <?php selected( $pais, $p ); ?>>
                                                      <?php echo esc_html($p); ?>
                                                  </option>
                                              <?php endforeach; ?>
                                          </select>

                            

                                          <div class="row-forgot">
                                              <label>
                                                  <input type="checkbox" id="tk_newsletter" name="tk_newsletter" value="1"
                                                         <?php checked( $newsletter, '1' ); ?>>
                                                  Acepto recibir información de Imagen de Chile
                                              </label>
                                          </div>

                                          <button type="submit" class="btn-primary" id="tk_profile_submit">
                                              Actualizar datos
                                          </button>

                                          <p class="tk_msg" id="tk_profile_msg" style="display:none;"></p>
                                      </form>


                                  <div class="col-md-12 px-0 mt-5">
                                        <div class="marca-chile-cover__text-title">
                                              <br><br>
                                              <h2 class="noupper">Cambiar Contraseña</h2>
                                        </div>
                                  </div>
                                

                                    <form id="tk_password_form">
                                      <?php wp_nonce_field( 'tk_password_action', 'tk_password_nonce' ); ?>
                                      <input type="hidden" name="action" value="tk_change_password">

                                      <label class="field-label" for="tk_current_pass">Contraseña actual</label>
                                      <input type="password" id="tk_current_pass" name="tk_current_pass" class="field-input">

                                      <label class="field-label" for="tk_new_pass">Nueva contraseña</label>
                                      <input type="password" id="tk_new_pass" name="tk_new_pass" class="field-input withgoal">

                                      <p class="title_goal">Debe tener al menos:</p>
                                      <p id="goal_pass_len">Mínimo 8 caracteres.</p>
                                      <p id="goal_pass_case">Al menos un caracter en minúscula y uno en mayúscula.</p>
                                      <p id="goal_pass_mix" class="goalend">Al menos una letra y número.</p>

                                      <label class="field-label" for="tk_new_pass2">Repetir nueva contraseña</label>
                                      <input type="password" id="tk_new_pass2" name="tk_new_pass2" class="field-input withgoal">

                                      <p id="goal_pass_match" class="goalend">Las contraseñas deben coincidir.</p>

                                      <button type="submit" class="btn-primary" id="tk_password_submit">
                                          Cambiar contraseña
                                      </button>

                                      <p class="tk_msg" id="tk_password_msg" style="display:none;"></p>
                                  </form>



                                  			  
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </section>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

 

<?php

 get_footer();
  ?>

 

 