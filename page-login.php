<?php 
/**
 * Template Name: Page Login
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Rediriger si l'utilisateur est déjà connecté
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

get_header(); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login-container">
                <h2 class="text-center">Se connecter</h2>
                
                <?php if (isset($_GET['login']) && $_GET['login'] == 'failed') : ?>
                    <div class="alert alert-danger text-center">
                        <strong>Erreur :</strong> Nom d’utilisateur ou mot de passe incorrect.
                    </div>
                <?php endif; ?>

                <!-- Formulaire de connexion -->
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

            <!-- Lien vers la page d'inscription -->
            <p class="text-center mt-3">
                Vous n'avez pas de compte ? 
                <a href="<?php echo site_url('/registration'); ?>" class="text-decoration-none">Créer un compte</a>
            </p>
        </div>
    </div>
</div>


<?php get_footer(); ?>
