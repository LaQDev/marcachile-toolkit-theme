<?php



function fix_pagination_on_pages($query) {
    if (!is_admin() && $query->is_main_query() && is_page()) {
        $query->set('paged', get_query_var('paged'));
    }
}
add_action('pre_get_posts', 'fix_pagination_on_pages');

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;

// 1. MANEJADOR DE DESCARGAS OPTIMIZADO
add_action('init', 'toolkit_handle_download');
function toolkit_handle_download() {
    // Detectamos si viene un POST de descarga del formulario original
    if ( isset($_POST['archivo']) && isset($_POST['my_nonce']) ) {

        if ( ! wp_verify_nonce( $_POST['my_nonce'], 'descargar' ) ) {
            wp_die('Enlace caducado.');
        }

        $file_url = sanitize_text_field($_POST['archivo']);
        $post_id  = 0; // Opcional si quieres trazar el ID
        $user_id  = absint($_POST['userid']);
        $file_name = sanitize_text_field($_POST['nombre']);

        global $wpdb;
        $wpdb->insert("toolkit_descargas", array(
            "id_usuario"     => $user_id,
            "archivo_zip"    => $file_name,
            "fecha_registro" => current_time('mysql'),
            "ruta_archivo"   => $file_url,
        ), array( '%d', '%s', '%s', '%s' ));

        // Cargar AWS SDK si está disponible (el plugin marcachile-toolkit-s3-plugin normalmente lo provee).
        if ( function_exists( 'loadAwsSdk' ) ) {
            loadAwsSdk();
        } elseif ( ! class_exists( '\\Aws\\S3\\S3Client' ) ) {
            $theme_autoload = get_template_directory() . '/toolkit/aws/aws-autoloader.php';
            if ( file_exists( $theme_autoload ) ) {
                require_once $theme_autoload;
            }
        }

        if ( ! class_exists( '\\Aws\\S3\\S3Client' ) ) {
            wp_die( 'No se pudo cargar el SDK de AWS. Contacta al administrador del sitio.' );
        }

        $credentials_file = $_SERVER['DOCUMENT_ROOT'] . "/toolkit/wp-content/plugins/marcachile-toolkit-s3-plugin/includes/aws-credentials.php";
        if ( ! file_exists( $credentials_file ) ) {
            $credentials_file = WP_PLUGIN_DIR . '/marcachile-toolkit-s3-plugin/includes/aws-credentials.php';
        }
        if ( ! file_exists( $credentials_file ) ) {
            wp_die( 'No se encontraron las credenciales de AWS. Contacta al administrador del sitio.' );
        }
        $credentials = include $credentials_file;

        if ( ! is_array( $credentials ) || empty( $credentials['accessKey'] ) || empty( $credentials['secretKey'] ) ) {
            wp_die( 'Credenciales de AWS inválidas. Contacta al administrador del sitio.' );
        }

        $s3_bucket = isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] == "prod" ? "cdn.marcachile2.redon.cl" :  "cdn.marcachile2.redon.cl";

        $s3 = new Aws\S3\S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'credentials' => [
                'key'    => $credentials["accessKey"],
                'secret' => $credentials["secretKey"],
            ],
            'use_aws_shared_config_files' => false,
        ]);

        $file_url_end = basename( $file_url );

        $cmd = $s3->getCommand('GetObject', [
            'Bucket' => $s3_bucket,
            'Key'    => $file_url,
            'ResponseContentDisposition' => 'attachment; filename="'.$file_url_end.'"',
        ]);

        $request = $s3->createPresignedRequest($cmd, '+20 minutes');
        $presignedUrl = (string) $request->getUri();


        // Redirigir para forzar descarga sin recargar la página actual
        wp_redirect($presignedUrl);
        exit;
    }
}
 
add_filter('show_admin_bar', '__return_false');

