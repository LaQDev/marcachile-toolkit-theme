<?php
/**
 * Toolkit Sidebar Navigation
 *
 * Uses the 'toolkit-sidebar-menu' location if a menu is assigned
 * via Apariencia > Menús. Falls back to the hardcoded structure.
 *
 * Each menu item can have an icon set via the "Icon SVG URL" field
 * in the menu editor.  That icon + title are also used in internal
 * category pages (hero and breadcrumb).
 */

if ( has_nav_menu( 'toolkit-sidebar-menu' ) ) :

    wp_nav_menu( array(
        'theme_location' => 'toolkit-sidebar-menu',
        'container'      => false,
        'menu_class'     => 'sidebar-toolkit',
        'walker'         => new Marcachile_Toolkit_Sidebar_Walker(),
        'depth'          => 2,
    ) );

else :

    // ── Fallback: hardcoded sidebar ─────────────────────────
    $current_cat = isset( $_GET["cat"] ) ? sanitize_text_field( $_GET["cat"] ) : '';
    $tpl         = get_template_directory_uri();
?>
<ul class="sidebar-toolkit">
    <li class="sidebar-toolkit-link<?php if ( is_page(48717) ) echo ' active'; ?>">
        <a href="<?php echo esc_url( home_url( '/toolkit/' ) ); ?>">
            <img class="menu-icon" src="<?php echo esc_url( $tpl ); ?>/images/ico/toolkit/ico-toolkit-sidebar-01.svg" width="24" height="24" alt="">
            Inicio
        </a>
    </li>

    <li class="sidebar-toolkit-sub">
        <a href="#">
            <img class="menu-icon" src="<?php echo esc_url( $tpl ); ?>/images/ico/toolkit/ico-toolkit-sidebar-03.svg" width="24" height="24" alt="">
            Recursos Audiovisuales
        </a>
        <ul class="sidebar-toolkit-list">
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'videos' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/videos/?todo=1&cat=videos' ) ); ?>">Vídeos</a>
            </li>
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'footage' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/footage/?todo=1&cat=footage' ) ); ?>">Footage</a>
            </li>
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'fotografia' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/fotografia/?todo=1&cat=fotografia' ) ); ?>">Fotografías</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-toolkit-sub">
        <a href="#">
            <img class="menu-icon" src="<?php echo esc_url( $tpl ); ?>/images/ico/toolkit/ico-toolkit-sidebar-05.svg" width="24" height="24" alt="">
            Datos
        </a>
        <ul class="sidebar-toolkit-list">
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'estudios' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/estudios/?todo=1&cat=estudios' ) ); ?>">Estudios</a>
            </li>
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'infografias' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/infografias/?todo=1&cat=infografias' ) ); ?>">Infografías</a>
            </li>
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'minutas' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/minutas/?todo=1&cat=minutas' ) ); ?>">Minutas</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-toolkit-sub">
        <a href="#">
            <img class="menu-icon" src="<?php echo esc_url( $tpl ); ?>/images/ico/toolkit/ico-toolkit-sidebar-07.svg" width="24" height="24" alt="">
            Ferias y exhibiciones
        </a>
        <ul class="sidebar-toolkit-list">
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'planos-stands' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/planos-stands/?todo=1&cat=planos-stands' ) ); ?>">Planos y Stands</a>
            </li>
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'presentaciones' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/presentaciones/?todo=1&cat=presentaciones' ) ); ?>">Presentaciones</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-toolkit-sub">
        <a href="#">
            <img class="menu-icon" src="<?php echo esc_url( $tpl ); ?>/images/ico/toolkit/ico-toolkit-sidebar-09.svg" width="24" height="24" alt="">
            Manual de uso de Marca
        </a>
        <ul class="sidebar-toolkit-list">
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'manual' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/manual/?todo=1&cat=manual' ) ); ?>">Manual</a>
            </li>
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'logotipo' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/logotipo/?todo=1&cat=logotipo' ) ); ?>">Logotipo</a>
            </li>
            <li class="sidebar-toolkit-list-link<?php if ( $current_cat === 'tipografia' ) echo ' active'; ?>">
                <a href="<?php echo esc_url( home_url( '/categorias/tipografia/?todo=1&cat=tipografia' ) ); ?>">Tipografía</a>
            </li>
        </ul>
    </li>
</ul>
<?php endif; ?>
