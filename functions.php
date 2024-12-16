<?php
// Habilitar soporte de miniaturas, títulos y menús en el tema
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('menus');

// Registrar menú en el header
register_nav_menu('header', 'En tête du menu');

// Registrar una ubicación para el menú lateral
register_nav_menu('side_menu', 'Side Menu');

// Función para reemplazar el texto "Profile" por un ícono SVG en el menú
function replace_profile_menu_with_svg($item_output, $item, $depth, $args) {
    if ($item->title === 'Profile') {
        $item_output = '<a href="' . esc_url($item->url) . '">';
        $item_output .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">';
        $item_output .= '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>';
        $item_output .= '<circle cx="12" cy="7" r="4"></circle>';
        $item_output .= '</svg>';
        $item_output .= '</a>';
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'replace_profile_menu_with_svg', 10, 4);

// Función para cargar los scripts y estilos
function styles_scripts() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css');
    wp_enqueue_style('app-css', get_template_directory_uri() . '/assets/css/app.css', array(), file_exists(get_template_directory() . '/assets/css/app.css') ? filemtime(get_template_directory() . '/assets/css/app.css') : '1.0');
    wp_enqueue_style('bootstrap-icons', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css');
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true);
    wp_enqueue_script('app-js', get_template_directory_uri() . '/assets/js/app.js', array('bootstrap-bundle'), file_exists(get_template_directory() . '/assets/js/app.js') ? filemtime(get_template_directory() . '/assets/js/app.js') : '1.0', true);
}
add_action('wp_enqueue_scripts', 'styles_scripts');



// Incluir tipos de post personalizados en la búsqueda
function include_custom_post_types_in_search($query) {
    if ($query->is_search() && $query->is_main_query()) {
        $query->set('post_type', ['post', 'faqs', 'services']);
    }
}
add_action('pre_get_posts', 'include_custom_post_types_in_search');

// Agregar clases personalizadas al menú
function menuheader_class($classes, $item, $args) {
    if (in_array('menu-item-has-children', $classes)) {
        $classes[] = 'dropdown';
    }
    $classes[] = 'nav-item';
    return $classes;
}
add_filter('nav_menu_css_class', 'menuheader_class', 10, 3);

function menuheader_link_class($attributes, $item, $args) {
    if (in_array('menu-item-has-children', $attributes)) {
        $attributes['class'] = 'nav-link dropdown-toggle';
    } else {
        $attributes['class'] = 'nav-link';
    }
    return $attributes;
}
add_filter('nav_menu_link_attributes', 'menuheader_link_class', 10, 3);

// Función para verificar roles de usuario
function tf_check_user_role($roles) {
    if (!is_user_logged_in()) {
        return false;
    }
    $user = wp_get_current_user();
    return !empty(array_intersect($user->roles, $roles));
}

$roles = ['contributor'];
if (tf_check_user_role($roles)) {
    add_filter('show_admin_bar', '__return_false');
}

