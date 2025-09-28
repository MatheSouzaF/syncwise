<?php
//Template Name: Relationships
wp_enqueue_style('relationships', get_template_directory_uri() . '/assets/dist/css/partners/relationships.css', ['main'], ASSETS_VERSION);

get_header();

?>
<section class="banner-page">
    <div class="box-img">
        <?php
        $image = get_field('banner_image_desktop');
        if ($image):
            $image_url = $image['url'];
            $image_alt = $image['alt']; ?>
            <img class="img-desktop" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
        <?php endif; ?>
        <?php
        $imageMobile = get_field('banner_image_mobile');
        if ($imageMobile):
            $image_url = $imageMobile['url'];
            $image_alt = $imageMobile['alt']; ?>
            <img class="img-mobile" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
        <?php endif; ?>
    </div>
    <h1 class="box-titulo"><?php echo get_field('title_text'); ?></h1>
</section>
<section class="relationships">

    <div class="wrapper">
        <div class="box-relationship-title">
            <?php
            $items = [];

            if (have_rows('relationships_repeater')) {
                while (have_rows('relationships_repeater')) {
                    the_row();
                    $title = get_sub_field('title_relationships');
                    if ($title) {
                        $items[] = $title;
                    }
                }
            }

            if (!empty($items)): ?>
                <div class="box-lista-relationships">
                    <?php foreach ($items as $index => $title): ?>
                        <div class="lista-relationship <?php echo $index === 0 ? 'active' : ''; ?>"
                            data-index="<?php echo $index; ?>">
                            <p><?php echo esc_html($title); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="box-modal">

                <?php
                if (have_rows('relationships_repeater')):
                    $index = 0;
                    while (have_rows('relationships_repeater')):
                        the_row(); ?>
                        <div class="box-svg-modal <?php echo $index === 0 ? 'active' : ''; ?>"
                            data-index="<?php echo $index; ?>">
                            <?php
                            if (have_rows('svg_modal')):
                                while (have_rows('svg_modal')):
                                    the_row(); ?>
                                    <div class="row-modal-svg">
                                        <div class="box-svg">
                                            <?php $svg_file = get_sub_field('svg_relationships');
                                            if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                                                echo '<i class="element">';
                                                echo file_get_contents($svg_file['url']);
                                                echo '</i>';
                                            } ?>
                                        </div>
                                        <div class="modal-svg">
                                            <svg class="close-modal" xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40"
                                                fill="none">
                                                <circle cx="20.624" cy="20" r="20" fill="#00205B" />
                                                <path d="M14.6498 13.75L26.5985 26.25M26.5981 13.75L14.6494 26.25" stroke="white"
                                                    stroke-width="2.5" stroke-linecap="round" />
                                            </svg>
                                            <p class="title-svg"><?php echo get_sub_field('title_relationships_modal'); ?></p>
                                            <p class="description-svg"><?php echo get_sub_field('content_modal'); ?></p>
                                        </div>
                                    </div>

                                <?php endwhile;
                            endif; ?>
                        </div>
                        <?php $index++;
                    endwhile;
                endif; ?>
            </div>
        </div>

    </div>

</section>

<?php get_template_part('componentes/banner-lets-work'); ?>

<?php
get_footer();
?>