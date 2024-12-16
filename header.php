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
        <?php if (is_home() || is_front_page()) : ?>
          <!-- Navbar principal con botones en Home -->
          <?php
          wp_nav_menu([
            'theme_location' => 'header',
            'container' => false,
            'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0'
          ]);
          ?>
        <?php else : ?>
          <!-- Navbar con barra de búsqueda en el resto de las páginas -->
          <form class="d-flex" action="<?php echo home_url('/'); ?>" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" name="s">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </nav>
