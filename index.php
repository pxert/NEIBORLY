<?php get_header(); ?>

<section class="bg-pink py-5">
  <div class="container-fluid">
    <div class="row align-items-center">
      <!-- Columna del texto -->
      <div class="col-md-6 text-md-start text-center mb-4 mb-md-0">
        <h1 class="mb-3 fw-bold">Título atractivo</h1>
        <p class="mb-3">Este es un párrafo con información importante. Lorem ipsum dolor sit amet.</p>
        <p class="mb-4">Otro párrafo con más detalles relevantes.</p>
        
        <!-- Botones CTA dinámicos -->
        <div class="d-flex justify-content-md-start justify-content-center gap-3">
          <?php if ( is_user_logged_in() ) : ?>
            <!-- Botones para usuarios conectados -->
            <a href="<?php echo site_url('/aide'); ?>" class="btn btn-primary btn-lg">Offres d'Aides</a>
            <a href="<?php echo site_url('/demandes-daide'); ?>" class="btn btn-outline-secondary btn-lg">Demandes d'aide</a>
          <?php else : ?>
            <!-- Botones para usuarios no conectados -->
            <a href="<?php echo site_url('/registration'); ?>" class="btn btn-primary btn-lg">Créer une compte</a>
            <a href="<?php echo site_url('/seconnecter'); ?>" class="btn btn-outline-secondary btn-lg">Se connecter</a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Columna de la imagen -->
      <div class="col-md-6 text-center">
        <img src="<?php echo get_template_directory_uri() . '/assets/img/homes.png'; ?>" 
             alt="Descripción de la imagen" 
             class="img-fluid" 
             style="max-height: 400px; object-fit: contain;">
      </div>
    </div>
  </div>
</section>

<!-- Botón de desconexión para usuarios conectados -->
<?php if ( is_user_logged_in() ) : ?>
  <div class="logout-button-container text-end px-4 py-2">
    <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-danger btn-sm">Déconnexion</a>
  </div>
 
<?php endif; ?>

<div class="container">
    <div class="row gy-5 mb-5">
        <div class="col-6 col-md-3">
            <?php 
            $article_1 = get_post(48);
            ?>
            <div class="card" style="max-width: 250px; margin: 0 auto;">
                <div class="d-flex align-items-center p-2"></div>

                <a href="<?php echo get_permalink($article_1); ?>">
                    <?php echo get_the_post_thumbnail($article_1->ID, 'medium', [
                        'class' => 'card-img-top'
                    ]); ?>
                </a>

                <div class="card-body">
                    <h5 class="card-title"><?php echo get_the_title($article_1); ?></h5>
                    <p><?php echo wp_trim_words($article_1->post_content, 20); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

