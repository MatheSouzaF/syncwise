<?php
wp_enqueue_style('Media Center', get_template_directory_uri() . '/assets/dist/css/archive/archive-media-center.css', ['main'], ASSETS_VERSION);
get_header();
?>

<section class="banner-page">
    <div class="box-img">
        <?php
        $image = get_field('imagem_desktop', 'option');
        if ($image):
            $image_url = $image['url'];
            $image_alt = $image['alt']; ?>
            <img class="img-desktop" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
        <?php endif; ?>

        <?php
        $image = get_field('imagem_mobile', 'option');
        if ($image):
            $image_url = $image['url'];
            $image_alt = $image['alt']; ?>
            <img class="img-mobile" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
        <?php endif; ?>
    </div>

</section>
<section class="media-center-post">
    <div class="wrapper">

        <?php
        // Obtém o número da página atual
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'media_center',
            'posts_per_page' => 10,
            'paged' => $paged,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()):
            while ($query->have_posts()):
                $query->the_post(); ?>
                <article class="media-card">
                    <a href="<?php the_permalink(); ?>" class="media-card__link">
                        <div class="box-image-titulo">

                            <div class="media-card__thumb">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="media-card__content">
                                <h3 class="media-card__title blue-txt"><?php the_title(); ?></h3>
                                <?php
                                // Pega os valores separadamente
                                $day = get_the_date('j');
                                $month = get_the_date('F');
                                $year = get_the_date('Y');

                                // Gera o sufixo ordinal
                                $suffix = 'th';
                                if (!in_array($day % 100, [11, 12, 13])) {
                                    switch ($day % 10) {
                                        case 1:
                                            $suffix = 'st';
                                            break;
                                        case 2:
                                            $suffix = 'nd';
                                            break;
                                        case 3:
                                            $suffix = 'rd';
                                            break;
                                    }
                                }
                                ?>

                                <div class="data-card">
                                    <time class="media-card__date blue-txt">
                                        <?php echo $month . ' ' . $day . $suffix . ', ' . $year; ?>
                                    </time>
                                </div>

                                <p class="description-media-card">
                                    <?php echo get_field('text_description'); ?>
                                </p>
                                <p class="label-media-card">Read more ></p>
                            </div>
                        </div>

                    </a>
                </article>

            <?php endwhile;

            wp_reset_postdata();

            // Paginação
            if ($query->max_num_pages > 1) {
                echo '<div class="pagination">';

                $big = 999999999; // need an unlikely integer
        
                echo paginate_links(
                    array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '/page/%#%/',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $query->max_num_pages,
                        'prev_text' => __('&laquo; Anterior'),
                        'next_text' => __('Próxima &raquo;'),
                        'mid_size' => 2,
                        'end_size' => 1,
                        'add_args' => false,
                        'add_fragment' => '',
                    )
                );
                echo '</div>';
            }
        endif;
        ?>
    </div>

</section>

<?php get_template_part('componentes/banner-lets-work'); ?>


<?php
get_footer();
?>