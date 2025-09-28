<?php
//Template Name: Support
wp_enqueue_style('Support', get_template_directory_uri() . '/assets/dist/css/support/support.css', ['main'], ASSETS_VERSION);

get_header();
?>
<div class="banner-container">

    <div class="banner-page" id="tab-1">
        <div class="box-img">
            <?php
            $image = get_field('banner_image_desktop_support');
            if ($image):
                $image_url = $image['url'];
                $image_alt = $image['alt']; ?>
                <img class="img-desktop" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
            <?php
            $imageMobile = get_field('banner_image_mobile_support');
            if ($imageMobile):
                $image_url = $imageMobile['url'];
                $image_alt = $imageMobile['alt']; ?>
                <img class="img-mobile" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
        </div>
        <h1 class="box-titulo"><?php echo get_field('title_text_banner_support'); ?></h1>
    </div>

    <div class="banner-page" id="tab-2">
        <div class="box-img">
            <?php
            $image = get_field('banner_image_desktop_faq');
            if ($image):
                $image_url = $image['url'];
                $image_alt = $image['alt']; ?>
                <img class="img-desktop" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
            <?php
            $imageMobile = get_field('banner_image_mobile_faq');
            if ($imageMobile):
                $image_url = $imageMobile['url'];
                $image_alt = $imageMobile['alt']; ?>
                <img class="img-mobile" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
        </div>
        <h1 class="box-titulo"><?php echo get_field('title_text_banner_faq'); ?></h1>
    </div>

    <div class="banner-page" id="tab-3">
        <div class="box-img">
            <?php
            $image = get_field('banner_image_desktop_modules');
            if ($image):
                $image_url = $image['url'];
                $image_alt = $image['alt']; ?>
                <img class="img-desktop" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
            <?php
            $imageMobile = get_field('banner_image_mobile_modules');
            if ($imageMobile):
                $image_url = $imageMobile['url'];
                $image_alt = $imageMobile['alt']; ?>
                <img class="img-mobile" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
        </div>
        <h1 class="box-titulo"><?php echo get_field('title_text_banner_modules'); ?></h1>
    </div>

    <div class="banner-page" id="tab-4">
        <div class="box-img">
            <?php
            $image = get_field('banner_image_desktop_connectivity');
            if ($image):
                $image_url = $image['url'];
                $image_alt = $image['alt']; ?>
                <img class="img-desktop" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
            <?php
            $imageMobile = get_field('banner_image_mobile_connectivity');
            if ($imageMobile):
                $image_url = $imageMobile['url'];
                $image_alt = $imageMobile['alt']; ?>
                <img class="img-mobile" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
        </div>
        <h1 class="box-titulo"><?php echo get_field('title_text_banner_connectivity'); ?></h1>
    </div>

    <div class="banner-page" id="tab-5">
        <div class="box-img">
            <?php
            $image = get_field('banner_image_desktop_vertical');
            if ($image):
                $image_url = $image['url'];
                $image_alt = $image['alt']; ?>
                <img class="img-desktop" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
            <?php
            $imageMobile = get_field('banner_image_mobile_vertical');
            if ($imageMobile):
                $image_url = $imageMobile['url'];
                $image_alt = $imageMobile['alt']; ?>
                <img class="img-mobile" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
        </div>
        <h1 class="box-titulo"><?php echo get_field('title_text_banner_vertical'); ?></h1>
    </div>
</div>

<div class="tabs-wrapper">
    <ul class="tabs-nav">
        <?php if (have_rows('list_tabs')):
            $i = 0; ?>
            <?php while (have_rows('list_tabs')):
                the_row();
                $i++; ?>
                <li class="tab-item <?php if ($i == 1)
                    echo 'active'; ?>" data-tab="tab-<?php echo $i; ?>">
                    <?php the_sub_field('tab_text'); ?>
                </li>
            <?php endwhile; ?>
        <?php endif; ?>
    </ul>
    <div class="box-select">

        <select class="tabs-select">
            <?php if (have_rows('list_tabs')):
                $i = 0;
                while (have_rows('list_tabs')):
                    the_row();
                    $i++;
                    $tab_text = get_sub_field('tab_text'); ?>
                    <option value="tab-<?php echo $i; ?>" <?php if ($i == 1)
                           echo 'selected'; ?>>
                        <?php echo esc_html($tab_text); ?>
                    </option>
                <?php endwhile;
            endif; ?>
        </select>

    </div>
</div>


<div class="tabs-support call-links" id="content-tab-1">

    <div class="wrapper">
        <div class="support-call">
            <?php
            if (have_rows('call_links')):
                while (have_rows('call_links')):
                    the_row(); ?>
                    <div class="row-call-links">
                        <div class="box-svg">
                            <?php $svg_file = get_sub_field('svg_call_links');
                            if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                                echo '<i class="element">';
                                echo file_get_contents($svg_file['url']);
                                echo '</i>';
                            } ?>
                        </div>
                        <h3 class="title-support-call"><?php echo get_sub_field('title_call_links'); ?></h3>
                        <?php
                        $link = get_sub_field('link_call_links');
                        if ($link):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                            <a class="link-call" href="<?php echo esc_url($link_url); ?>"
                                target="<?php echo esc_attr($link_target); ?>">
                                <p class=""><?php echo esc_html($link_title); ?></p>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endwhile;
            endif; ?>

        </div>
        <div class="formulario">
            <?php
            // Chamar o formulário CF7 via ACF
            $form_id = get_field('formulario_support');
            if ($form_id) {
                echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
            } else {
                echo 'Formulário não configurado.';
            }
            ?>
        </div>
    </div>
