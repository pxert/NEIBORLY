<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php wp_body_open(); ?>

  <nav class="navbar navbar-expand-lg bg-body-tertiary custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="<?php echo home_url('/'); ?>">
            <img src="<?php echo get_template_directory_uri() . '/logo.svg'; ?>" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php
            if (is_home() || is_front_page() || is_page('second-main-page') || is_page('mentions-legales') || is_page('Politique de confidentialité') || is_page('contact') || is_page('profile') || is_page('Conditions Générales')) :
                wp_nav_menu([
                    'theme_location' => 'header',
                    'container' => false,
                    'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
                    'walker' => new class extends Walker_Nav_Menu {
                        public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                            $classes = empty($item->classes) ? [] : (array) $item->classes;

                            if ($item->title === 'Profile') {
                                $classes[] = 'profile-icon-header';
                            }

                            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
                            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

                            $output .= sprintf(
                                '<li id="menu-item-%s" %s><a href="%s">%s</a>',
                                esc_attr($item->ID),
                                $class_names,
                                esc_url($item->url),
                                $item->title === 'Profile' ? '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>' : esc_html($item->title)
                            );
                        }
                    },
                ]);
            elseif (is_page('demandes-daide') || is_page('aide')) :
            ?>
                <form class="search-form" action="<?php echo home_url('/'); ?>" method="get">
                    <input type="search" placeholder="Recherche" name="s" value="<?php echo get_search_query(); ?>" aria-label="Search">
                    <button type="submit">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/search-1.svg'; ?>" alt="Buscar">
                    </button>
                </form>



        <?php endif; ?>
      </div>
    </div>
  </nav>


  <!-- Bouton de déconnexion flottant -->
  <?php if (is_user_logged_in()) : ?>
    <a href="<?php echo wp_logout_url(home_url()); ?>" id="logoutButton" class="btn btn-danger">
    <span class="logout-icon">🚪</span> Déconnexion
</a>

<?php endif; ?>

