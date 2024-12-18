<?php
/* Template Name: Profile */

// Obtener el usuario actual
$current_user = wp_get_current_user();

// Obtener la imagen personalizada o la predeterminada
$profile_picture_id = get_user_meta($current_user->ID, 'profile_picture', true);
$profile_picture = $profile_picture_id ? wp_get_attachment_url($profile_picture_id) : get_avatar_url($current_user->ID, ['size' => 150]);

get_header();
?>

<main class="container py-4">
    <h1 class="text-center">Profil de <?php echo esc_html($current_user->display_name); ?></h1>
    <!-- Mostrar la imagen de perfil -->
    <div class="text-center mb-4">
        <img src="<?php echo esc_url($profile_picture); ?>" alt="Photo de profil" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #ccc;">
    </div>

    <!-- Formulario para actualizar perfil -->
    <form id="updateProfileForm" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="first_name" class="form-label">Nom complet</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo esc_attr($current_user->first_name); ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo esc_attr($current_user->user_email); ?>" required>
        </div>
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Photo de profil</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</main>

<script>
    // Script AJAX para actualizar el perfil
    document.getElementById("updateProfileForm").addEventListener("submit", function(e) {
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
        .catch(error => console.error("Erreur:", error));
    });
</script>

<?php get_footer(); ?>

