<?php
// Template Name: About Us
wp_enqueue_style('about-us', get_template_directory_uri() . '/assets/dist/css/about-us/about-us.css', ['main'], ASSETS_VERSION);
get_header(); ?>

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

<section class="we-connect">
    <div class="wrapper">
        <?php
        $video_modal = get_field('video_modal');
        if (!empty($video_modal)) {
            $extra_class = ' has-modal';
        }
        ?>
        <div class="box-image-video<?php echo $extra_class; ?> box-img">
            <?php
            $image = get_field('image_we_connect');
            if ($image):
                $image_url = $image['url'];
                $image_alt = $image['alt']; ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
            <?php
            $video_url = get_field('video_we_connect');
            $video_modal = get_field('video_modal');

            ?>
            <div class="video-wrapper">
                <video class="video-banner" autoplay muted loop playsinline
                    src="<?php echo esc_url($video_url); ?>"></video>
            </div>
            <?php if (!empty($video_modal)): ?>
                <svg class="svg-mobile-open-modal" xmlns="http://www.w3.org/2000/svg" width="56" height="56"
                    viewBox="0 0 56 56" fill="none" aria-hidden="true" focusable="false">
                    <circle cx="28" cy="28" r="28" fill="#04174f" />
                    <path d="M24.25 34.4951L24.25 21.5049L35.501 28L24.25 34.4951Z" stroke="white" stroke-width="1.5" />
                </svg>
            <?php endif; ?>
        </div>

        <div class="box-fixed-connectivity">

            <div class="swiper-slide">
                <button class="close-button-about">
                    <div class="box-svg">
                        <svg class="svg" width="35" height="34" viewBox="0 0 35 34" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 1L33.5 33" stroke="white" stroke-width="2" />
                            <path d="M33.5 1L1.5 33" stroke="white" stroke-width="2" />
                        </svg>
                    </div>
                </button>
                <div class="box-video-player-about">
                    <video id="player-connectivity">
                        <source src="<?php echo esc_url(get_field('video_modal')); ?>" type="video/mp4" />
                    </video>
                </div>


            </div>

        </div>
        <div class="box-title-description">
            <h2 class="title-we-connect blue-txt"><?php echo get_field('title_we_connect'); ?></h2>
            <div class="description-we-connect">
                <?php echo get_field('description_we_connect'); ?>
            </div>
        </div>
    </div>
</section>

<div class="vertical-descriptions-texts">
    <h2 class="blue-txt"><?php echo get_field('vertical_description_texts'); ?></h2>
</div>

<div class="content-vertical">
    <div class="wrapper">
        <?php
        if (have_rows('repeater_vetical')):
            while (have_rows('repeater_vetical')):
                the_row();
                $reverse = get_sub_field('reverse_content');
                ?>
                <div class="box-repeater-vertical php <?php echo $reverse ? 'reverse' : ''; ?>">

                    <div class="box-textos">
                        <p class="label-vertical grey-txt"><?php echo get_sub_field('label_vertical'); ?></p>

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

                        <?php
                        $link = get_sub_field('link_vertical');
                        if ($link):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                            <a class="link-vertical" href="<?php echo esc_url($link_url); ?>"
                                target="<?php echo esc_attr($link_target); ?>">
                                <p class="blue-txt"><?php echo get_sub_field("label_link") ?></p>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="box-image-vertical">
                        <?php
                        $image = get_sub_field('vertical_image');
                        if ($image):
                            $image_url = $image['url'];
                            $image_alt = $image['alt']; ?>
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile;
        endif; ?>
    </div>
</div>
<?php get_template_part('componentes/banner-lets-work'); ?>

<?php
get_footer() ?>