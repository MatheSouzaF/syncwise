<?php
//Template Name: Contact
wp_enqueue_style('Contact', get_template_directory_uri() . '/assets/dist/css/contact/contact.css', ['main'], ASSETS_VERSION);
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


<div class="box-vertical">
    <div class="wrapper">
        <?php
        if (have_rows('repeater_vertical')):
            while (have_rows('repeater_vertical')):
                the_row(); ?>
                <div class="row-vertical">
                    <h2 class="title-vertical"><?php echo get_sub_field('name_vertical'); ?></h2>
                    <div class="box-svg">
                        <?php $svg_file = get_sub_field('svg_vertical');
                        if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                            echo '<i class="element">';
                            echo file_get_contents($svg_file['url']);
                            echo '</i>';
                        } ?>
                    </div>
                    <div class="description-vertical">
                        <?php echo get_sub_field('description_vertical'); ?>
                    </div>
                </div>

            <?php endwhile;
        endif; ?>
    </div>
</div>

<div class="formulario">
    <?php
    // Chamar o formulário CF7 via ACF
    $form_id = get_field('form');
    if ($form_id) {
        echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
    } else {
        echo 'Formulário não configurado.';
    }
    ?>
</div>


<?php
get_footer()
    ?>

