<?php
// Activer le support des vignettes, titres et menus dans le thème
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('menus');

// Enregistrer des menus
function register_custom_menus() {
    register_nav_menus([
        'header'      => __('En tête du menu', 'neiborly'),
        'side_menu'   => __('Side Menu', 'neiborly'),
        'footer_menu' => __('Footer Menu', 'neiborly'),
    ]);
}
add_action('init', 'register_custom_menus');


// Fonction pour remplacer le texte "Profile" par une icône SVG dans le menu
function replace_profile_menu_with_svg($item_output, $item, $depth, $args) {
    // Vérifie si l'élément est "Profile"
    if ($item->title === 'Profile') {
        $custom_class = '';

        // Ajoute des classes selon l'emplacement du menu
        if ($args->theme_location === 'side_menu') {
            $custom_class = 'profile-icon-sidebar';
        } elseif ($args->theme_location === 'header') {
            $custom_class = 'profile-icon-header';
        }

        // Modifie la sortie de l'élément
        $item_output = '<a href="' . esc_url($item->url) . '" class="nav-link ' . esc_attr($custom_class) . '">';
        $item_output .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">';
        $item_output .= '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>';
        $item_output .= '<circle cx="12" cy="7" r="4"></circle>';
        $item_output .= '</svg>';
        $item_output .= '</a>';
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'replace_profile_menu_with_svg', 10, 4);




// Fonction pour charger les scripts et les styles
function styles_scripts() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css');
    wp_enqueue_style('app-css', get_template_directory_uri() . '/assets/css/app.css', array(), file_exists(get_template_directory() . '/assets/css/app.css') ? filemtime(get_template_directory() . '/assets/css/app.css') : '1.0');
    wp_enqueue_style('bootstrap-icons', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css');
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true);

    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=ADLaM+Display&family=Almarai:wght@300;400;700;800&display=swap',
        [],
        null
    );

    wp_enqueue_script('app-js', get_template_directory_uri() . '/assets/js/app.js', array('bootstrap-bundle'), file_exists(get_template_directory() . '/assets/js/app.js') ? filemtime(get_template_directory() . '/assets/js/app.js') : '1.0', true);
}
add_action('wp_enqueue_scripts', 'styles_scripts');




function add_favicon() {
    echo '<link rel="icon" href="' . get_template_directory_uri() . '/GroupLogo-307.svg" type="image/x-icon">';
}
add_action('wp_head', 'add_favicon');


// Inclure des types de publications personnalisés dans la recherche
function include_custom_post_types_in_search($query) {
    if ($query->is_search() && $query->is_main_query()) {
        $query->set('post_type', ['post', 'faqs', 'services']);
    }
}
add_action('pre_get_posts', 'include_custom_post_types_in_search');

// Ajouter des classes personnalisées au menu
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

// Fonction pour vérifier les rôles de l'utilisateur
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
    if (!is_user_logged_in() && (is_page(['demandes-daide', 'aide', 'second-main-page', 'profile']))) {
        wp_redirect(home_url('/pana')); // page acces restrinct
        exit;
    }
}
add_action('template_redirect', 'restrict_pages_to_logged_in_users');



function create_post_type() {	 // function dans la quel j'ajouterais tous mes type de contenu
	register_post_type('services'/* le nom de mon type de contenu */, [ // tableau avec mes options 
		'labels' => [ // ça sera le n   om afficher dans mon menu word press avec la traduction
			'name' => __('Services'), // __() permet a wordpress que c'est contenu de traduction
			'singular_name' => __('Services')
		],
    'supports' => ['title', 'editor', 'thumbnail'], // on precise que notre post_type support title(un titre), editor(l'éditeur de contenu) et thumbnail(une photo a la une)
		'public' => true, // c'est un post_type publique
		'has_archive' => false, // en cas de suppression on peut retrouver notre post disparu
  	'rewrite' => ['slug' => 'services'], // j'applique une réécriture d'url "services" au lieu de "slug"
		'menu_icon' => 'dashicons-clipboard' // je lui précise une icon dans la bar d'outil de l'admin wordpress
	]);
}
add_action('init', 'create_post_type');


// Enregistrer les Custom Post Types 'demandes_aides', 'offres_aides' et 'second_main'
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