// 2. FILTRO DE IDIOMA Y ORDEN
add_action('pre_get_posts', function ($q) {
    if (is_admin()) return;

    if ( $q->get('post_type') == 'toolkit' || $q->is_tax('categorias') ) {

        if($_GET['pagina']){
            $q->set("paged",$_GET['pagina']);
        }

        $term = isset($_GET['palabra']) ? sanitize_text_field(wp_unslash($_GET['palabra'])) : '';
        if ( $term !== '' ) {
            $q->set('s', $term);              // búsqueda normal WP
            $q->set('orderby', 'date');
            $q->set('order', 'DESC');
        }

        // Detectar Idioma
        /*$lang = 'ES';
        if (function_exists('weglot_get_current_language')) {
            $wg  = weglot_get_current_language();
            $map = ['es'=>'ES','en'=>'EN','pt'=>'PT'];
            $lang = $map[$wg] ?? strtoupper($wg);
        }

        $meta_query = (array) $q->get('meta_query');
        $meta_query[] = [
            'key'     => 'datos_archivos_0_idioma',
            'value'   => $lang,
            'compare' => '='
        ];*/

        $q->set('meta_query', $meta_query);

        if ( !$q->get('posts_per_page') ){
            $q->set('posts_per_page', 15);
        }

        $q->set('orderby', 'date');
        $q->set('order', 'DESC');

    }

});


/*
add_theme_support( 'post-thumbnails', 
    array( 'post', 'page', 'tookit') 
);
*/
// This theme uses wp_nav_menu() in multiple locations.
register_nav_menus(
    array(
        'header-menu' => __('Header', 'marcachile2020'),
        'footer-menu' => __('Footer', 'marcachile2020'),
        'social-menu' => __('Social Links Footer', 'marcachile2020'),
        'toolkit-sidebar-menu' => __('Toolkit Sidebar', 'marcachile2020'),
    )
);


// ── Toolkit Sidebar Menu: custom icon field on nav_menu_items ──

/**
 * Add an "Icon SVG URL" field to each menu item in the WP Admin editor.
 */
function marcachile_menu_item_icon_field($item_id, $item, $depth, $args)
{
    $icon_url = get_post_meta($item_id, '_menu_item_icon', true);
    ?>
    <p class="field-icon-url description description-wide">
        <label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
            <?php esc_html_e('Icon SVG URL', 'marcachile2020'); ?>
            <input type="text" id="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>" class="widefat"
                name="menu-item-icon[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($icon_url); ?>"
                placeholder="<?php esc_attr_e('/images/ico/toolkit/icon.svg', 'marcachile2020'); ?>" />
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'marcachile_menu_item_icon_field', 10, 4);

/**
 * Save the icon URL when the menu is saved.
 */
function marcachile_save_menu_item_icon($menu_id, $menu_item_db_id)
{
    if (isset($_POST['menu-item-icon'][$menu_item_db_id])) {
        $icon = sanitize_text_field(wp_unslash($_POST['menu-item-icon'][$menu_item_db_id]));
        update_post_meta($menu_item_db_id, '_menu_item_icon', $icon);
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_icon');
    }
}
add_action('wp_update_nav_menu_item', 'marcachile_save_menu_item_icon', 10, 2);


/**
 * Custom Walker for the Toolkit Sidebar menu.
 *
 * Renders the <ul class="sidebar-toolkit"> structure with icons.
 * Top-level items with children → .sidebar-toolkit-sub
 * Top-level items without children → .sidebar-toolkit-link
 * Child items → .sidebar-toolkit-list-link
 */
class Marcachile_Toolkit_Sidebar_Walker extends Walker_Nav_Menu
{

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<ul class="sidebar-toolkit-list">';
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</ul>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $icon_url = get_post_meta($item->ID, '_menu_item_icon', true);
        $classes = (array) $item->classes;

        // Detect current/active state
        $is_active = in_array('current-menu-item', $classes, true)
            || in_array('current-menu-ancestor', $classes, true);

        // Also check cat= parameter
        $current_cat = isset($_GET['cat']) ? sanitize_text_field($_GET['cat']) : '';
        $item_url = $item->url;
        if ($current_cat && strpos($item_url, 'cat=' . $current_cat) !== false) {
            $is_active = true;
        }

