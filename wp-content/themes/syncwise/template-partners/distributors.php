<?php
//Template Name: Distributors
wp_enqueue_style('distributors', get_template_directory_uri() . '/assets/dist/css/partners/distributors.css', ['main'], ASSETS_VERSION);

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
<section class="distributors">
    <div class="wrapper">

        <div class="box-svg">
            <?php $svg_file = get_field('svg_digikey');
            if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                echo '<i class="element">';
                echo file_get_contents($svg_file['url']);
                echo '</i>';
            } ?>
        </div>
        <div class="box-content">
            <h2 class="title-content"><?php echo get_field('title_digikey'); ?></h2>
            <p class="description-content"><?php echo get_field('description_digikey'); ?></p>
        </div>
    </div>
</section>
<?php get_template_part('componentes/banner-lets-work'); ?>

<?php
get_footer();
?>