// Gérer l'insertion des publications à partir des formulaires avec AJAX
function handle_post_submission_to_wp_posts() {
    // Vérifier la requête AJAX et l'authentification de l'utilisateur
    if (defined('DOING_AJAX') && DOING_AJAX && is_user_logged_in()) {
        // Valider les types autorisés

        $allowed_types = ['demandes_aides', 'offres_aides', 'second_main'];
        $post_type     = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : '';

        if (!in_array($post_type, $allowed_types)) {
            wp_send_json(['status' => 'error', 'message' => 'Type de publication non valide.']);
            wp_die();
        }

        // Valider et assainir les données du formulaire
        $nom     = sanitize_text_field($_POST['nom']);
        $content = '';

        // Traiter le contenu en fonction du formulaire
        if (isset($_POST['offre'])) {
            $content = sanitize_textarea_field($_POST['offre']);
        } elseif (isset($_POST['demande'])) {
            $content = sanitize_textarea_field($_POST['demande']);
        } else {
            wp_send_json(['status' => 'error', 'message' => 'Aucune description fournie.']);
            wp_die();
        }

        $user_id = get_current_user_id();

        // Insérer une publication
        $post_id = wp_insert_post([
            'post_title'   => $nom,
            'post_content' => $content,
            'post_status'  => 'publish',
            'post_author'  => $user_id,
            'post_type'    => $post_type,
        ]);

        // Téléverser une image et l'associer comme vignette
        if (!is_wp_error($post_id) && !empty($_FILES['image']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');

            // Gérer le téléversement de l'image
            $attachment_id = media_handle_upload('image', $post_id);

            // Vérifier les erreurs lors du téléversement
            if (is_wp_error($attachment_id)) {
                wp_send_json(['status' => 'error', 'message' => 'Erreur lors du téléchargement de l\'image.']);
                wp_die();
            } else {
                set_post_thumbnail($post_id, $attachment_id);
            }
        }

        // Réponse en cas de succès
        if (!is_wp_error($post_id)) {
            wp_send_json(['status' => 'success', 'message' => 'Publication ajoutée avec succès!']);
        } else {
            wp_send_json(['status' => 'error', 'message' => $post_id->get_error_message()]);
        }
        wp_die();
    }
}



// Actions AJAX
add_action('wp_ajax_insert_post_to_db', 'handle_post_submission_to_wp_posts');
add_action('wp_ajax_nopriv_insert_post_to_db', 'handle_post_submission_to_wp_posts');







// Gérer la mise à jour du profil, y compris le téléversement d'images
function update_user_profile() {
    // Vérifier si la requête est valide
    if (!is_user_logged_in() || !defined('DOING_AJAX') || !DOING_AJAX) {
        wp_send_json(['status' => 'error', 'message' => 'Accès refusé.']);
        wp_die();
    }

    $current_user_id = get_current_user_id();

    // Mettre à jour le nom complet
    if (isset($_POST['first_name'])) {
        $first_name = sanitize_text_field($_POST['first_name']);
        update_user_meta($current_user_id, 'first_name', $first_name);
    
        // Mettre à jour le nom visible (display_name)
        wp_update_user([
            'ID'           => $current_user_id,
            'display_name' => $first_name
        ]);
    }
    

    // Mettre à jour l'email de l'utilisateur
    if (isset($_POST['email'])) {
        wp_update_user([
            'ID'         => $current_user_id,
            'user_email' => sanitize_email($_POST['email']),
        ]);
    }

    // Gérer le téléversement de l'image
    if (!empty($_FILES['profile_picture'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        // Téléverser l'image
        $attachment_id = media_handle_upload('profile_picture', 0);

        if (is_wp_error($attachment_id)) {
            wp_send_json(['status' => 'error', 'message' => 'Erreur lors de la téléversement de l\'image.']);
            wp_die();
        }

        // Associer l'image téléversée à l'utilisateur
        update_user_meta($current_user_id, 'profile_picture', $attachment_id);
    }

    wp_send_json(['status' => 'success', 'message' => 'Profil mis à jour avec succès.']);
    wp_die();
}
add_action('wp_ajax_update_user_profile', 'update_user_profile');




add_filter('show_admin_bar', function($show) {
    return current_user_can('administrator') ? $show : false;
  });


  add_action('wp_login_failed', 'custom_login_failed_redirect');
function custom_login_failed_redirect($username) {

  $redirect_url = home_url('/seconnecter?login=failed'); 
  wp_redirect($redirect_url);
  exit;
}



add_filter('authenticate', 'custom_login_authenticate_redirect', 30, 3);
function custom_login_authenticate_redirect($user, $username, $password) {

  if (is_wp_error($user)) {
      $redirect_url = home_url('/seconnecterlogin=empty'); 
      if (isset($user->errors['empty_username']) || isset($user->errors['empty_password'])) {
          wp_redirect($redirect_url);
          exit;
      }
  }
  return $user;
}



function custom_site_search($query) {
    // Assurez-vous que cela n'affecte pas l'administration et s'applique uniquement aux recherches.
    if (!is_admin() && $query->is_search) {
        $query->set('post_type', ['post', 'page', 'demandes_aides', 'offres_aides', 'second_main']);
        $query->set('posts_per_page', 10); // Modifi le nombre de resultats si vous voulez.
    }
    return $query;
}
add_action('pre_get_posts', 'custom_site_search');


function enqueue_custom_search_script() {
    wp_enqueue_script('custom-search', get_template_directory_uri() . '/js/custom.js', ['jquery'], '1.0', true);
    wp_localize_script('custom-search', 'ajaxObject', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_search_script');
