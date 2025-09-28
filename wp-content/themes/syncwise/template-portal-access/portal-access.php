<?php
//Template Name: Portal Access
wp_enqueue_style('portal-access', get_template_directory_uri() . '/assets/dist/css/portal-access/portal-access.css', ['main'], ASSETS_VERSION);
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


<div class="box-portal-access">
    <div class="wrapper">
        <div class="box-repeater">
            <?php
            if (have_rows('repeater_links')):
                while (have_rows('repeater_links')):
                    the_row(); ?>
                    <div class="row-box-repeater">
                        <div class="box-img">
                            <?php
                            $image = get_sub_field('image_repeater_links');
                            if ($image):
                                $image_url = $image['url'];
                                $image_alt = $image['alt']; ?>
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="box-content">

                            <h2 class="titulo-box-links"><?php echo get_sub_field('title_repeater_links'); ?></h2>
                            <div class="box-svg">
                                <?php $svg_file = get_sub_field('svg_repeater_links');
                                if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                                    echo '<i class="element">';
                                    echo file_get_contents($svg_file['url']);
                                    echo '</i>';
                                } ?>
                            </div>

                            <?php
                            $link = get_sub_field('link_repeater_links');
                            if ($link):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                <a class="link-repeater-links btn-v1" href="<?php echo esc_url($link_url); ?>"
                                    target="<?php echo esc_attr($link_target); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18" fill="none">
                                        <path
                                            d="M15 17C15 14.5454 11.866 12.5556 8 12.5556C4.13401 12.5556 1 14.5454 1 17M8 9.88889C5.58375 9.88889 3.625 7.89904 3.625 5.44444C3.625 2.98985 5.58375 1 8 1C10.4162 1 12.375 2.98985 12.375 5.44444C12.375 7.89904 10.4162 9.88889 8 9.88889Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class=""><?php echo esc_html($link_title); ?></p>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile;
            endif; ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>