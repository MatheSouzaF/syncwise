<?php
//Template Name: Careers
wp_enqueue_style('Careers', get_template_directory_uri() . '/assets/dist/css/careers/careers.css', ['main'], ASSETS_VERSION);

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
<section class="careers">

    <div class="wrapper">


        <?php
        $careers = get_field('repeater_careers');
        $careers_count = is_array($careers) ? count($careers) : 0;
        ?>

        <div class="box-careers">
            <?php
            if ($careers):
                foreach ($careers as $career):
                    ?>
                    <div class="row-careers">
                        <div class="content-careers">

                            <div class="box-roles display-box">
                                <p class="label-roles grey-100-txt"><?php echo esc_html($career['label_role']); ?></p>
                                <h2 class="title-role blue-txt"><?php echo esc_html($career['title_role']); ?></h2>
                            </div>
                            <div class="box-sub-team display-box">
                                <p class="label-sub-team grey-100-txt"><?php echo esc_html($career['label_sub_team']); ?></p>
                                <h2 class="title-sub-team grey-txt"><?php echo esc_html($career['title_sub-team']); ?></h2>
                            </div>
                            <div class="box-location display-box">
                                <p class="label-location grey-100-txt"><?php echo esc_html($career['label_location']); ?></p>
                                <h2 class="title-location grey-txt"><?php echo esc_html($career['title_location']); ?></h2>
                            </div>
                        </div>
                        <div class="box-link">
                            <?php
                            $link = $career['link_careers'];
                            if ($link):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                    <p><?php echo esc_html($link_title); ?></p>
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>

    </div>
</section>
<?php get_template_part('componentes/banner-lets-work'); ?>

<?php
get_footer() ?>