        if ($depth === 0) {
            $has_children = !empty($args->walker) && $args->walker->has_children;
            if ($has_children) {
                $li_class = 'sidebar-toolkit-sub';
            } else {
                $li_class = 'sidebar-toolkit-link';
            }
            if ($is_active) {
                $li_class .= ' active';
            }
        } else {
            $li_class = 'sidebar-toolkit-list-link';
            if ($is_active) {
                $li_class .= ' active';
            }
        }

        $output .= '<li class="' . esc_attr($li_class) . '">';

        $icon_html = '';
        if ($icon_url) {
            $icon_html = '<img class="menu-icon" src="' . esc_url($icon_url) . '" width="24" height="24" alt="">';
        }

        $output .= '<a href="' . esc_url($item->url) . '">';
        $output .= $icon_html;
        $output .= esc_html($item->title);
        $output .= '</a>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }
}
add_theme_support('thumbnails');
add_theme_support('post-thumbnails');
add_theme_support('page-thumbnails');
add_theme_support('tookit-thumbnails');

function marcachile_allow_svg_uploads($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter('upload_mimes', 'marcachile_allow_svg_uploads');

/**
 * Sanitiza archivos SVG al subirlos para prevenir XSS almacenado.
 */
function marcachile_sanitize_svg_upload($file)
{
    if ('image/svg+xml' !== $file['type']) {
        return $file;
    }

    $svg_content = file_get_contents($file['tmp_name']);

    // Rechazar SVGs con scripts, event handlers o elementos peligrosos
    $dangerous_patterns = array(
        '/<script\b/i',
        '/on\w+\s*=/i',
        '/<foreignObject/i',
        '/javascript\s*:/i',
        '/data\s*:\s*text\/html/i',
        '/<iframe/i',
        '/<embed/i',
        '/<object/i',
    );

    foreach ($dangerous_patterns as $pattern) {
        if (preg_match($pattern, $svg_content)) {
            $file['error'] = 'El archivo SVG contiene contenido no permitido por razones de seguridad.';
            return $file;
        }
    }

    return $file;
}
add_filter('wp_handle_upload_prefilter', 'marcachile_sanitize_svg_upload');

function clean_vowels($var)
{
    $re_var = trim($var);
    $vowels = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú");
    $vowels2 = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
    $sinacentos = str_replace($vowels, $vowels2, $re_var);
    return $sinacentos;
}



function get_el_excerpt($limit = 100, $source = null)
{
    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, intval($limit));
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    $excerpt = $excerpt . '...';
    return $excerpt;
}
// get_el_excerpt() es una función utilitaria con parámetros, se usa directamente en templates.
// No debe engancharse a wp_head.



function eliminar_acentos($cadena)
{

    //Reemplazamos la A y a
    $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena
    );

    //Reemplazamos la I y i
    $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena
    );

    //Reemplazamos la O y o
    $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena
    );

    //Reemplazamos la U y u
    $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena
    );

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç'),
        array('N', 'n', 'C', 'c'),
        $cadena
    );

    return $cadena;
}

require get_template_directory() . '/toolkit/functions_toolkit.php';







add_action('rest_api_init', function () {
    register_rest_route(
        'toolkits/v2',
        '/subir-archivo-grande/(?P<id>\d+)',
        array(
            'methods' => 'GET',
            'callback' => 'my_awesome_func',
            'permission_callback' => function () {
                return current_user_can('manage_options');
            },
            'args' => array(
                'id' => array(
                    'validate_callback' => function ($param) {
                        return is_numeric($param);
                    },
                    'sanitize_callback' => 'absint',
                ),
            ),
        )
    );
});

