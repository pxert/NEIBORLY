<?php  
/* Template Name: demandes-aides */
?>

<?php get_header(); ?>

<main class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <aside class="side-bar flex-column flex-shrink-0 p-3" id="sidebar">
                <h3 class="fw-bold fs-5">Menu Principale</h3>
                <ul class="nav nav-pills flex-column mb-auto">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'side_menu',
                        'container' => false,
                        'menu_class' => 'nav flex-column',
                        'fallback_cb' => false,
                        'items_wrap' => '%3$s',
                        'link_after' => '',
                    ]);
                    ?>
                </ul>
            </aside>
        </div>

        <!-- Contenido Principal -->
        <div class="col-md-9">
            <div class="main-content mx-auto" style="max-width: 800px;">
                <h1 class="text-center mb-4">Demandes d'aide</h1>
                <p class="text-center">Bienvenue à la page de demandes d’aide.</p>  

               <!-- Botón para mostrar el formulario en un pop-up -->
               <div class="text-center mb-4">
                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
                       J'ai besoin d'aide
                   </button>
               </div>

               <!-- Modal de Bootstrap -->
               <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="formModalLabel">Remplissez le formulaire</h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                               <form id="postForm">
                                   <div class="mb-3">
                                       <label for="nom" class="form-label">Titre</label>
                                       <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                                   </div>
                                   <div class="mb-3">
                                       <label for="demande" class="form-label">Décrivez votre besoin</label>
                                       <textarea class="form-control" id="demande" name="demande" rows="4" placeholder="Expliquez votre demande" required></textarea>
                                   </div>
                                   <input type="hidden" name="post_type" value="demandes_aides">
                                   <button type="submit" class="btn btn-success">Publier</button>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>

               <!-- Mostrar las publicaciones -->
               <div id="posts-container" class="posts mt-5">
                   <h2 class="text-center mb-4">Dernières demandes</h2>
                   <?php
                   $args = [
                       'post_type'      => 'demandes_aides',
                       'posts_per_page' => 10,
                       'order'          => 'DESC'
                   ];
                   $query = new WP_Query($args);

                   if ($query->have_posts()) {
                       while ($query->have_posts()) {
                           $query->the_post();
                           $author_id = get_the_author_meta('ID');
                           $author_name = get_the_author_meta('display_name');
                           $profile_link = home_url('/profile/?user_id=' . $author_id);

                           $profile_picture_id = get_user_meta($author_id, 'profile_picture', true);
                           $profile_picture = $profile_picture_id ? wp_get_attachment_url($profile_picture_id) : get_avatar_url($author_id, ['size' => 80]);
                           ?>
                           <div class="post mb-3">
                               <div class="d-flex align-items-center">
                                   <div>    
                                       <img src="<?php echo esc_url($profile_picture); ?>" alt="Photo de profil" class="rounded-pill p-3" style="width: 60px; height: 60px;">
                                   </div>
                                   <div class="fw-bold">
                                       <a href="<?php echo esc_url($profile_link); ?>" class="text-decoration-none">
                                           <?php echo esc_html($author_name); ?>
                                       </a>
                                   </div>
                               </div>
                               <div class="p-3">
                                   <h4><?php the_title(); ?></h4>
                                   <p class="fs-6 py-2"><?php the_content(); ?></p>
                               </div>
                               <div class="d-flex justify-content-between align-items-center">
                                   <small class="text-muted">Publié le : <?php echo get_the_date('F j, Y'); ?></small>
                                   <a href="<?php echo esc_url($profile_link); ?>" class="btn rounded-pill post-btn">
                                   voir les coordonnées
                                   </a>
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
       </div>
   </div>
</main>

<!-- Botón de flecha hacia arriba -->
<a href="#" id="scrollTopButton" class="btn btn-primary rounded-circle" style="display:none; position:fixed; bottom:20px; right:20px; z-index:1000;">
    ↑
</a>

<!-- JavaScript -->
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
        .catch(error => console.error("Erreur:", error));
    });

    // Mostrar/ocultar el botón de scroll
    window.addEventListener("scroll", () => {
        const scrollTopButton = document.getElementById("scrollTopButton");
        if (window.scrollY > 200) {
            scrollTopButton.style.display = "block";
        } else {
            scrollTopButton.style.display = "none";
        }
    });

    // Scroll hacia arriba
    document.getElementById("scrollTopButton").addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
</script>

<?php get_footer(); ?>
