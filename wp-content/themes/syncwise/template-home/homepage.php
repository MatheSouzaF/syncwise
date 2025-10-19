<?php
//Template Name: Home
wp_enqueue_style('home', get_template_directory_uri() . '/assets/dist/css/home/home.css', ['main'], ASSETS_VERSION);
get_header();

?>

<section class="banner-home">
    <div class="swiper-container swiper-banner">
        <div class="swiper-wrapper">
            <?php
            if (have_rows('banner_swiper_home')):
                while (have_rows('banner_swiper_home')):
                    the_row(); ?>
            <div class="swiper-slide">
                <div class="background">

                    <?php
                            $video_background = get_sub_field('banner_video');
                            if ($video_background): ?>
                    <video class="video-banner" autoplay="autoplay" src="<?php echo esc_url($video_background); ?>"
                        muted loop play></video>
                    <?php endif; ?>
                    <?php
                            $image = get_sub_field('banner_image');
                            if ($image):
                                $image_url = $image['url'];
                                $image_alt = $image['alt']; ?>
                    <img class="img-desktop" src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>">
                    <?php endif; ?>
                    <?php
                            $imageMobile = get_sub_field('banner_image_mobile');
                            if ($imageMobile):
                                $image_url = $imageMobile['url'];
                                $image_alt = $imageMobile['alt']; ?>
                    <img class="img-mobile" src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>">
                    <?php endif; ?>
                </div>
                <div class="wrapper">
                    <div class="box-textos">
                        <h1 class="title-banner"><?php echo get_sub_field('banner_title'); ?></h1>
                        <p class="description"><?php echo get_sub_field('banner_description'); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile;
            endif;
            ?>
        </div>
        <div class="swiper-pagination">

        </div>
        <!-- <div class="box-buttons">
        </div> -->
    </div>

</section>
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
new Swiper('.swiper-banner', {
    slidesPerView: 1,
    effect: 'fade', // Ativa o fade
    autoplay: {
        delay: 10000, // 10 segundos
        disableOnInteraction: false, // continua o autoplay mesmo após interação do usuário
    },
    fadeEffect: {
        crossFade: true, // Transição suave entre slides
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-btn-next',
        prevEl: '.swiper-btn-prev',
    },
});
</script>




<sectioon class="all-in-one">
    <div class="wrapper">
        <div class="box-textos">
            <h2 class="title-all-in-one blue-txt"><?php echo get_field('title_all-in-one'); ?></h2>
            <p class="description-all-in-one blue-txt"><?php echo get_field('description_all-in-one'); ?></p>
        </div>
    </div>
</sectioon>