function my_awesome_func($data)
{
    global $wpdb;
    include_once(WP_PLUGIN_DIR . '/marcachile-toolkit-s3-plugin/vendor/autoload.php');

    $id = absint($data["id"]);
    if (!empty($id)) {
        $credentials = include_once(WP_PLUGIN_DIR . "/marcachile-toolkit-s3-plugin/includes/aws-credentials.php");

        $aws_credentials = new Aws\Credentials\Credentials($credentials["accessKey"], $credentials["secretKey"]);
        $s3_bucket = isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] == "prod" ? "cdn.marcachile2.redon.cl" : 'cdn.marcachile2.redon.cl';

        $row = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM toolkit_archivos_grandes WHERE id = %d", $id)
        );

        if (!$row) {
            return new WP_Error('not_found', 'Registro no encontrado', array('status' => 404));
        }

        $path = $row->path;
        $ruta_s3 = $row->ruta_s3;
        $post_id = $row->post_id;
        $idioma = $row->idioma;
        $medidas = $row->medidas;

        $s3 = new Aws\S3\S3Client([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => $aws_credentials
        ]);

        $s3->registerStreamWrapper();

        if (file_exists("s3://$s3_bucket/$ruta_s3")) {
            $existe = true;
        } else {
            $existe = false;
        }

        if (!$existe) {
            try {
                $putObject = $s3->putObject([
                    'Bucket' => $s3_bucket,
                    'Key' => $ruta_s3,
                    'Body' => fopen($path, 'r'),
                    'ACL' => 'public-read',
                ]);
                $existe = true;
                echo "Se subió el archivo al bucket: $s3_bucket con la key: $ruta_s3" . PHP_EOL;
            } catch (Aws\S3\Exception\S3Exception $e) {
                echo "Error al subir al S3" . PHP_EOL;
            }
        }

        if ($existe) {
            echo "Inicia actualización en db" . PHP_EOL;
            $nombre = pathinfo($path, PATHINFO_BASENAME);
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $peso = round((filesize($path)) / 1000);

            $row = [
                "nombre_archivo" => $nombre,
                "ruta_de_archivo" => $ruta_s3,
                "idioma" => $idioma,
                "formato" => $ext,
                "peso" => $peso . ' KB',
                "medidas" => $medidas
            ];

            $res3 = add_row('datos_archivos', $row, $post_id);

            $sql_update = $wpdb->update("toolkit_archivos_grandes", ['procesado' => 1], ['id' => $id]);

            if ($sql_update) {
                echo "Record toolkit_archivos_grandes updated successfully" . PHP_EOL;
            } else {
                echo "Error toolkit_archivos_grandes updating record" . PHP_EOL;
            }

            echo "Se añadió correctamente el archivo con id " . $id . PHP_EOL;
        } else {
            echo "Hubo un error al subir el archivo." . PHP_EOL;
        }
    } else {
        echo "falta id";
    }
}




if (!get_role('toolkit')) {
    add_role('toolkit', 'Toolkit', array(
        'read' => true,
        'create_posts' => false,
        'edit_posts' => false,
        'edit_others_posts' => false,
        'publish_posts' => false,
        'manage_categories' => false,
    ));
}



if (function_exists('acf_add_options_page')) {

    acf_add_options_page();

}


add_action('rest_api_init', 'create_custon_endpoint');

function create_custon_endpoint()
{
    register_rest_route(
        'wp/v2',
        '/descargar',
        array(
            'methods' => 'POST',
            'callback' => 'get_response',
            'permission_callback' => function () {
                return is_user_logged_in();
            },
        )
    );
}


function url_sitio_principal()
{

    $url_marca = "https://www.marcachile.cl/";

    return $url_marca;
}



add_action('wp_ajax_nopriv_toolkit_login', 'toolkit_login_callback');
add_action('wp_ajax_toolkit_login', 'toolkit_login_callback');

function toolkit_login_callback()
{

    // Verifica nonce
    check_ajax_referer('toolkit_login_nonce', 'security');

    $user_login = isset($_POST['log']) ? sanitize_text_field($_POST['log']) : '';
    $user_password = isset($_POST['pwd']) ? $_POST['pwd'] : '';
    $remember = !empty($_POST['rememberme']);

    if (empty($user_login) || empty($user_password)) {
        wp_send_json_error('Debes ingresar usuario y contraseña.');
    }

    $creds = array(
        'user_login' => $user_login,
        'user_password' => $user_password,
        'remember' => $remember,
    );

    $user = wp_signon($creds, is_ssl());

    if (is_wp_error($user)) {
        wp_send_json_error($user->get_error_message());
    }

    // URL a donde quieres mandar al usuario logueado
    $redirect = home_url('/toolkit/'); // ajusta el slug

    wp_send_json_success(array(
        'redirect' => $redirect,
    ));
}