</div>


<div class="tabs-support faq" id="content-tab-2">
    <div class="wrapper">
        <h2 class="titulo-faq"><?php echo get_field('title_faq'); ?></h2>

        <div class="box-repetidor-accordion">
            <?php
            if (have_rows('repeater_faq')):
                while (have_rows('repeater_faq')):
                    the_row(); ?>
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <h3 class="accordion-title"><?php echo get_sub_field(selector: 'title_accordion_faq'); ?></h3>
                            <i>

                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                                    <path d="M6 12L19.5 26L33 12" stroke="#04174F" />
                                </svg>
                            </i>
                        </div>
                        <div class="accordion-content">
                            <p><?php echo get_sub_field('description_accordion_faq'); ?></p>
                        </div>
                    </div>
                <?php endwhile;
            endif; ?>
        </div>
    </div>

</div>

<div class="tabs-support modules" id="content-tab-3">
    <div class="wrapper">
        <?php
        if (have_rows('box_modules')):
            while (have_rows('box_modules')):
                the_row(); ?>
                <div class="box-content-modules">

                    <h2 class="title-module"><?php echo get_sub_field('title_iot_modules'); ?></h2>
                    <div class="box-cards-module">
                        <?php
                        if (have_rows('box_cards_iot_modules')):
                            while (have_rows('box_cards_iot_modules')):
                                the_row(); ?>
                                <div class="row-cards-module">
                                    <div class="box-img">
                                        <?php
                                        $image = get_sub_field('image_cards_iot_modules');
                                        if ($image):
                                            $image_url = $image['url'];
                                            $image_alt = $image['alt']; ?>
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="title-cards-modules"><?php echo get_sub_field('title_cards_iot_modules'); ?></h3>
                                    <p class="description-cards-modules">
                                        <?php echo get_sub_field('description_card_iot_modules'); ?>
                                    </p>
                                    <?php
                                    $link = get_sub_field('link_card_iot_modules');
                                    if ($link):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                        <a class="link-card-module" href="<?php echo esc_url($link_url); ?>"
                                            target="<?php echo esc_attr($link_target); ?>">
                                            <p class=""><?php echo esc_html($link_title); ?></p>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </div>
            <?php endwhile;
        endif; ?>
        <div class="container-acc">
            <h2 class="titulo-faq"><?php echo get_field('title_accordion_iot_modules'); ?></h2>

            <div class="box-repetidor-accordion">
                <?php
                if (have_rows('accordion_iot_modules')):
                    while (have_rows('accordion_iot_modules')):
                        the_row(); ?>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <h3 class="accordion-title">
                                    <?php echo get_sub_field(selector: 'title_accordion_iot_modules'); ?>
                                </h3>
                                <i>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38"
                                        fill="none">
                                        <path d="M6 12L19.5 26L33 12" stroke="#04174F" />
                                    </svg>
                                </i>
                            </div>
                            <div class="accordion-content">
                                <p><?php echo get_sub_field('description_accordion_iot_modules'); ?></p>
                            </div>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>

        <div class="formulario">
            <?php
            $form_id = get_field('formulario_iot_modules');
            if ($form_id) {
                echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
            } else {
                echo 'Formulário não configurado.';
            }
            ?>
        </div>

    </div>
</div>


<div class="tabs-support modules" id="content-tab-4">
    <div class="wrapper">

        <div class="container-acc">
            <h2 class="titulo-faq"><?php echo get_field('title_connectivity'); ?></h2>

            <div class="box-repetidor-accordion">
                <?php
                if (have_rows('accordion_connectivity')):
                    while (have_rows('accordion_connectivity')):
                        the_row(); ?>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <h3 class="accordion-title">
                                    <?php echo get_sub_field(selector: 'title_accordion_connectivity'); ?>
                                </h3>
                                <i>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38"
                                        fill="none">
                                        <path d="M6 12L19.5 26L33 12" stroke="#04174F" />
                                    </svg>
                                </i>
                            </div>
                            <div class="accordion-content">
                                <p><?php echo get_sub_field('description_connectivity'); ?></p>
                            </div>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>

        <div class="formulario">
            <?php
            $form_id = get_field('formulario_connectivity');
            if ($form_id) {
                echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
            } else {
                echo 'Formulário não configurado.';
            }
            ?>
        </div>

    </div>
</div>

<div class="tabs-support modules" id="content-tab-5">
    <div class="wrapper">

        <div class="container-acc">
            <h2 class="titulo-faq"><?php echo get_field('title_vertical_integration'); ?></h2>

            <div class="box-repetidor-accordion">
                <?php
                if (have_rows('accordion_vertical_integration')):
                    while (have_rows('accordion_vertical_integration')):
                        the_row(); ?>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <h3 class="accordion-title">
                                    <?php echo get_sub_field(selector: 'title_accordion_vertical_integration'); ?>
                                </h3>
                                <i>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38"
                                        fill="none">
                                        <path d="M6 12L19.5 26L33 12" stroke="#04174F" />
                                    </svg>
                                </i>
                            </div>
                            <div class="accordion-content">
                                <p><?php echo get_sub_field('description_vertical_integration'); ?></p>
                            </div>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>

        <div class="formulario">
            <?php
            $form_id = get_field('formulario_vertical_integration');
            if ($form_id) {
                echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
            } else {
                echo 'Formulário não configurado.';
            }
            ?>
        </div>

    </div>
</div>

<?php get_template_part('componentes/banner-lets-work'); ?>

<?php
get_footer();
?>