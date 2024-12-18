<?php
/* Template Name: demandes-aides */
?>

<?php get_header(); ?>
<?php echo get_search_form(); ?>

<main class="d-flex flex-nowrap">

    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white p-3">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Sidebar</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <?php
            wp_nav_menu([
                'theme_location' => 'side_menu',
                'container' => false,
                'menu_class' => 'nav flex-column',
                'fallback_cb' => false,
                'items_wrap' => '%3$s',
            ]);
            ?>
        </ul>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content p-4">
        <h1>Demandes d'aide</h1>
        <p>Bienvenue à la page de demandes d’aide.</p>

        <!-- Botón para mostrar el formulario en un pop-up -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formModal">
            J'ai besoin d'aide
        </button>

        <!-- Modal de Bootstrap -->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Remplissez le formulaire</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario -->
                        <form id="postForm">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Votre nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="demande" class="form-label">Décrivez votre besoin</label>
                                <textarea class="form-control" id="demande" name="demande" rows="4" placeholder="Expliquez votre demande" required></textarea>
                            </div>
                            <!-- Campo oculto para el tipo de publicación -->
                            <input type="hidden" name="post_type" value="demandes_aides">
                            <button type="submit" class="btn btn-success">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mostrar las publicaciones -->
        <div id="posts-container" class="posts mt-5">
            <h2 class="mb-4">Dernières demandes</h2>
            <?php
            $args = [
                'post_type'      => 'demandes_aides', // Tipo de publicación
                'posts_per_page' => 10,
                'order'          => 'DESC'
            ];
            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text"><?php the_content(); ?></p>
                            <small class="text-muted">Publié le : <?php echo get_the_date('F j, Y'); ?></small>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            } else {
                echo '<div class="alert alert-warning">Aucune demande trouvée.</div>';
            }
            ?>
        </div>
    </div>

</main>

<!-- JavaScript para enviar el formulario con AJAX -->
<script>
    document.getElementById("postForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append("action", "insert_post_to_db"); // Acción AJAX

        fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert(data.message);
                location.reload(); // Recargar para mostrar la nueva publicación
            } else {
                alert("Erreur : " + data.message);
            }
        })
        .catch(error => console.error("Erreur:", error));
    });
</script>

<?php get_footer(); ?>