// AJAX: registrar usuario desde el formulario del toolkit
add_action('wp_ajax_nopriv_tk_register_user', 'tk_register_user_callback');
add_action('wp_ajax_tk_register_user', 'tk_register_user_callback');

function tk_register_user_callback()
{

    // Verificar nonce
    if (!isset($_POST['tk_register_nonce']) || !wp_verify_nonce($_POST['tk_register_nonce'], 'tk_register_action')) {
        wp_send_json_error(['errors' => ['Error de seguridad, recarga la página e inténtalo de nuevo.']]);
    }

    // Sanitizar datos
    $nombre = isset($_POST['tk_nombre']) ? sanitize_text_field($_POST['tk_nombre']) : '';
    $email = isset($_POST['tk_user']) ? sanitize_email($_POST['tk_user']) : '';
    $pass = isset($_POST['tk_pass']) ? $_POST['tk_pass'] : '';
    $pass2 = isset($_POST['tk_pass2']) ? $_POST['tk_pass2'] : '';
    $pais = isset($_POST['pais']) ? sanitize_text_field($_POST['pais']) : '';
    $politicas = isset($_POST['politicas']) ? $_POST['politicas'] : '';

    $errors = [];

    // Validaciones
    if (empty($nombre)) {
        $errors[] = 'Debes ingresar tu nombre.';
    }

    if (empty($email) || !is_email($email)) {
        $errors[] = 'Debes ingresar un email válido.';
    }

    if (email_exists($email) || username_exists($email)) {
        $errors[] = 'Este email ya se encuentra registrado.';
    }

    if (empty($pass) || empty($pass2)) {
        $errors[] = 'Debes ingresar y repetir la contraseña.';
    } elseif ($pass !== $pass2) {
        $errors[] = 'Las contraseñas no coinciden.';
    }

    // Complejidad de contraseña
    if (strlen($pass) < 8) {
        $errors[] = 'La contraseña debe tener al menos 8 caracteres.';
    }
    if (!preg_match('/[a-z]/', $pass) || !preg_match('/[A-Z]/', $pass)) {
        $errors[] = 'La contraseña debe tener al menos una minúscula y una mayúscula.';
    }
    if (!preg_match('/[0-9]/', $pass) || !preg_match('/[a-zA-Z]/', $pass)) {
        $errors[] = 'La contraseña debe tener al menos una letra y un número.';
    }

    if (empty($pais)) {
        $errors[] = 'Debes seleccionar tu país de origen.';
    }

    if (empty($politicas)) {
        $errors[] = 'Debes aceptar las políticas de privacidad.';
    }

    if (!empty($errors)) {
        wp_send_json_error(['errors' => $errors]);
    }

    // Crear usuario
    $userdata = [
        'user_login' => $email,
        'user_email' => $email,
        'user_pass' => $pass,
        'display_name' => $nombre,
        'first_name' => $nombre,
        'role' => 'subscriber',
    ];

    $user_id = wp_insert_user($userdata);

    if (is_wp_error($user_id)) {
        wp_send_json_error(['errors' => ['Error al crear tu usuario: ' . $user_id->get_error_message()]]);
    }

    // Guardar país
    update_user_meta($user_id, 'pais_origen', $pais);

    // Loguear al usuario
    $creds = [
        'user_login' => $email,
        'user_password' => $pass,
        'remember' => true,
    ];

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        wp_send_json_error(['errors' => ['Tu cuenta fue creada, pero no pudimos iniciar sesión automáticamente. Inicia sesión manualmente.']]);
    }

    // Redirección post-login (ajusta la URL)
    $redirect_url = home_url('/toolkit/'); // cambia por /mi-cuenta/, /dashboard/, etc.

    wp_send_json_success([
        'message' => 'Registro exitoso, redirigiendo…',
        'redirect' => $redirect_url,
    ]);
}


