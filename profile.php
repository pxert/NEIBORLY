<?php
/* Template Name: Profile */

// Vérifier si l'utilisateur est connecté
if (!is_user_logged_in()) {
    wp_redirect(home_url('/seconnecter')); // Rediriger vers la page de connexion
    exit;
}

// Obtenir l'ID de l'utilisateur à afficher (par URL ou l'actuel)
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : get_current_user_id();
$user_data = get_userdata($user_id);

// Rediriger si l'utilisateur n'existe pas
if (!$user_data) {
    wp_redirect(home_url());
    exit;
}

// Obtenir l'image personnalisée ou l'avatar par défaut
$profile_picture_id = get_user_meta($user_id, 'profile_picture', true);
$profile_picture = $profile_picture_id ? wp_get_attachment_url($profile_picture_id) : get_avatar_url($user_id, ['size' => 150]);

// Vérifier si l'utilisateur actuel est le propriétaire du profil
$is_owner = (get_current_user_id() === $user_id);

get_header();
?>

<main class="container py-4">
    <!-- Titre de la page -->
    <h1 class="text-center">Profil de <?php echo esc_html($user_data->display_name); ?></h1>

    <!-- Photo de profil -->
    <div class="text-center mb-4">
        <img src="<?php echo esc_url($profile_picture); ?>" alt="Photo de profil" class="rounded-circle"
             style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #ccc;">
    </div>

    <!-- Informations du profil -->
    <div class="text-center mb-4">
        <?php if (!empty($user_data->first_name) || !empty($user_data->last_name)): ?>
            <p><strong>Nom complet :</strong> <?php echo esc_html(trim($user_data->first_name . ' ' . $user_data->last_name)); ?></p>
        <?php endif; ?>
        <p><strong>Email :</strong> <a href="mailto:<?php echo esc_attr($user_data->user_email); ?>"><?php echo esc_html($user_data->user_email); ?></a></p>
    </div>

    <!-- Formulaire de mise à jour uniquement pour le propriétaire du profil -->
    <?php if ($is_owner): ?>
        <form id="updateProfileForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="first_name" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                       value="<?php echo esc_attr($user_data->first_name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?php echo esc_attr($user_data->user_email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Photo de profil</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    <?php else: ?>
        <p class="text-center text-muted">
            Vous consultez le profil de <?php echo esc_html($user_data->display_name); ?>.
        </p>
    <?php endif; ?>
</main>

<!-- Script AJAX pour mettre à jour le profil -->
<?php if ($is_owner): ?>
<script>
    document.getElementById("updateProfileForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append("action", "update_user_profile");

        fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert(data.message);
                location.reload();
            } else {
                alert("Erreur : " + data.message);
            }
        })
        .catch(error => {
            console.error("Erreur:", error);
            alert("Une erreur s'est produite, veuillez réessayer.");
        });
    });
</script>
<?php endif; ?>


<?php get_footer(); ?>
