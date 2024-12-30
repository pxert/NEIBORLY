<?php get_header(); ?>

<section class="principle container-fluid text-center py-5">
  <div class="row align-items-center mx-0 px-5 flex-column-reverse flex-md-row">
    <!-- Colonne du texte -->
    <div class="col-md-6 px-5">
      <p>
        Ensemble, chez <span class="fw-bold fs-2"> Neiborly </span>
        nous créons une communauté solidaire où chaque voisin peut compter sur l'autre.
        L'entraide commence à côté de chez soi.
      </p>
      <div class="d-grid gap-2 d-md-block">
        <?php if ( is_user_logged_in() ) : ?>
          <!-- Boutons pour les utilisateurs connectés -->
          <a href="<?php echo site_url('/aide'); ?>" class="btn fs-6 rounded-pill">Offres d'Aides</a>
          <a href="<?php echo site_url('/demandes-daide'); ?>" class="btn fs-6 rounded-pill">Demandes d'aide</a>
        <?php else : ?>
          <!-- Boutons pour les utilisateurs non connectés -->
          <a href="<?php echo site_url('/registration'); ?>" class="btn fs-6 rounded-pill">Créer une compte</a>
          <a href="<?php echo site_url('/seconnecter'); ?>" class="btn fs-6 rounded-pill">Se connecter</a>
        <?php endif; ?> 
      </div>
    </div>

    <!-- Colonne de l'image -->
    <div class="col-md-6 illustration p-3">
      <img src="<?php echo get_template_directory_uri() . '/assets/img/homes.png'; ?>" 
           alt="Descripción de la imagen" 
           class="img-fluid w-sm-75 w-md-50" />
    </div>
  </div>
</section>




<!-- Section des services dynamiques -->
<section class="section2 container-fluid px-0 py-5">
  <h1 class="text-center mb-5">Ce que notre site vous propose</h1>
  <div class="row gx-3 gy-4">
    <?php
      $services = new WP_Query([
        'post_type' => 'services',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
      ]);

      if ($services->have_posts()): 
        while ($services->have_posts()): 
          $services->the_post(); 
    ?>
      <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card sct2 border-0">
          <div class="card-body d-flex flex-column">
            <div class="icon mb-4 text-center">
              <?php if (has_post_thumbnail()): ?>
                <img 
                  src="<?php the_post_thumbnail_url('medium'); ?>" 
                  class="img-fluid" 
                  alt="<?php the_title(); ?>">
              <?php else: ?>
                <img 
                  src="https://via.placeholder.com/300x200" 
                  class="img-fluid" 
                  alt="Placeholder">
              <?php endif; ?>
            </div>

            <h2 class="fs-5 fw-bold text-center"><?php the_title(); ?></h2>
            <p class="text-muted mb-0 text-justify">
  <?php echo apply_filters('the_content', get_the_content()); ?>
</p>
          </div>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
    <?php else: ?>
      <h5 class="text-center">On a pas encore de services à vous proposer mais ça arrive !</h5>
    <?php endif; ?>
  </div>
</section>





<!--  section3   -->
    
<div class="section3 container-fluid pb-5">
  <h1 class="text-center mb-5" >Rejoignez Neiborly</h1>
  <div class="row m-3">
  
   


      <div class="col-12 col-md-6 mb-4 mb-md-0">
          <div class="card sct3 bg-opacity-30 h-100 mb-0 border-0">
              <div class="card-body p-3">

              <h2 class="px-4 fw-bold">Pourquoi rejoindre NEIBORLY ?</h2>
                      <ul>
                          <li>Une communauté bienveillante et active.</li>
                          <li>Facilité d’échange entre voisins.</li>
                          <li>Promotion d’un mode de vie écoresponsable.</li>
                      </ul>
                
              </div>
          </div>
      </div>
  
  
      <div class="col-12 col-md-6 mb-4 mb-md-0">
          <div class="card sct3 bg-opacity-30 h-100 border-0 mb-0">
              <div class="card-body p-3">

  
                  <h2 class="px-4 fw-bold">Notre vision</h2>
  
                  <ul>
                      <li>Transformer les quartiers en communautés solidaires.</li>
                      <li>Promouvoir l’entraide et les liens sociaux.</li>
                      <li>Mettre à disposition une plateforme simple et accessible.</li>
                  </ul>
  
                  
              </div>
          </div>
      </div>


    </div>


    </div>

</div>   

<!-- section4 -->
<div class="container-fluid section4 py-5">
  <h1 class="text-center mb-4">Témoignages</h1>
  <div class="slider-container d-flex overflow-auto">
    <!-- Card 1 -->
    <div class="slider-item tmg flex-shrink-0" style="width: 300px; scroll-snap-align: start;">
      <div class="card h-100 border-0 text-center">
        <div class="card-body">
          <div class="d-flex align-items-start mb-3 justify-content-start">
            <img src="<?php echo get_template_directory_uri() . '/quote-right-1.svg'; ?>" alt="quote" height="40" width="40">
          </div>
          <p>
            "J'avais besoin d'aide pour monter un meuble, et grâce à Neighborly, un voisin est venu m'aider en moins d'une heure. Une vraie bouffée d'entraide dans le quartier !"
          </p>
          <div class="mt-auto fw-bold">– Sarah, 34 ans</div>
        </div>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="slider-item tmg flex-shrink-0" style="width: 300px; scroll-snap-align: start;">
      <div class="card h-100 border-0 text-center">
        <div class="card-body">
          <div class="d-flex align-items-start mb-3 justify-content-start">
            <img src="<?php echo get_template_directory_uri() . '/quote-right-1.svg'; ?>" alt="quote" height="40" width="40">
          </div>
          <p>
            "Grâce à la plateforme, j'ai pu trouver rapidement une aide précieuse pour mes travaux de bricolage. Le système est simple, efficace et favorise les échanges locaux."
          </p>
          <div class="fw-bold">– Marc, 45 ans</div>
        </div>
      </div>
    </div>
    <!-- Card 3 -->
    <div class="slider-item tmg flex-shrink-0" style="width: 300px; scroll-snap-align: start;">
      <div class="card h-100 border-0 text-center">
        <div class="card-body">
          <div class="d-flex align-items-start mb-3 justify-content-start">
            <img src="<?php echo get_template_directory_uri() . '/quote-right-1.svg'; ?>" alt="quote" height="40" width="40">
          </div>
          <p>
            "Transporter des objets volumineux est toujours compliqué, mais grâce à ce service, un voisin m’a proposé son véhicule et son aide. Une initiative locale exemplaire."
          </p>
          <div class="fw-bold">– Isabelle, 27 ans</div>
        </div>
      </div>
    </div>
    <!-- Card 4 -->
    <div class="slider-item tmg flex-shrink-0" style="width: 300px; scroll-snap-align: start;">
      <div class="card h-100 border-0 text-center">
        <div class="card-body">
          <div class="d-flex align-items-start mb-3 justify-content-start">
            <img src="<?php echo get_template_directory_uri() . '/quote-right-1.svg'; ?>" alt="quote" height="40" width="40">
          </div>
          <p>
            "Une expérience fantastique, j’ai découvert une communauté prête à s’entraider à tout moment."
          </p>
          <div class="fw-bold">– Julien, 32 ans</div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>