add_action('wp_ajax_tk_update_profile', 'tk_update_profile_callback');

function tk_update_profile_callback()
{
    if (!is_user_logged_in()) {
        wp_send_json_error(['errors' => ['Debes iniciar sesión.']]);
    }

    if (
        !isset($_POST['tk_profile_nonce']) ||
        !wp_verify_nonce($_POST['tk_profile_nonce'], 'tk_profile_action')
    ) {
        wp_send_json_error(['errors' => ['Error de seguridad.']]);
    }

    $user_id = get_current_user_id();
    $nombre = isset($_POST['tk_nombre']) ? sanitize_text_field($_POST['tk_nombre']) : '';
    $email = isset($_POST['tk_email']) ? sanitize_email($_POST['tk_email']) : '';
    $empresa = isset($_POST['tk_empresa']) ? sanitize_text_field($_POST['tk_empresa']) : '';
    $pais = isset($_POST['tk_pais']) ? sanitize_text_field($_POST['tk_pais']) : '';
    $politicas = isset($_POST['tk_politicas']) ? '1' : '0';
    $newsletter = isset($_POST['tk_newsletter']) ? '1' : '0';

    $errors = [];

    if (empty($nombre)) {
        $errors[] = 'El nombre es obligatorio.';
    }

    if (empty($email) || !is_email($email)) {
        $errors[] = 'Debes ingresar un correo electrónico válido.';
    } else {
        $existing = get_user_by('email', $email);
        if ($existing && $existing->ID != $user_id) {
            $errors[] = 'Ese correo ya está siendo utilizado por otro usuario.';
        }
    }

    if (empty($pais)) {
        $errors[] = 'Debes seleccionar un país.';
    }

    if (!empty($errors)) {
        wp_send_json_error(['errors' => $errors]);
    }

    // Actualizar usuario
    $update_data = [
        'ID' => $user_id,
        'user_email' => $email,
        'first_name' => $nombre,
        'last_name' => $nombre,
        'display_name' => $nombre,
    ];

    $result = wp_update_user($update_data);

    if (is_wp_error($result)) {
        wp_send_json_error(['errors' => ['No se pudo actualizar el usuario.']]);
    }

    update_user_meta($user_id, 'empresa', $empresa);
    update_user_meta($user_id, 'pais_origen', $pais);
    update_user_meta($user_id, 'newsletter_aceptado', $newsletter);

    wp_send_json_success(['message' => 'Datos actualizados correctamente.']);
}



add_action('wp_ajax_tk_change_password', 'tk_change_password_callback');

function tk_change_password_callback()
{
    if (!is_user_logged_in()) {
        wp_send_json_error(['errors' => ['Debes iniciar sesión.']]);
    }

    if (
        !isset($_POST['tk_password_nonce']) ||
        !wp_verify_nonce($_POST['tk_password_nonce'], 'tk_password_action')
    ) {
        wp_send_json_error(['errors' => ['Error de seguridad.']]);
    }

    $user_id = get_current_user_id();
    $user = get_user_by('id', $user_id);

    $current = isset($_POST['tk_current_pass']) ? $_POST['tk_current_pass'] : '';
    $new = isset($_POST['tk_new_pass']) ? $_POST['tk_new_pass'] : '';
    $new2 = isset($_POST['tk_new_pass2']) ? $_POST['tk_new_pass2'] : '';

    $errors = [];

    if (empty($current) || empty($new) || empty($new2)) {
        $errors[] = 'Debes completar todos los campos de contraseña.';
    }

    // validar contraseña actual
    if (!wp_check_password($current, $user->user_pass, $user_id)) {
        $errors[] = 'La contraseña actual no es correcta.';
    }

    // reglas de complejidad (mismas del registro)
    if (strlen($new) < 8) {
        $errors[] = 'La nueva contraseña debe tener al menos 8 caracteres.';
    }
    if (!preg_match('/[a-z]/', $new) || !preg_match('/[A-Z]/', $new)) {
        $errors[] = 'La nueva contraseña debe tener al menos una minúscula y una mayúscula.';
    }
    if (!preg_match('/[0-9]/', $new) || !preg_match('/[a-zA-Z]/', $new)) {
        $errors[] = 'La nueva contraseña debe tener al menos una letra y un número.';
    }
    if ($new !== $new2) {
        $errors[] = 'Las nuevas contraseñas no coinciden.';
    }

    if (!empty($errors)) {
        wp_send_json_error(['errors' => $errors]);
    }

    // cambiar contraseña
    wp_set_password($new, $user_id);

    // volver a loguear al usuario con la nueva pass
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id, true);

    wp_send_json_success(['message' => 'Contraseña actualizada correctamente.']);
}


