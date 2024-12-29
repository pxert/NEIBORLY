    <?php
/* Template Name: Página Acceso Restringido */
get_header();
?>

<div class="container py-5 text-center">
    <h1>oups!, il semble que vous souhaitiez en savoir plus!</h1>
    <p>afin de pouvoir aider votre communauté, avant de continuer, n'oubliez pas de vous inscrire ou créer un compte pour continuer!.</p>
    <a href="<?php echo site_url('/registration'); ?>" class="btn btn-primary">Créer une compte</a>
    <a href="<?php echo site_url('/seconnecter'); ?>" class="btn btn-secondary">Se connecter</a>
    
</div>

<?php get_footer(); ?>



