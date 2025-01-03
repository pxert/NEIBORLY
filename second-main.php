<?php 
/* Template Name: second-main */
?>

<?php get_header(); ?>

<main class="container py-4">
    <h1 class="text-center mb-4">Donnez une Nouvelle Vie à Vos Objets ?</h1>

    <!-- Bouton pour afficher le formulaire dans une pop-up -->
    <div class="text-center mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
            Faire une publication
        </button>
    </div>

    <!-- Modal Bootstrap pour le formulaire -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Ajouter une annonce</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulaire -->
                    <form id="postForm" enctype="multipart/form-data">
                        <input type="hidden" name="post_type" value="second_main"> <!-- Type de publication -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Titre" required>
                        </div>
                        <div class="mb-3">
                            <label for="demande" class="form-label">Description</label>
                            <textarea class="form-control" id="demande" name="demande" rows="3" placeholder="Description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-success">Publier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--  Section pour afficher les publications en grille -->
    <div class="row gx-3 gy-4">
    <?php
    $args = [
        'post_type'      => 'second_main',
        'posts_per_page' => 12,
        'order'          => 'DESC'
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $author_id = get_the_author_meta('ID'); // ID de l'auteur
            $profile_picture = get_user_meta($author_id, 'profile_picture', true);
            $profile_picture_url = $profile_picture ? wp_get_attachment_url($profile_picture) : get_avatar_url($author_id, ['size' => 50]);
            ?>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <!-- Image de la publication -->
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('medium'); ?>" 
                             class="card-img-top img-thumbnail-custom" 
                             alt="<?php the_title(); ?>"
                             data-bs-toggle="modal" 
                             data-bs-target="#imageModal<?php echo get_the_ID(); ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/300x200" class="card-img-top img-thumbnail-custom" alt="Placeholder"
                             data-bs-toggle="modal" 
                             data-bs-target="#imageModal<?php echo get_the_ID(); ?>">
                    <?php endif; ?>

                    <div class="card-body">
                        <!-- Lien vers le profil de l'auteur -->
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?php echo esc_url($profile_picture_url); ?>" alt="Photo de profil" class="rounded-circle me-2" style="width: 50px; height: 50px; object-fit: cover;">
                            <a href="<?php echo esc_url(home_url('/profile/?user_id=' . $author_id)); ?>" class="text-decoration-none fw-bold">
                                <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
                            </a>
                        </div>

                        <h5 class="card-title"><?php the_title(); ?></h5>
                        <p class="card-text"><?php the_excerpt(); ?></p>

                        <!-- Bouton pour voir les coordonnées de l'utilisateur -->
                        <div class="text-center">
                            <a href="<?php echo esc_url(home_url('/profile/?user_id=' . $author_id)); ?>" class="btn btn-outline-primary post-btn">Voir les coordonnées</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal pour afficher l'image complète -->
            <div class="modal fade" id="imageModal<?php echo get_the_ID(); ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="<?php the_post_thumbnail_url('full'); ?>" class="img-fluid" alt="<?php the_title(); ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo '<div class="col-12 text-center alert alert-warning">Aucune annonce trouvée.</div>';
    }
    ?>
</div>
</main>

<!-- JavaScript pour gérer le formulaire avec AJAX -->
<script>
    document.getElementById("postForm").addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append("action", "insert_post_to_db");

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
            alert("Une erreur s'est produite : " + error.message);
        });
    });
</script>

<style>
    /* Adapter les images à la taille de la grille */
    .img-thumbnail-custom {
        object-fit: cover;
        height: 200px;
        width: 100%;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .post-btn {
        background-color: #E4AEB4;
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 50px;
        text-align: center;
        border: none;
        transition: all 0.3s ease;
    }

    .post-btn:hover {
        background-color: #21398F;
        color: white;
    }
</style>

<?php get_footer(); ?>



