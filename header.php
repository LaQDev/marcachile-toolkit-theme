<?php

$site_url = "https://www.marcachile.cl";
$site_description = "¡This is Chile! 🇨🇱  Descubre su cultura, paisajes, turismo aventura, astronomía, ciencia, gastronomía, innovaciones y productos en un solo lugar.";
$site_description2 = "¡Mostrémosle al mundo lo hermoso que es Chile!";
$get_the_title = "Marca Chile | Toolkit";
$site_author = "Marca Chile";
$img_1200x630 = get_template_directory_uri() . "/images/marca-chile-1200x630.png";
$img_1080x1080 = get_template_directory_uri() . "/images/marca-chile-1080x1080.png";
if (!is_home()) {
    if (is_single()) {
        $get_the_title = get_the_title() . " | Toolkit | Marca Chile";
    } else {
        $get_the_title = get_the_title() . " | Marca Chile";
    }
    if (is_tax()) {
        $tax_name = get_queried_object()->name;
        $get_the_title = $tax_name . " | Toolkit | Marca Chile";
    }
    $site_url = get_permalink(get_the_ID());
    $thumbnail_large = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    if (!empty($thumbnail_large)) {
        $img_1200x630 = $thumbnail_large[0];
        $thumbnail_small = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
        $img_1080x1080 = $thumbnail_small[0];
    }

    $palabra = sanitize_text_field($_GET['palabra']);
    $get_the_title = str_replace("[palabra]",$palabra,$get_the_title);

}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-N4JWV5WD');</script>
    <!-- End Google Tag Manager -->

    <title><?php echo esc_html( $get_the_title ); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="author" content="<?php echo esc_attr( $site_author ); ?>">
    <meta name="copyright" content="Imagen de Chile" />
    <meta name="keywords"
        content="Share Chile, Photostock chile, Photos chile, Videos chile, made by chileans, isla de pascua, araucanía, torres del paine, san pedro de atacama, vino chileno" />
    <meta name="description" content="<?php echo esc_attr( $site_description ); ?>">
    <meta property="og:site_name" content="Toolkit | Marca Chile" />
    <meta property="og:locale" content="es_ES">
    <meta property="og:title" content="<?php echo esc_attr( $get_the_title ); ?>">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo esc_url( $site_url ); ?>" />
    <meta property="og:description" content="<?php echo esc_attr( $site_description2 ); ?>">
    <meta property="og:image:secure_url" content="<?php echo esc_url( $img_1200x630 ); ?>" />
    <meta property="og:image" content="<?php echo esc_url( $img_1200x630 ); ?>" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:alt" content="<?php echo esc_attr( $get_the_title ); ?>" />
    <meta property="og:image" content="<?php echo esc_url( $img_1080x1080 ); ?>" />
    <meta property="og:image:width" content="1080" />
    <meta property="og:image:height" content="1080" />
    <meta property="og:image:alt" content="<?php echo esc_attr( $get_the_title ); ?>" />
    <!--FACEBOOK-->
    <meta property="ia:markup_url" content="<?php echo $site_url; ?>">
    <meta property="ia:rules_url" content="<?php echo $site_url; ?>">
    <!-- <meta property="ia:markup_url_dev" content="<?php echo $site_url; ?>">
<meta property="ia:rules_url_dev" content="<?php echo $site_url; ?>"> -->
    <!--TWITTER-->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="Marca Chile">
    <meta name="twitter:creator" content="@marcachile">
    <meta name="twitter:title" content="<?php echo esc_attr( $get_the_title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $site_description2 ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $img_1200x630 ); ?>">
    <!-- Favicon -->
    <?php $favicon_uri = get_template_directory_uri() . '/images/favicon'; ?>
    <link rel="apple-touch-icon" sizes="57x57"  href="<?php echo esc_url( $favicon_uri ); ?>/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60"  href="<?php echo esc_url( $favicon_uri ); ?>/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72"  href="<?php echo esc_url( $favicon_uri ); ?>/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76"  href="<?php echo esc_url( $favicon_uri ); ?>/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( $favicon_uri ); ?>/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url( $favicon_uri ); ?>/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url( $favicon_uri ); ?>/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url( $favicon_uri ); ?>/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $favicon_uri ); ?>/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url( $favicon_uri ); ?>/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32"  href="<?php echo esc_url( $favicon_uri ); ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96"  href="<?php echo esc_url( $favicon_uri ); ?>/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16"  href="<?php echo esc_url( $favicon_uri ); ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo esc_url( $favicon_uri ); ?>/manifest.json">





    <link rel="canonical" href="<?php echo esc_url( $site_url ); ?>">
    <script type="application/ld+json">