/**
 * Registra y encola todos los assets (CSS / JS) del tema.
 */
function marcachile_enqueue_assets()
{
    $v = wp_get_theme()->get('Version');
    $uri = get_template_directory_uri();

    /* ── CSS ─────────────────────────────────────────────── */
    wp_enqueue_style(
        'google-fonts-opensans',
        'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'font-awesome',
        'https://use.fontawesome.com/releases/v5.14.0/css/all.css',
        array(),
        '5.14.0'
    );

    wp_enqueue_style(
        'fancybox',
        'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css',
        array(),
        '3.5.7'
    );

    wp_enqueue_style(
        'marcachile-bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css',
        array(),
        '5.3.1'
    );

    // FIX: Versionado dinámico para main.css (Cache Busting)
    $main_css_path = get_template_directory() . '/css/main.css';
    $main_css_ver = file_exists($main_css_path) ? filemtime($main_css_path) : $v;

    wp_enqueue_style(
        'marcachile-main',
        $uri . '/css/main.css',
        array('marcachile-bootstrap'),
        $main_css_ver
    );

    /* ── JS ──────────────────────────────────────────────── */

    // WordPress provee jQuery actualizado; lo usamos como dependencia.
    wp_enqueue_script(
        'marcachile-bootstrap',
        $uri . '/js/vendors/bootstrap.min.js',
        array(),
        '5.3.1',
        true
    );

    wp_enqueue_script(
        'masonry-pkgd',
        'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js',
        array(),
        '4.2.2',
        true
    );

    wp_enqueue_script(
        'splide',
        $uri . '/js/vendors/splide.min.js',
        array(),
        '4.1.4',
        true
    );

    // FIX: Versionado dinámico para functions.js
    $js_func_path = get_template_directory() . '/js/functions.js';
    $js_func_ver = file_exists($js_func_path) ? filemtime($js_func_path) : $v;

    wp_enqueue_script(
        'marcachile-functions',
        $uri . '/js/functions.js',
        array('splide'),
        $js_func_ver, // Usamos la fecha de modificación
        true
    );

    wp_enqueue_script(
        'marcachile-accessibility',
        $uri . '/js/accessibility.js',
        array(),
        $v,
        true
    );

    wp_enqueue_script(
        'marcachile-toolkit',
        $uri . '/js/toolkit.js',
        array('jquery'),
        time(),
        true
    );

    // Pasar la URL de admin-ajax.php al JS (reemplaza la URL hardcoded).
    wp_localize_script('marcachile-toolkit', 'marcachile_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));

    wp_enqueue_script(
        'marcachile-toolkit-video',
        $uri . '/js/toolkit-video.js',
        array(),
        $v,
        true
    );

    // NOTA: Se ha eliminado el JS inline ($inline) y se movió a /js/functions.js
    // para evitar conflictos y mejorar el rendimiento de carga.
}
add_action('wp_enqueue_scripts', 'marcachile_enqueue_assets');

/**
 * Añade integrity hash al CSS de Bootstrap (SRI).
 */
function marcachile_bootstrap_sri($html, $handle)
{
    if ('marcachile-bootstrap' === $handle) {
        $html = str_replace(
            "media='all'",
            "media='all' integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin='anonymous'",
            $html
        );
    }
    return $html;
}
add_filter('style_loader_tag', 'marcachile_bootstrap_sri', 10, 2);

?>