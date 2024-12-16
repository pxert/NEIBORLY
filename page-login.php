<?php 
/**
 * Template Name: Page Login
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Redirigir si el usuario ya está conectado
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

get_header(); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Se connecter</h2>
                </div>
                <div class="card-body">
                    <?php if ( isset($_GET['login']) && $_GET['login'] == 'failed' ) : ?>
                        <div class="alert alert-danger text-center">
                            <strong>Erreur :</strong> Nom d’utilisateur ou mot de passe incorrect.
                        </div>
                    <?php endif; ?>

                    <!-- Formulario de inicio de sesión -->
                    <?php
                    wp_login_form([
                        'redirect' => home_url(),
                        'label_username' => 'Nom d’utilisateur ou e-mail',
                        'label_password' => 'Mot de passe',
                        'label_remember' => 'Se souvenir de moi',
                        'label_log_in' => 'Connexion',
                        'remember' => true,
                    ]);
                    ?>
                </div>
            </div>

            <!-- Enlace a la página de registro -->
            <p class="text-center mt-3">
                Vous n'avez pas de compte ? 
                <a href="<?php echo site_url('/registration'); ?>" class="text-decoration-none">Créer un compte</a>
            </p>
        </div>
    </div>
</div>

<?php get_footer(); ?>
