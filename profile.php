<?
/* Template Name: profile */
?>


<?php get_header(); ?>

<!-- Formulario de búsqueda específico para "Offres d'aide" -->
<div class="container mt-4">
    <?php echo get_search_form(); ?>
</div>

<main class="d-flex flex-nowrap">

    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white p-3">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi pe-none me-2" width="40" height="32">
                <use xlink:href="#bootstrap" />
            </svg>
            <span class="fs-4">Sidebar</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- Menú dinámico configurado en "Side Menu" -->
            <?php
            wp_nav_menu([
                'theme_location' => 'side_menu', // Nombre registrado en functions.php
                'container' => false,
                'menu_class' => 'nav flex-column',
                'fallback_cb' => false, // Evitar mostrar un menú vacío si no está configurado
                'items_wrap' => '%3$s', // Elimina el <ul> duplicado
            ]);
            ?>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>Usuario</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">Nuevo proyecto...</a></li>
                <li><a class="dropdown-item" href="#">Configuraciones</a></li>
                <li><a class="dropdown-item" href="#">Perfil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content p-4">
        <h1>Offres d'aide</h1>
        <p>Bienvenido a la página de ofertas de ayuda.</p>
        <div class="alert alert-info" role="alert">
            Este es el contenido principal de la página.
        </div>
    </div>

</main>

<?php get_footer(); ?>
