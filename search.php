<?php get_header(); ?>

<div class="container py-5">
    <h1 class="text-center mb-4">Résultats de recherche pour : "<?php echo get_search_query(); ?>"</h1>
    <div class="row">
    <?php if (have_posts()) { ?>
        <?php while(have_posts()): the_post(); ?>
            <div class="col">
                <div class="card">
                    <?php the_post_thumbnail('medium', [
                        'class' => 'card-img-top',
                        'alt' => 'coucou'
                    ]); ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php the_title(); ?>
                        </h5>
                        <p class="card-text">
                            <?php the_excerpt(); ?>
                        </p>
                        <a
                            href="<?php the_permalink(); ?>"
                            class="btn btn-primary"
                        >
                            Voir plus
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php } else { ?>
        <div class="alert alert-warning text-center">
            Aucun résultat trouvé pour votre recherche.
        </div>
    <?php } ?>
    <?php
    
    // Modificar la consulta para buscar solo en páginas
    $custom_query = new WP_Query([
        'post_type' => 'page', // Solo buscará en páginas
        'posts_per_page' => -1, // Número ilimitado de resultados
        's' => get_search_query(), // Usar la consulta de búsqueda
    ]); // Ejecutar la consulta personalizada

    if ($custom_query->have_posts()) : ?>
        <div class="row">
            <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                            <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Lire la suite</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Navegación de paginación -->
        <div class="pagination">
            <?php echo paginate_links(); ?>
        </div>
    <?php endif;

    // Resetear la consulta después de la búsqueda personalizada
    wp_reset_postdata();
    ?>
</div>
<?php get_footer(); ?>