<?php
/* Template Name: register-page */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();

// Redirigir si el usuario ya está conectado
if (is_user_logged_in()) {
    wp_redirect(home_url());
exit;
}
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Inscription</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Formulario de Registro -->
            <form method="post" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
            </form>

            <!-- Procesar el formulario de registro -->
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = sanitize_text_field($_POST['username']);
                $email = sanitize_email($_POST['email']);
                $password = $_POST['password'];

                $userdata = array(
                    'user_login' => $username,
                    'user_email' => $email,
                    'user_pass'  => $password,
                );

                $user_id = wp_insert_user($userdata);

                if (!is_wp_error($user_id)) {
                    // Iniciar sesión automáticamente después del registro
                    wp_set_current_user($user_id);
                    wp_set_auth_cookie($user_id);

                    // Redirigir al usuario a la página exclusiva
                    wp_redirect(home_url());
exit;
                } else {
                    echo '<div class="alert alert-danger mt-3 text-center">' . $user_id->get_error_message() . '</div>';
                }
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>