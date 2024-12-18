<?php
/* Template Name: Página Acceso Restringido */
get_header();
?>

<div class="container py-5 text-center">
    <h1>¡Acceso restringido!</h1>
    <p>Lo sentimos, pero necesitas una cuenta para acceder a esta sección.</p>
    <a href="<?php echo site_url('/registration'); ?>" class="btn btn-primary">Crear una cuenta</a>
    <a href="<?php echo site_url('/seconnecter'); ?>" class="btn btn-secondary">Iniciar sesión</a>
    <img src="<?php echo get_template_directory_uri() . '/img/imagen-acceso.png'; ?>" alt="Acceso restringido" class="mt-4">
</div>

<?php get_footer(); ?>