<?php echo wp_json_encode( array(
    '@context'      => 'http://schema.org',
    '@type'         => 'Website',
    'name'          => $get_the_title,
    'url'           => $site_url,
    'image'         => $img_1200x630,
    'alternateName' => 'Imagen de Chile',
    'sameAs'        => array(
        'https://www.facebook.com/MarcaChile.cl',
        'https://twitter.com/marcachile',
        'https://www.instagram.com/marcachile/',
        'https://www.youtube.com/user/ThisisChileWebSite',
    ),
), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>
    <script type="application/ld+json">
<?php echo wp_json_encode( array(
    '@context'      => 'http://schema.org',
    '@type'         => 'WebPage',
    'name'          => $get_the_title,
    'description'   => $site_description,
    'image'         => $img_1200x630,
    'alternateName' => 'Imagen de Chile',
    'sameAs'        => array(
        'https://www.facebook.com/MarcaChile.cl',
        'https://twitter.com/marcachile',
        'https://www.instagram.com/marcachile/',
        'https://www.youtube.com/user/ThisisChileWebSite',
    ),
), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>

    <?php wp_head(); ?>
</head>

<body class="content-<?php echo get_queried_object_id(); ?>">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N4JWV5WD" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    <script>
        // self executing function here
        (function () {
            // your page initialization code here
            // the DOM will be available here
            //jQuery('.sub-menu').wrap('<div class="megamenu"/>').contents();
        })();
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '714337319319231');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=714337319319231&ev=PageView&noscript=1" /></noscript>

    <!-- Global site tag (gtag.js) - Google Ads: 676448968 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-676448968"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'AW-676448968');
    </script>

    <!-- Section 1 - Header -->
    <header class="marca-chile-header__home marca-chile-header__interior marca-chile-header--fixed">
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <div class="marca-chile-header__home-submenu">
                    <a class="navbar-brand" href="<?php echo site_url(); ?>">
                        <span class="navbar-brand-logo"></span>
                    </a>
                </div>

                <div class="marca-chile-header__home-btn">

                    <?php
                    if (is_user_logged_in()) { ?>
                        <div class="dropdown marca-chile-header__home-toolkit">

                            <?php echo do_shortcode('[weglot_switcher]'); ?>

                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/2025/icon_user.svg" alt="Usuario"> Hola, 
                                <?php
                                global $current_user;
                                get_currentuserinfo();

                                if ($current_user->user_firstname):
                                    echo $current_user->user_firstname;

                                else:
                                    echo $current_user->display_name;
                                endif;
                                ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <!--a class="dropdown-item" href="#">Mi cuenta</a-->
                                </li>
                                <li>


                                    <a class="dropdown-item" href="<?php echo esc_url( home_url() ); ?>/mi-cuenta/general/">Mi
                                        Cuenta</a>

                                    <a class="dropdown-item" href="<?php echo esc_url( home_url() ); ?>/logout/">Salir</a>


                                </li>
                            </ul>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </nav>
    </header>

    <!-- Header mobile -->
    <header class="marca-chile-header__mobile marca-chile-header__interior">
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <div class="marca-chile-header__mobile-submenu">


                    <?php if ( is_user_logged_in() ) : ?>
                    <label class="burger" aria-label="Abrir menú">
                        <input type="checkbox" class="burger__toggle" />
                        <span class="burger__line"></span>
                        <span class="burger__line"></span>
                        <span class="burger__line"></span>
                    </label>
                    <?php endif; ?>


                    <a class="navbar-brand" href="<?php echo site_url(); ?>">
                        <span class="navbar-brand-logo"></span>
                    </a>

                    <div class="marca-chile-header__mobile-btn">

                        <?php echo do_shortcode('[weglot_switcher name="short"]'); ?>

                        <?php
                        if (is_user_logged_in()) { ?>


                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/2025/icon_user.svg" alt="Usuario">
                            </button>

                            
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="<?php echo esc_url( home_url() ); ?>/mi-cuenta/general/">Mi
                                        Cuenta</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo esc_url( home_url() ); ?>/logout/">Salir</a>
                                </li>

                            </ul>

                        <?php } ?>

                    </div>

                </div>
            </div>
        </nav>
    </header>