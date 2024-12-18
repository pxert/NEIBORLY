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



function restrict_pages_to_logged_in_users() {
    if (!is_user_logged_in() && (is_page(['demandes-daide', 'aide', 'second-main', 'profile']))) {
        wp_redirect(home_url('/pana')); // Cambia '/acceso-restringido' por el slug de tu página personalizada.
        exit;
    }
}
add_action('template_redirect', 'restrict_pages_to_logged_in_users');






// Registrar los Custom Post Types 'demandes_aides', 'offres_aides' y 'second_main'
function register_custom_post_types() {
    $post_types = [
        'demandes_aides' => [
            'name'          => 'Demandes d’aide',
            'singular_name' => 'Demande d’aide',
            'slug'          => 'demandes-aides',
            'menu_icon'     => 'dashicons-admin-comments',
        ],
        'offres_aides' => [
            'name'          => 'Offres d’aide',
            'singular_name' => 'Offre d’aide',
            'slug'          => 'offres-aides',
            'menu_icon'     => 'dashicons-hammer',
        ],
        'second_main' => [
            'name'          => 'Second Main',
            'singular_name' => 'Annonce Second Main',
            'slug'          => 'second-main',
            'menu_icon'     => 'dashicons-images-alt2',
        ]
    ];

    foreach ($post_types as $type => $data) {
        register_post_type($type, [
            'labels'      => [
                'name'          => $data['name'],
                'singular_name' => $data['singular_name'],
                'add_new'       => 'Ajouter ' . strtolower($data['singular_name']),
                'add_new_item'  => 'Ajouter une nouvelle ' . strtolower($data['singular_name']),
                'edit_item'     => 'Modifier ' . strtolower($data['singular_name']),
                'view_item'     => 'Voir ' . strtolower($data['singular_name']),
                'search_items'  => 'Rechercher ' . strtolower($data['name']),
            ],
            'public'       => true,
            'has_archive'  => true,
            'rewrite'      => ['slug' => $data['slug']],
            'supports'     => ['title', 'editor', 'author', 'thumbnail'],
            'menu_icon'    => $data['menu_icon'],
        ]);
    }
}
add_action('init', 'register_custom_post_types');

// Manejar inserción de posts desde formularios con AJAX
function handle_post_submission_to_wp_posts() {
    // Verificar petición AJAX y autenticación del usuario
    if (defined('DOING_AJAX') && DOING_AJAX && is_user_logged_in()) {
        // Validar tipos permitidos
        $allowed_types = ['demandes_aides', 'offres_aides', 'second_main'];
        $post_type     = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : '';

        if (!in_array($post_type, $allowed_types)) {
            wp_send_json(['status' => 'error', 'message' => 'Type de publication non valide.']);
            wp_die();
        }

        // Validar y sanitizar datos del formulario
        $nom     = sanitize_text_field($_POST['nom']);
        $demande = sanitize_textarea_field($_POST['demande']);
        $user_id = get_current_user_id();

        // Insertar post
        $post_id = wp_insert_post([
            'post_title'   => $nom,
            'post_content' => $demande,
            'post_status'  => 'publish',
            'post_author'  => $user_id,
            'post_type'    => $post_type,
        ]);

        // Subir imagen y asociar como thumbnail
        if (!is_wp_error($post_id) && !empty($_FILES['image']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');

            // Manejar la subida de la imagen
            $attachment_id = media_handle_upload('image', $post_id);

            // Verificar errores en la subida
            if (is_wp_error($attachment_id)) {
                wp_send_json(['status' => 'error', 'message' => 'Erreur lors du téléchargement de l\'image.']);
                wp_die();
            } else {
                set_post_thumbnail($post_id, $attachment_id);
            }
        }

        // Respuesta de éxito
        if (!is_wp_error($post_id)) {
            wp_send_json(['status' => 'success', 'message' => 'Publication ajoutée avec succès!']);
        } else {
            wp_send_json(['status' => 'error', 'message' => $post_id->get_error_message()]);
        }
        wp_die();
    }
}

// Acciones AJAX
add_action('wp_ajax_insert_post_to_db', 'handle_post_submission_to_wp_posts');
add_action('wp_ajax_nopriv_insert_post_to_db', 'handle_post_submission_to_wp_posts');








// Manejar la actualización del perfil, incluida la subida de imágenes
function update_user_profile() {
    // Verificar si es una petición válida
    if (!is_user_logged_in() || !defined('DOING_AJAX') || !DOING_AJAX) {
        wp_send_json(['status' => 'error', 'message' => 'Accès refusé.']);
        wp_die();
    }

    $current_user_id = get_current_user_id();

    // Actualizar el nombre completo
    if (isset($_POST['first_name'])) {
        update_user_meta($current_user_id, 'first_name', sanitize_text_field($_POST['first_name']));
    }

    // Actualizar el email del usuario
    if (isset($_POST['email'])) {
        wp_update_user([
            'ID'         => $current_user_id,
            'user_email' => sanitize_email($_POST['email']),
        ]);
    }

    // Manejar la subida de la imagen
    if (!empty($_FILES['profile_picture'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        // Subir la imagen
        $attachment_id = media_handle_upload('profile_picture', 0);

        if (is_wp_error($attachment_id)) {
            wp_send_json(['status' => 'error', 'message' => 'Erreur lors de la téléversement de l\'image.']);
            wp_die();
        }

        // Asociar la imagen subida al usuario
        update_user_meta($current_user_id, 'profile_picture', $attachment_id);
    }

    wp_send_json(['status' => 'success', 'message' => 'Profil mis à jour avec succès.']);
    wp_die();
}
add_action('wp_ajax_update_user_profile', 'update_user_profile');