<section class="our-expertise">
    <div class="box-our-expertise">

        <?php
        if (have_rows('verticals')):
            while (have_rows('verticals')):
                the_row(); ?>
        <div class="box-expertise">
            <div class="background">
                <?php
                        $image = get_sub_field('image_verticals');
                        if ($image):
                            $image_url = $image['url'];
                            $image_alt = $image['alt']; ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                <?php endif; ?>
                <?php
                        $video_background = get_sub_field('video_background_vertical');
                        if ($video_background): ?>
                <video class="video-banner" autoplay="autoplay" src="<?php echo esc_url($video_background); ?>" muted
                    loop play></video>
                <?php endif; ?>

            </div>
            <div class="box-textos">
                <p class="label-our-expertise"><?php echo get_sub_field('label_verticals'); ?></p>
                <div class="box-svg title-our-expertise">
                    <?php $svg_file = get_sub_field('svg_verticals');
                            if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                                echo '<i class="element">';
                                echo file_get_contents($svg_file['url']);
                                echo '</i>';
                            } ?>
                </div>
                <p class="description-our-expertise"><?php echo get_sub_field('description_verticals'); ?></p>

                <?php
                        $link = get_sub_field('link_verticals');
                        if ($link):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                <a class="box-subtopic" href="<?php echo esc_url($link_url); ?>"
                    target="<?php echo esc_attr($link_target); ?>">
                    <p class=""><?php echo esc_html($link_title); ?></p>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile;
        endif; ?>
    </div>

    <div class="box-our-expertise-mobile">
        <div class="wrapper">

            <div class="swiper our-expertise-swiper">
                <div class="swiper-wrapper">
                    <?php
                    if (have_rows('verticals')):
                        while (have_rows('verticals')):
                            the_row(); ?>
                    <div class="swiper-slide">
                        <div class="box-expertise">
                            <div class="background">
                                <?php
                                        $image = get_sub_field('image_verticals');
                                        if ($image):
                                            $image_url = $image['url'];
                                            $image_alt = $image['alt']; ?>
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="box-textos">
                                <p class="label-our-expertise"><?php echo get_sub_field('label_verticals'); ?></p>
                                <div class="box-svg title-our-expertise">
                                    <?php $svg_file = get_sub_field('svg_verticals');
                                            if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                                                echo '<i class="element">';
                                                echo file_get_contents($svg_file['url']);
                                                echo '</i>';
                                            } ?>
                                </div>
                                <p class="description-our-expertise">
                                    <?php echo get_sub_field('description_verticals'); ?>
                                </p>

                                <?php
                                        $link = get_sub_field('link_verticals');
                                        if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                <a class="box-subtopic" href="<?php echo esc_url($link_url); ?>"
                                    target="<?php echo esc_attr($link_target); ?>">
                                    <p class=""><?php echo esc_html($link_title); ?></p>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile;
                    endif; ?>
                </div>
                <div class="box-buttons">
                    <svg class="swiper-btn-prev" xmlns="http://www.w3.org/2000/svg" width="10" height="16"
                        viewBox="0 0 10 16" fill="none">
                        <path d="M9 1C7.85714 2 3.19048 6.08333 1 8L9 15" stroke="#04174F" />
                    </svg>
                    <svg class="swiper-btn-next" xmlns="http://www.w3.org/2000/svg" width="10" height="16"
                        viewBox="0 0 10 16" fill="none">
                        <path d="M1 1C2.14286 2 6.80952 6.08333 9 8L1 15" stroke="#04174F" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="relationships">
    <div class="wrapper">

        <h2 class="title-relationships blue-txt"><?php echo get_field('title_relationships'); ?></h2>
        <p class="description-relationships blue-txt"><?php echo get_field('description_relationships'); ?></p>
        <div class="container-relationships">

            <div class=" box-relationships">
                <?php
                if (have_rows('logos_relationships')):
                    while (have_rows('logos_relationships')):
                        the_row(); ?>
                <div class="box-svg">
                    <?php $svg_file = get_sub_field('svg_relationships');
                            if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                                echo '<i class="element">';
                                echo file_get_contents($svg_file['url']);
                                echo '</i>';
                            } ?>
                </div>
                <?php endwhile;
                endif;
                ?>

            </div>
        </div>
        <?php
        $link = get_field('link_relationships');
        if ($link):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
        <a class="link-relationships" href="<?php echo esc_url($link_url); ?>"
            target="<?php echo esc_attr($link_target); ?>">
            <p class="blue-txt"><?php echo get_field('label_link_relationships'); ?></p>
        </a>
        <?php endif; ?>
    </div>

</section>


<section class="about-syncwise">

    <div class="background">
        <?php
        $video_background = get_field('video_about_syncwise');
        if ($video_background): ?>
        <video class="video-banner" autoplay="autoplay" src="<?php echo esc_url($video_background); ?>" muted loop
            play></video>
        <?php endif; ?>
        <?php
        $image = get_field('image_desktop_about_syncwise');
        if ($image):
            $image_url = $image['url'];
            $image_alt = $image['alt']; ?>
        <img class="img-desktop" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
        <?php endif; ?>
        <?php
        $imageMobile = get_field('image_mobile_about_syncwise');
        if ($imageMobile):
            $image_url = $imageMobile['url'];
            $image_alt = $imageMobile['alt']; ?>
        <img class="img-mobile" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
        <?php endif; ?>
    </div>
    <div class="wrapper">
        <p class="label-about-syncwise "><?php echo get_field('label_about_syncwise'); ?></p>
        <h2 class="title-about-syncwise color-grey-0"><?php echo get_field('title_about_syncwise'); ?></h2>
        <p class="description-about-syncwise color-grey-0"><?php echo get_field('description_about_syncwise'); ?></p>
        <?php
        $link = get_field('link_about_syncwise');
        if ($link):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
        <a class="link-about-syncwise" href="<?php echo esc_url($link_url); ?>"
            target="<?php echo esc_attr($link_target); ?>">
            <p class="color-grey-0"><?php echo get_field('label_link_about_syncwise'); ?></p>
        </a>
        <?php endif; ?>

    </div>
</section>

<?php get_template_part('componentes/banner-lets-work'); ?>
<?php get_footer() ?>