<?php
//Template Name: SyncIot Main
wp_enqueue_style('synciot-main', get_template_directory_uri() . '/assets/dist/css/synciot-main/synciot-main.css', ['main'], ASSETS_VERSION);

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
    <div class="box-svg">
        <?php $svg_file = get_field('title_svg');
        if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
            echo '<i class="element">';
            echo file_get_contents($svg_file['url']);
            echo '</i>';
        } ?>
    </div>
</section>

<div class="tabs-wrapper">
    <?php if (have_rows('list_tabs')): ?>
        <ul class="tabs-nav">
            <?php while (have_rows('list_tabs')):
                the_row();
                $tab_text = get_sub_field('tab_text');
                $slug = sanitize_title($tab_text);        // WordPress slug helper
                $tab_id = 'tab-' . get_row_index();              // ou qualquer ID único
                ?>
                <li class="tab-item" data-tab="<?php echo esc_attr($tab_id); ?>" data-slug="<?php echo esc_attr($slug); ?>">
                    <?php echo esc_html($tab_text); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>

    <div class="box-select">

        <select class="tabs-select">
            <?php while (have_rows('list_tabs')):
                the_row();
                $tab_text = get_sub_field('tab_text');
                $slug = sanitize_title($tab_text);
                $tab_id = 'tab-' . get_row_index();
                ?>
                <option value="<?php echo esc_attr($tab_id); ?>" data-slug="<?php echo esc_attr($slug); ?>">
                    <?php echo esc_html($tab_text); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="11" viewBox="0 0 18 11" fill="none">
            <path d="M17 1L9 9L1 0.999999" stroke="#00205B" stroke-width="2" />
        </svg>
    </div>
</div>

<div class="tabs-content sync active" id="tab-1">
    <div class="wrapper">
        <div class="box-content">
            <p class="label-synciq"><?php echo get_field('label_synciot'); ?></p>
            <div class="box-svg">
                <?php $svg_file = get_field('svg_synciot');
                if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                    echo '<i class="element">';
                    echo file_get_contents($svg_file['url']);
                    echo '</i>';
                } ?>
            </div>
            <p class="description-synciq">
                <?php echo get_field('description_synciot'); ?>
            </p>
            <div class="box-repeater-item">
                <?php
                if (have_rows('repeater_itens_synciot')):
                    while (have_rows('repeater_itens_synciot')):
                        the_row(); ?>
                        <div class="row-item">
                            <i>

                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14 28.5C15.8385 28.5 17.659 28.1379 19.3576 27.4343C21.0561 26.7307 22.5995 25.6995 23.8995 24.3995C25.1995 23.0995 26.2307 21.5561 26.9343 19.8576C27.6379 18.159 28 16.3385 28 14.5C28 12.6615 27.6379 10.841 26.9343 9.14243C26.2307 7.44387 25.1995 5.90052 23.8995 4.6005C22.5995 3.30048 21.0561 2.26925 19.3576 1.56569C17.659 0.862121 15.8385 0.5 14 0.5C10.287 0.5 6.72601 1.975 4.1005 4.6005C1.475 7.22601 0 10.787 0 14.5C0 18.213 1.475 21.774 4.1005 24.3995C6.72601 27.025 10.287 28.5 14 28.5Z"
                                        fill="#04174F" />
                                    <path d="M8 14.2773L12.5962 18.8735L20.3744 11.0954" stroke="white" stroke-width="2" />
                                </svg>
                            </i>
                            <p class="item-text">
                                <?php echo get_sub_field('label_itens_repeater_synciot'); ?>
                            </p>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
            <p class="description-synciq">
                <?php echo get_field('descriptions_synciot_02'); ?>
            </p>
            <?php
            $link = get_field('lets_talk');
            if ($link):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                <a class="link-lets btn-v1" href="<?php echo esc_url($link_url); ?>"
                    target="<?php echo esc_attr($link_target); ?>">
                    <p class=""><?php echo esc_html($link_title); ?></p>
                </a>
            <?php endif; ?>
        </div>
        <div class="box-image-video">
            <div class="swiper-container swiper-colecoes">
                <div class="swiper-wrapper">
                    <?php if (have_rows('video_or_image_synciot_')): ?>
                        <?php while (have_rows('video_or_image_synciot_')):
                            the_row(); ?>
                            <?php
                            $slide_index = get_row_index() - 1; // 0-based
                            $extra_class = ''; // inicializa vazio
                    
                            if (get_row_layout() == 'video_synciot') {
                                $video_modal = get_sub_field('video_modal');
                                if (!empty($video_modal)) {
                                    $extra_class = ' has-modal';
                                }
                            } elseif (get_row_layout() == 'image_synciot') {
                                $image_has_modal = get_sub_field('video_modal_imagem');
                                if (!empty($image_has_modal)) {
                                    $extra_class = ' has-modal';
                                }
                            }
                            ?>
                            <div class="swiper-slide<?php echo $extra_class; ?>"
                                data-slide-index="<?php echo esc_attr($slide_index); ?>">
                                <?php if (get_row_layout() == 'video_synciot'):
                                    $video_url = get_sub_field('video_synciot');
                                    $video_modal = get_sub_field('video_modal');
                                    if ($video_url): ?>
                                        <div class="video-wrapper">
                                            <video class="video-banner" autoplay muted loop playsinline
                                                src="<?php echo esc_url($video_url); ?>"></video>
                                        </div>

                                        <?php if (!empty($video_modal)): ?>
                                            <svg class="svg-mobile-open-modal" xmlns="http://www.w3.org/2000/svg" width="56" height="56"
                                                viewBox="0 0 56 56" fill="none" aria-hidden="true" focusable="false">
                                                <circle cx="28" cy="28" r="28" fill="#04174f" />
                                                <path d="M24.25 34.4951L24.25 21.5049L35.501 28L24.25 34.4951Z" stroke="white"
                                                    stroke-width="1.5" />
                                            </svg>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                <?php elseif (get_row_layout() == 'image_synciot'):
                                    $image = get_sub_field('image_synciot');
                                    $image_has_modal = get_sub_field('video_modal_imagem');
                                    if (!empty($image)):
                                        $image_url = $image['url'] ?? '';
                                        $image_alt = $image['alt'] ?? ''; ?>
                                        <div class="image-wrapper">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                            <?php if (!empty($image_has_modal)): ?>
                                                <svg class="svg-mobile-open-modal" xmlns="http://www.w3.org/2000/svg" width="56" height="56"
                                                    viewBox="0 0 56 56" fill="none" aria-hidden="true" focusable="false">
                                                    <circle cx="28" cy="28" r="28" fill="#04174f" />
                                                    <path d="M24.25 34.4951L24.25 21.5049L35.501 28L24.25 34.4951Z" stroke="white"
                                                        stroke-width="1.5" />
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="box-fixed">
            <?php if (have_rows('video_or_image_synciot_')): ?>
                <?php while (have_rows('video_or_image_synciot_')):
                    the_row(); ?>
                    <?php $slide_index = get_row_index() - 1; // 0-based, igual ao de cima ?>
                    <div class="swiper-slide" data-slide-index="<?php echo esc_attr($slide_index); ?>">
                        <?php if (get_row_layout() == 'video_synciot'): ?>
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
                                <video id="player-about">
                                    <source src="<?php echo esc_url(get_sub_field('video_modal')); ?>" type="video/mp4" />
                                </video>
                            </div>

                        <?php elseif (get_row_layout() == 'image_synciot'): ?>
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
                                <video id="player-about">
                                    <source src="<?php echo esc_url(get_sub_field('video_modal_imagem')); ?>" type="video/mp4" />
                                </video>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>




    </div>
</div>

<div class="tabs-content box-gnss" id="tab-2">
    <div class="gnss-swiper">

        <div class="wrapper">

            <div class="box-thumbnail">
                <p class="label-all-modules"><?php echo get_field('label_all_modules'); ?></p>
                <div class="swiper-wrapper">
                    <?php if (have_rows('repeater_gnss')):
                        $i = 0; ?>
                        <?php while (have_rows('repeater_gnss')):
                            the_row(); ?>
                            <div class="box-swiper-slide" data-index="<?php echo esc_attr($i); ?>" role="button" tabindex="0"
                                aria-controls="gnss-panel-<?php echo esc_attr($i); ?>">
                                <div class="box-text">
                                    <h3 class="titulo-thumb"><?php echo get_sub_field('title_repeater_gnss'); ?></h3>
                                    <p class="sub-titulo-thumb"><?php echo get_sub_field('label_repeater_gnss'); ?></p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="17" viewBox="0 0 23 17" fill="none">
                                    <path d="M0 8.5H22M22 8.5L13.6829 0.5M22 8.5L13.6829 16.5" stroke="white" />
                                </svg>
                            </div>
                            <?php $i++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box-slider">
                <div class="swiper-wrapper">
                    <?php if (have_rows('repeater_gnss')):
                        $j = 0; ?>
                        <?php while (have_rows('repeater_gnss')):
                            the_row(); ?>
                            <div class="box-swiper-slide-content" data-index="<?php echo esc_attr($j); ?>"
                                id="gnss-panel-<?php echo esc_attr($j); ?>"
                                aria-hidden="<?php echo $j === 0 ? 'false' : 'true'; ?>">
                                <div class="box-content">
                                    <div class="box-textos-container">
                                        <h2 class="titulo-thumb"><?php echo get_sub_field('title_repeater_gnss'); ?></h2>
                                        <p class="description-container">
                                            <?php echo get_sub_field('description_repeater_gnss'); ?>
                                        </p>
                                    </div>
                                    <div class="box-imagem-container">
                                        <?php
                                        $image = get_sub_field('image_repeater_gnss');
                                        if ($image):
                                            $image_url = $image['url'];
                                            $image_alt = $image['alt']; ?>
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="box-accordion">
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc"><?php echo get_sub_field('title_market'); ?>
                                            </h4>
                                        </div>
                                        <p class="description-acc">
                                            <?php echo get_sub_field('description_market'); ?>
                                        </p>
                                    </div>
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc"><?php echo get_sub_field('title_product_summary'); ?>
                                            </h4>
                                        </div>
                                        <div class="description-acc">
                                            <div class="box-repeater-sumary">

                                                <?php
                                                if (have_rows('file_product_summary_repeater')):
                                                    while (have_rows('file_product_summary_repeater')):
                                                        the_row(); ?>
                                                        <div class="row-summary">
                                                            <a href="<?php echo get_sub_field('file_product_summary') ?>" download
                                                                class="file-download" target="_blank">

                                                                <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="22" viewBox="0 0 16 22" fill="none">
                                                                    <path
                                                                        d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                    height="18" viewBox="0 0 19 18" fill="none">
                                                                    <path
                                                                        d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <p>
                                                                    <?php echo get_sub_field('title_file') ?>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    <?php endwhile;
                                                endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc"><?php echo get_sub_field('title_downloads'); ?>
                                            </h4>
                                        </div>
                                        <div class="description-acc">
                                            <div class="formulario" id="form-downloads">
                                                <?php
                                                // Chamar o formulário CF7 via ACF
                                                $form_id = get_sub_field('form_downloads');
                                                if ($form_id) {
                                                    echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
                                                } else {
                                                    echo 'Formulário não configurado.';
                                                }
                                                ?>
                                            </div>



                                            <div class="box-repearter-downloads-off">
                                                <?php
                                                if (have_rows('repeater_downloads')):
                                                    while (have_rows('repeater_downloads')):
                                                        the_row(); ?>
                                                        <div class="row-file-downloads">
                                                            <a href="<?php echo get_sub_field('file_product_summary') ?>" download
                                                                class="file-download" target="_blank">

                                                                <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="22" viewBox="0 0 16 22" fill="none">
                                                                    <path
                                                                        d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                    height="18" viewBox="0 0 19 18" fill="none">
                                                                    <path
                                                                        d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <p>
                                                                    <?php echo get_sub_field('title_file_downloads') ?>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    <?php endwhile;
                                                endif; ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php $j++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>


        </div>

    </div>

    <div class="gnss-swiper-mobile">

        <div class="box-thumbs">
            <div class="wrapper">
                <p class="label-all-modules"><?php echo get_field('label_all_modules'); ?></p>
            </div>

            <div class="box-row-thumbs">

                <?php
                if (have_rows('repeater_gnss')):
                    while (have_rows('repeater_gnss')):
                        the_row(); ?>
                        <div class="row-slide">
                            <h3 class="titulo-thumb"><?php echo get_sub_field('title_repeater_gnss'); ?></h3>
                            <p class="sub-titulo-thumb"><?php echo get_sub_field('label_repeater_gnss'); ?></p>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>
        <div class="wrapper">

            <div class="box-conteudo-mobile">
                <?php
                if (have_rows('repeater_gnss')):
                    while (have_rows('repeater_gnss')):
                        the_row(); ?>
                        <div class="row-slide-conteudo">
                            <div class="box-content">
                                <div class="box-imagem-container">
                                    <?php
                                    $image = get_sub_field('image_repeater_gnss');
                                    if ($image):
                                        $image_url = $image['url'];
                                        $image_alt = $image['alt']; ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="box-textos-container">
                                    <h2 class="titulo-thumb"><?php echo get_sub_field('title_repeater_gnss'); ?></h2>
                                    <p class="description-container">
                                        <?php echo get_sub_field('description_repeater_gnss'); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="box-accordion-mobile">
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc"><?php echo get_sub_field('title_market'); ?>
                                        </h4>
                                    </div>
                                    <p class="description-acc-mobile">
                                        <?php echo get_sub_field('description_market'); ?>
                                    </p>
                                </div>
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc"><?php echo get_sub_field('title_product_summary'); ?>
                                        </h4>
                                    </div>
                                    <div class="description-acc-mobile">
                                        <div class="box-repeater-sumary">

                                            <?php
                                            if (have_rows('file_product_summary_repeater')):
                                                while (have_rows('file_product_summary_repeater')):
                                                    the_row(); ?>
                                                    <div class="row-summary">
                                                        <a href="<?php echo get_sub_field('file_product_summary') ?>" download
                                                            class="file-download" target="_blank">

                                                            <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="22" viewBox="0 0 16 22" fill="none">
                                                                <path
                                                                    d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                height="18" viewBox="0 0 19 18" fill="none">
                                                                <path
                                                                    d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <p>
                                                                <?php echo get_sub_field('title_file') ?>
                                                            </p>
                                                        </a>
                                                    </div>
                                                <?php endwhile;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc"><?php echo get_sub_field('title_downloads'); ?>
                                        </h4>
                                    </div>
                                    <div class="description-acc-mobile">
                                        <div class="formulario" id="form-downloads-mobile">
                                            <?php
                                            // Chamar o formulário CF7 via ACF
                                            $form_id = get_sub_field('form_downloads');
                                            if ($form_id) {
                                                echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
                                            } else {
                                                echo 'Formulário não configurado.';
                                            }
                                            ?>
                                        </div>
                                        <div class="box-repearter-downloads-off">
                                            <?php
                                            if (have_rows('repeater_downloads')):
                                                while (have_rows('repeater_downloads')):
                                                    the_row(); ?>
                                                    <div class="row-file-downloads">
                                                        <a href="<?php echo get_sub_field('file_product_summary') ?>" download
                                                            class="file-download" target="_blank">

                                                            <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="22" viewBox="0 0 16 22" fill="none">
                                                                <path
                                                                    d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                height="18" viewBox="0 0 19 18" fill="none">
                                                                <path
                                                                    d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                    fill="#838690" />
                                                            </svg>

                                                            <p>
                                                                <?php echo get_sub_field('title_file_downloads') ?>
                                                            </p>
                                                        </a>
                                                    </div>
                                                <?php endwhile;
                                            endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>

    </div>



</div>

<div class="tabs-content box-gnss" id="tab-3">
    <div class="gnss-swiper">

        <div class="wrapper">


            <div class="box-thumbnail-smart">
                <p class="label-all-modules"><?php echo get_field('label_all_modules_smart'); ?></p>
                <div class="swiper-wrapper">
                    <?php if (have_rows('repeater_smart')):
                        $i = 0; ?>
                        <?php while (have_rows('repeater_smart')):
                            the_row(); ?>
                            <div class="box-swiper-slide" data-index="<?php echo esc_attr($i); ?>" role="button" tabindex="0"
                                aria-controls="gnss-panel-<?php echo esc_attr($i); ?>">
                                <div class="box-text">
                                    <h3 class="titulo-thumb"><?php echo get_sub_field('title_repeater_smart'); ?></h3>
                                    <p class="sub-titulo-thumb"><?php echo get_sub_field('label_repeater_smart'); ?></p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="17" viewBox="0 0 23 17" fill="none">
                                    <path d="M0 8.5H22M22 8.5L13.6829 0.5M22 8.5L13.6829 16.5" stroke="white" />
                                </svg>
                            </div>
                            <?php $i++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="box-smart">
                <div class="swiper-wrapper">
                    <?php if (have_rows('repeater_smart')):
                        $j = 0; ?>
                        <?php while (have_rows('repeater_smart')):
                            the_row(); ?>
                            <div class="box-swiper-slide-content" data-index="<?php echo esc_attr($j); ?>"
                                id="gnss-panel-<?php echo esc_attr($j); ?>"
                                aria-hidden="<?php echo $j === 0 ? 'false' : 'true'; ?>">
                                <div class="box-content">
                                    <div class="box-textos-container">
                                        <h2 class="titulo-thumb"><?php echo get_sub_field('title_repeater_smart'); ?></h2>
                                        <p class="description-container">
                                            <?php echo get_sub_field('description_repeater_smart'); ?>
                                        </p>
                                    </div>
                                    <div class="box-imagem-container">
                                        <?php
                                        $image = get_sub_field('image_repeater_smart');
                                        if ($image):
                                            $image_url = $image['url'];
                                            $image_alt = $image['alt']; ?>
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="box-accordion">
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc"><?php echo get_sub_field('title_market_repeater_smart'); ?>
                                            </h4>
                                        </div>
                                        <p class="description-acc">
                                            <?php echo get_sub_field('description_market_repeater_smart'); ?>
                                        </p>
                                    </div>
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc">
                                                <?php echo get_sub_field('title_product_summary_repeater_smart'); ?>
                                            </h4>
                                        </div>
                                        <div class="description-acc">
                                            <div class="box-repeater-sumary">

                                                <?php
                                                if (have_rows('file_product_summary_repeater_smart')):
                                                    while (have_rows('file_product_summary_repeater_smart')):
                                                        the_row(); ?>
                                                        <div class="row-summary">
                                                            <a href="<?php echo get_sub_field('file_product_summary_repeater_smart') ?>"
                                                                download class="file-download" target="_blank">

                                                                <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="22" viewBox="0 0 16 22" fill="none">
                                                                    <path
                                                                        d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                    height="18" viewBox="0 0 19 18" fill="none">
                                                                    <path
                                                                        d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                        fill="#838690" />
                                                                </svg>

                                                                <p>
                                                                    <?php echo get_sub_field('title_file_repeater_smart') ?>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    <?php endwhile;
                                                endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc"><?php echo get_sub_field('title_downloads_repeater_smart'); ?>
                                            </h4>
                                        </div>
                                        <div class="description-acc">
                                            <div class="formulario" id="form-downloads-smart">
                                                <?php
                                                // Chamar o formulário CF7 via ACF
                                                $form_id = get_sub_field('form_downloads_repeater_smart');
                                                if ($form_id) {
                                                    echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
                                                } else {
                                                    echo 'Formulário não configurado.';
                                                }
                                                ?>
                                            </div>
                                            <div class="box-repearter-downloads-off">
                                                <?php
                                                if (have_rows('repeater_downloads_repeater_smart')):
                                                    while (have_rows('repeater_downloads_repeater_smart')):
                                                        the_row(); ?>
                                                        <div class="row-file-downloads">
                                                            <a href="<?php echo get_sub_field('file_downloads_repeater_smart') ?>"
                                                                download class="file-download" target="_blank">

                                                                <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="22" viewBox="0 0 16 22" fill="none">
                                                                    <path
                                                                        d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                    height="18" viewBox="0 0 19 18" fill="none">
                                                                    <path
                                                                        d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <p>
                                                                    <?php echo get_sub_field('title_file_downloads_repeater_smart') ?>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    <?php endwhile;
                                                endif; ?>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php $j++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
    <div class="gnss-swiper-mobile">

        <div class="box-thumbs">
            <div class="wrapper">
                <p class="label-all-modules"><?php echo get_field('label_all_modules_smart'); ?></p>
            </div>

            <div class="box-row-thumbs">

                <?php
                if (have_rows('repeater_smart')):
                    while (have_rows('repeater_smart')):
                        the_row(); ?>
                        <div class="row-slide row-slide-smart">
                            <h3 class="titulo-thumb"><?php echo get_sub_field('title_repeater_smart'); ?></h3>
                            <p class="sub-titulo-thumb"><?php echo get_sub_field('label_repeater_smart'); ?></p>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>
        <div class="wrapper">

            <div class="box-conteudo-mobile">
                <?php
                if (have_rows('repeater_smart')):
                    while (have_rows('repeater_smart')):
                        the_row(); ?>
                        <div class="row-slide-conteudo row-slide-conteudo-smart">
                            <div class="box-content">
                                <div class="box-imagem-container">
                                    <?php
                                    $image = get_sub_field('image_repeater_smart');
                                    if ($image):
                                        $image_url = $image['url'];
                                        $image_alt = $image['alt']; ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="box-textos-container">
                                    <h2 class="titulo-thumb"><?php echo get_sub_field('title_repeater_smart'); ?></h2>
                                    <p class="description-container">
                                        <?php echo get_sub_field('description_repeater_smart'); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="box-accordion-mobile">
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc"><?php echo get_sub_field('title_market_repeater_smart'); ?>
                                        </h4>
                                    </div>
                                    <p class="description-acc-mobile">
                                        <?php echo get_sub_field('description_market_repeater_smart'); ?>
                                    </p>
                                </div>
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc">
                                            <?php echo get_sub_field('title_product_summary_repeater_smart'); ?>
                                        </h4>
                                    </div>
                                    <div class="description-acc-mobile">
                                        <div class="box-repeater-sumary">

                                            <?php
                                            if (have_rows('file_product_summary_repeater_smart')):
                                                while (have_rows('file_product_summary_repeater_smart')):
                                                    the_row(); ?>
                                                    <div class="row-summary">
                                                        <a href="<?php echo get_sub_field('file_product_summary_repeater_smart') ?>"
                                                            download class="file-download" target="_blank">

                                                            <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="22" viewBox="0 0 16 22" fill="none">
                                                                <path
                                                                    d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                height="18" viewBox="0 0 19 18" fill="none">
                                                                <path
                                                                    d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <p>
                                                                <?php echo get_sub_field('title_file_repeater_smart') ?>
                                                            </p>
                                                        </a>
                                                    </div>
                                                <?php endwhile;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc"><?php echo get_sub_field('title_downloads_repeater_smart'); ?>
                                        </h4>
                                    </div>
                                    <div class="description-acc-mobile">
                                        <div class="formulario" id="form-downloads-smart-mobile">
                                            <?php
                                            // Chamar o formulário CF7 via ACF
                                            $form_id = get_sub_field('form_downloads_repeater_smart');
                                            if ($form_id) {
                                                echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
                                            } else {
                                                echo 'Formulário não configurado.';
                                            }
                                            ?>
                                        </div>
                                        <div class="box-repearter-downloads-off">
                                            <?php
                                            if (have_rows('repeater_downloads_repeater_smart')):
                                                while (have_rows('repeater_downloads_repeater_smart')):
                                                    the_row(); ?>
                                                    <div class="row-file-downloads">
                                                        <a href="<?php echo get_sub_field('file_downloads_repeater_smart') ?>" download
                                                            class="file-download" target="_blank">

                                                            <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="22" viewBox="0 0 16 22" fill="none">
                                                                <path
                                                                    d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                height="18" viewBox="0 0 19 18" fill="none">
                                                                <path
                                                                    d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <p>
                                                                <?php echo get_sub_field('title_file_downloads_repeater_smart') ?>
                                                            </p>
                                                        </a>
                                                    </div>
                                                <?php endwhile;
                                            endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>

    </div>

</div>

<div class="tabs-content box-gnss" id="tab-4">
    <div class="gnss-swiper">

        <div class="wrapper">

            <div class="box-thumbnail-bluetooth">
                <p class="label-all-modules"><?php echo get_field('label_all_modules_bluetooth'); ?></p>
                <div class="swiper-wrapper">
                    <?php
                    if (have_rows('repeater_bluetooth')):
                        $i = 0; ?>
                        <?php while (have_rows('repeater_bluetooth')):
                            the_row(); ?>
                            <div class="box-swiper-slide" data-index="<?php echo esc_attr($i); ?>" role="button" tabindex="0"
                                aria-controls="gnss-panel-<?php echo esc_attr($i); ?>">
                                <div class="box-text">
                                    <h3 class="titulo-thumb"><?php echo get_sub_field('title_repeater_bluetooth'); ?></h3>
                                    <p class="sub-titulo-thumb"><?php echo get_sub_field('label_repeater_bluetooth'); ?></p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="17" viewBox="0 0 23 17" fill="none">
                                    <path d="M0 8.5H22M22 8.5L13.6829 0.5M22 8.5L13.6829 16.5" stroke="white" />
                                </svg>
                            </div>
                            <?php $i++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box-bluetooth">
                <div class="swiper-wrapper">
                    <?php
                    if (have_rows('repeater_bluetooth')):
                        $j = 0; ?>
                        <?php while (have_rows('repeater_bluetooth')):
                            the_row(); ?>
                            <div class="box-swiper-slide-content" data-index="<?php echo esc_attr($j); ?>"
                                id="gnss-panel-<?php echo esc_attr($j); ?>"
                                aria-hidden="<?php echo $j === 0 ? 'false' : 'true'; ?>">
                                <div class="box-content">
                                    <div class="box-textos-container">
                                        <h2 class="titulo-thumb"><?php echo get_sub_field('title_repeater_bluetooth'); ?></h2>
                                        <p class="description-container">
                                            <?php echo get_sub_field('description_repeater_bluetooth'); ?>
                                        </p>
                                    </div>
                                    <div class="box-imagem-container">
                                        <?php
                                        $image = get_sub_field('image_repeater_bluetooth');
                                        if ($image):
                                            $image_url = $image['url'];
                                            $image_alt = $image['alt']; ?>
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="box-accordion">
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc">
                                                <?php echo get_sub_field('title_market_repeater_bluetooth'); ?>
                                            </h4>
                                        </div>
                                        <p class="description-acc">
                                            <?php echo get_sub_field('description_market_repeater_bluetooth'); ?>
                                        </p>
                                    </div>
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc">
                                                <?php echo get_sub_field('tilte_product_summary_repeater_bluetooth'); ?>
                                            </h4>
                                        </div>
                                        <div class="description-acc">
                                            <div class="box-repeater-sumary">

                                                <?php
                                                if (have_rows('file_product_summary_repeater_bluetooth')):
                                                    while (have_rows('file_product_summary_repeater_bluetooth')):
                                                        the_row(); ?>
                                                        <div class="row-summary">
                                                            <a href="<?php echo get_sub_field('file_product_summary_repeater_bluetooth') ?>"
                                                                download class="file-download" target="_blank">

                                                                <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="22" viewBox="0 0 16 22" fill="none">
                                                                    <path
                                                                        d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                    height="18" viewBox="0 0 19 18" fill="none">
                                                                    <path
                                                                        d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                        fill="#838690" />
                                                                </svg>

                                                                <p>
                                                                    <?php echo get_sub_field('title_file_repeater_bluetooth') ?>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    <?php endwhile;
                                                endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc">
                                                <?php echo get_sub_field('title_downloads_repeater_bluetooth'); ?>
                                            </h4>
                                        </div>
                                        <div class="description-acc">
                                            <div class="formulario" id="form-downloads-bluetooth">
                                                <?php
                                                // Chamar o formulário CF7 via ACF
                                                $form_id = get_sub_field('form_downloads_repeater_bluetooth');
                                                if ($form_id) {
                                                    echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
                                                } else {
                                                    echo 'Formulário não configurado.';
                                                }
                                                ?>
                                            </div>
                                            <div class="box-repearter-downloads-off">
                                                <?php
                                                if (have_rows('repeater_downloads_repeater_bluetooth')):
                                                    while (have_rows('repeater_downloads_repeater_bluetooth')):
                                                        the_row(); ?>
                                                        <div class="row-file-downloads">
                                                            <a href="<?php echo get_sub_field('file_downloads_repeater_bluetooth') ?>"
                                                                download class="file-download" target="_blank">

                                                                <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="22" viewBox="0 0 16 22" fill="none">
                                                                    <path
                                                                        d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                    height="18" viewBox="0 0 19 18" fill="none">
                                                                    <path
                                                                        d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                        fill="#838690" />
                                                                </svg>

                                                                <p>
                                                                    <?php echo get_sub_field('title_file_downloads_repeater_bluetooth') ?>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    <?php endwhile;
                                                endif; ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php $j++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
    <div class="gnss-swiper-mobile">

        <div class="box-thumbs">
            <div class="wrapper">
                <p class="label-all-modules"><?php echo get_field('label_all_modules_bluetooth'); ?></p>
            </div>

            <div class="box-row-thumbs">

                <?php
                if (have_rows('repeater_bluetooth')):
                    while (have_rows('repeater_bluetooth')):
                        the_row(); ?>
                        <div class="row-slide row-slide-bluetooth">
                            <h3 class="titulo-thumb"><?php echo get_sub_field('title_repeater_bluetooth'); ?></h3>
                            <p class="sub-titulo-thumb"><?php echo get_sub_field('label_repeater_bluetooth'); ?></p>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>
        <div class="wrapper">

            <div class="box-conteudo-mobile">
                <?php
                if (have_rows('repeater_bluetooth')):
                    while (have_rows('repeater_bluetooth')):
                        the_row(); ?>
                        <div class="row-slide-conteudo row-slide-conteudo-bluetooth">
                            <div class="box-content">
                                <div class="box-imagem-container">
                                    <?php
                                    $image = get_sub_field('image_repeater_bluetooth');
                                    if ($image):
                                        $image_url = $image['url'];
                                        $image_alt = $image['alt']; ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="box-textos-container">
                                    <h2 class="titulo-thumb"><?php echo get_sub_field('title_repeater_bluetooth'); ?></h2>
                                    <p class="description-container">
                                        <?php echo get_sub_field('description_repeater_bluetooth'); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="box-accordion-mobile">
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc"><?php echo get_sub_field('title_market_repeater_bluetooth'); ?>
                                        </h4>
                                    </div>
                                    <p class="description-acc-mobile">
                                        <?php echo get_sub_field('description_market_repeater_bluetooth'); ?>
                                    </p>
                                </div>
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc">
                                            <?php echo get_sub_field('title_product_summary_repeater_bluetooth'); ?>
                                        </h4>
                                    </div>
                                    <div class="description-acc-mobile">
                                        <div class="box-repeater-sumary">

                                            <?php
                                            if (have_rows('file_product_summary_repeater_bluetooth')):
                                                while (have_rows('file_product_summary_repeater_bluetooth')):
                                                    the_row(); ?>
                                                    <div class="row-summary">
                                                        <a href="<?php echo get_sub_field('file_product_summary_repeater_bluetooth') ?>"
                                                            download class="file-download" target="_blank">

                                                            <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="22" viewBox="0 0 16 22" fill="none">
                                                                <path
                                                                    d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                height="18" viewBox="0 0 19 18" fill="none">
                                                                <path
                                                                    d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <p>
                                                                <?php echo get_sub_field('title_file_repeater_bluetooth') ?>
                                                            </p>
                                                        </a>
                                                    </div>
                                                <?php endwhile;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc"><?php echo get_sub_field('title_downloads_repeater_bluetooth'); ?>
                                        </h4>
                                    </div>
                                    <div class="description-acc-mobile">
                                        <div class="formulario" id="form-downloads-bluetooth-mobile">
                                            <?php
                                            // Chamar o formulário CF7 via ACF
                                            $form_id = get_sub_field('form_downloads_repeater_bluetooth');
                                            if ($form_id) {
                                                echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
                                            } else {
                                                echo 'Formulário não configurado.';
                                            }
                                            ?>
                                        </div>
                                        <div class="box-repearter-downloads-off">
                                            <?php
                                            if (have_rows('repeater_downloads_repeater_bluetooth')):
                                                while (have_rows('repeater_downloads_repeater_bluetooth')):
                                                    the_row(); ?>
                                                    <div class="row-file-downloads">
                                                        <a href="<?php echo get_sub_field('file_downloads_repeater_bluetooth') ?>"
                                                            download class="file-download" target="_blank">

                                                            <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="22" viewBox="0 0 16 22" fill="none">
                                                                <path
                                                                    d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                height="18" viewBox="0 0 19 18" fill="none">
                                                                <path
                                                                    d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                    fill="#838690" />
                                                            </svg>

                                                            <p>
                                                                <?php echo get_sub_field('title_file_downloads_repeater_bluetooth') ?>
                                                            </p>
                                                        </a>
                                                    </div>
                                                <?php endwhile;
                                            endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>

    </div>

</div>

<div class="tabs-content box-gnss" id="tab-5">
    <div class="gnss-swiper">

        <div class="wrapper">

            <div class="box-thumbnail-antennas">
                <p class="label-all-modules"><?php echo get_field('label_all_modules_antennas'); ?></p>
                <div class="swiper-wrapper">
                    <?php
                    if (have_rows('repeater_antennas')):
                        $i = 0; ?>
                        <?php while (have_rows('repeater_antennas')):
                            the_row(); ?>
                            <div class="box-swiper-slide" data-index="<?php echo esc_attr($i); ?>" role="button" tabindex="0"
                                aria-controls="gnss-panel-<?php echo esc_attr($i); ?>">
                                <div class="box-text">
                                    <h3 class="titulo-thumb"><?php echo get_sub_field('title_repeater_antennas'); ?></h3>
                                    <p class="sub-titulo-thumb"><?php echo get_sub_field('label_repeater_antennas'); ?></p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="17" viewBox="0 0 23 17" fill="none">
                                    <path d="M0 8.5H22M22 8.5L13.6829 0.5M22 8.5L13.6829 16.5" stroke="white" />
                                </svg>
                            </div>
                            <?php $i++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box-antennas">
                <div class="swiper-wrapper">
                    <?php
                    if (have_rows('repeater_antennas')):
                        $j = 0; ?>
                        <?php while (have_rows('repeater_antennas')):
                            the_row(); ?>
                            <div class="box-swiper-slide-content" data-index="<?php echo esc_attr($j); ?>"
                                id="gnss-panel-<?php echo esc_attr($j); ?>"
                                aria-hidden="<?php echo $j === 0 ? 'false' : 'true'; ?>">
                                <div class="box-content">
                                    <div class="box-textos-container">
                                        <h2 class="titulo-thumb"><?php echo get_sub_field('title_repeater_antennas'); ?></h2>
                                        <p class="description-container">
                                            <?php echo get_sub_field('description_repeater_antennas'); ?>
                                        </p>
                                    </div>
                                    <div class="box-imagem-container">
                                        <?php
                                        $image = get_sub_field('image_repeater_antennas');
                                        if ($image):
                                            $image_url = $image['url'];
                                            $image_alt = $image['alt']; ?>
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="box-accordion">
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc">
                                                <?php echo get_sub_field('title_market_repeater_antennas'); ?>
                                            </h4>
                                        </div>
                                        <p class="description-acc">
                                            <?php echo get_sub_field('description_market_repeater_antennas'); ?>
                                        </p>
                                    </div>
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc">
                                                <?php echo get_sub_field('title_product_summary_repeater_antennas'); ?>
                                            </h4>
                                        </div>
                                        <div class="description-acc">
                                            <div class="box-repeater-sumary">

                                                <?php
                                                if (have_rows('file_product_summary_repeater_antennas')):
                                                    while (have_rows('file_product_summary_repeater_antennas')):
                                                        the_row(); ?>
                                                        <div class="row-summary">
                                                            <a href="<?php echo get_sub_field('file_product_summary_repeater_antennas') ?>"
                                                                download class="file-download" target="_blank">

                                                                <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="22" viewBox="0 0 16 22" fill="none">
                                                                    <path
                                                                        d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                    height="18" viewBox="0 0 19 18" fill="none">
                                                                    <path
                                                                        d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                        fill="#838690" />
                                                                </svg>

                                                                <p>
                                                                    <?php echo get_sub_field('title_file_repeater_antennas') ?>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    <?php endwhile;
                                                endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="acc">
                                        <div class="box-title">

                                            <div class="box-svg">
                                                <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                                <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <circle cx="12.5" cy="12.5" r="11.5" stroke="#00205B" />
                                                    <path
                                                        d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                        fill="#00205B" />
                                                </svg>
                                            </div>
                                            <h4 class="title-acc">
                                                <?php echo get_sub_field('title_downloads_repeater_antennas'); ?>
                                            </h4>
                                        </div>
                                        <div class="description-acc">
                                            <div class="formulario" id="form-downloads-antennas">
                                                <?php
                                                // Chamar o formulário CF7 via ACF
                                                $form_id = get_sub_field('form_downloads_repeater_antennas');
                                                if ($form_id) {
                                                    echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
                                                } else {
                                                    echo 'Formulário não configurado.';
                                                }
                                                ?>
                                            </div>
                                            <div class="box-repearter-downloads-off">
                                                <?php
                                                if (have_rows('repeater_downloads_repeater_antennas')):
                                                    while (have_rows('repeater_downloads_repeater_antennas')):
                                                        the_row(); ?>
                                                        <div class="row-file-downloads">
                                                            <a href="<?php echo get_sub_field('file_downloads_repeater_antennas') ?>"
                                                                download class="file-download" target="_blank">

                                                                <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="22" viewBox="0 0 16 22" fill="none">
                                                                    <path
                                                                        d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                    height="18" viewBox="0 0 19 18" fill="none">
                                                                    <path
                                                                        d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                        fill="#838690" />
                                                                    <path
                                                                        d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                        fill="#838690" />
                                                                </svg>
                                                                <p>
                                                                    <?php echo get_sub_field('title_file_downloads_repeater_antennas') ?>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    <?php endwhile;
                                                endif; ?>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php $j++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
    <div class="gnss-swiper-mobile">

        <div class="box-thumbs">
            <div class="wrapper">
                <p class="label-all-modules"><?php echo get_field('label_all_modules_antennas'); ?></p>
            </div>

            <div class="box-row-thumbs">

                <?php
                if (have_rows('repeater_antennas')):
                    while (have_rows('repeater_antennas')):
                        the_row(); ?>
                        <div class="row-slide row-slide-antennas">
                            <h3 class="titulo-thumb"><?php echo get_sub_field('title_repeater_antennas'); ?></h3>
                            <p class="sub-titulo-thumb"><?php echo get_sub_field('label_repeater_antennas'); ?></p>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>
        <div class="wrapper">

            <div class="box-conteudo-mobile">
                <?php
                if (have_rows('repeater_antennas')):
                    while (have_rows('repeater_antennas')):
                        the_row(); ?>
                        <div class="row-slide-conteudo row-slide-conteudo-antennas">
                            <div class="box-content">
                                <div class="box-imagem-container">
                                    <?php
                                    $image = get_sub_field('image_repeater_antennas');
                                    if ($image):
                                        $image_url = $image['url'];
                                        $image_alt = $image['alt']; ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="box-textos-container">
                                    <h2 class="titulo-thumb"><?php echo get_sub_field('title_repeater_antennas'); ?></h2>
                                    <p class="description-container">
                                        <?php echo get_sub_field('description_repeater_antennas'); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="box-accordion-mobile">
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc"><?php echo get_sub_field('title_market_repeater_antennas'); ?>
                                        </h4>
                                    </div>
                                    <p class="description-acc-mobile">
                                        <?php echo get_sub_field('description_market_repeater_antennas'); ?>
                                    </p>
                                </div>
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc">
                                            <?php echo get_sub_field('title_product_summary_repeater_antennas'); ?>
                                        </h4>
                                    </div>
                                    <div class="description-acc-mobile">
                                        <div class="box-repeater-sumary">

                                            <?php
                                            if (have_rows('file_product_summary_repeater_antennas')):
                                                while (have_rows('file_product_summary_repeater_antennas')):
                                                    the_row(); ?>
                                                    <div class="row-summary">
                                                        <a href="<?php echo get_sub_field('file_product_summary_repeater_antennas') ?>"
                                                            download class="file-download" target="_blank">

                                                            <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="22" viewBox="0 0 16 22" fill="none">
                                                                <path
                                                                    d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                height="18" viewBox="0 0 19 18" fill="none">
                                                                <path
                                                                    d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                    fill="#838690" />
                                                            </svg>

                                                            <p>
                                                                <?php echo get_sub_field('title_file_repeater_antennas') ?>
                                                            </p>
                                                        </a>
                                                    </div>
                                                <?php endwhile;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="acc-mobile">
                                    <div class="box-title">

                                        <div class="box-svg">
                                            <svg class="svg-close" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 18.5V13.2623H6.5V11.5902H11.6393V6.5H13.3607V11.5902H18.5V13.2623H13.3607V18.5H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                            <svg class="svg-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <circle cx="12.5" cy="12.5" r="11.5" stroke="#fff" />
                                                <path
                                                    d="M11.6393 13.262H6.5V11.5898H11.6393L13.3607 11.5899L18.5 11.5898V13.262H13.3607H11.6393Z"
                                                    fill="#fff" />
                                            </svg>
                                        </div>
                                        <h4 class="title-acc"><?php echo get_sub_field('title_downloads_repeater_antennas'); ?>
                                        </h4>
                                    </div>
                                    <div class="description-acc-mobile">
                                        <div class="formulario" id="form-downloads-antennas-mobile">
                                            <?php
                                            // Chamar o formulário CF7 via ACF
                                            $form_id = get_sub_field('form_downloads_repeater_antennas');
                                            if ($form_id) {
                                                echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
                                            } else {
                                                echo 'Formulário não configurado.';
                                            }
                                            ?>
                                        </div>
                                        <div class="box-repearter-downloads-off">
                                            <?php
                                            if (have_rows('repeater_downloads_repeater_antennas')):
                                                while (have_rows('repeater_downloads_repeater_antennas')):
                                                    the_row(); ?>
                                                    <div class="row-file-downloads">
                                                        <a href="<?php echo get_sub_field('file_downloads_repeater_antennas') ?>"
                                                            download class="file-download" target="_blank">

                                                            <svg class="pdf-logo" xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="22" viewBox="0 0 16 22" fill="none">
                                                                <path
                                                                    d="M15.2628 4.71763L10.9883 0.134277C10.9082 0.0483398 10.7996 0 10.6861 0H1.70975C0.766794 0 0 0.822207 0 1.83335V20.1667C0 21.1778 0.766794 22 1.70979 22H13.6782C14.6212 22 15.388 21.1778 15.388 20.1667V5.04165C15.388 4.91992 15.3429 4.80356 15.2628 4.71763ZM11.1135 1.56479L13.9286 4.58335H11.9684C11.4971 4.58335 11.1135 4.17201 11.1135 3.6667V1.56479ZM14.5331 20.1667C14.5331 20.672 14.1495 21.0833 13.6782 21.0833H1.70979C1.23853 21.0833 0.854914 20.672 0.854914 20.1667V1.83335C0.854914 1.32804 1.23853 0.916695 1.70979 0.916695H10.2587V3.6667C10.2587 4.67779 11.0254 5.5 11.9684 5.5H14.5331V20.1667Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.29219 9.25593C9.00199 9.01106 8.7262 8.75932 8.54253 8.56238C8.30376 8.30636 8.091 8.05821 7.90613 7.82189C8.1945 6.86639 8.32093 6.37373 8.32093 6.11112C8.32093 4.99546 7.94501 4.76667 7.38055 4.76667C6.95168 4.76667 6.44017 5.00561 6.44017 6.14329C6.44017 6.64485 6.6964 7.25372 7.20423 7.96138C7.07995 8.36806 6.93393 8.83712 6.76986 9.3659C6.69087 9.61962 6.60518 9.85462 6.51455 10.0719C6.44079 10.1071 6.36915 10.1428 6.29997 10.1799C6.0508 10.3135 5.81418 10.4336 5.59469 10.5452C4.59369 11.0533 3.93248 11.3895 3.93248 12.0531C3.93248 12.535 4.42074 12.8333 4.87286 12.8333C5.45569 12.8333 6.33576 11.9986 6.9786 10.5925C7.64591 10.3102 8.4755 10.1011 9.13027 9.97014C9.65494 10.4027 10.2344 10.8167 10.5151 10.8167C11.2923 10.8167 11.4555 10.3348 11.4555 9.93075C11.4555 9.13609 10.6088 9.13609 10.2016 9.13609C10.0752 9.13612 9.73608 9.17617 9.29219 9.25593ZM4.87286 12.1611C4.69378 12.1611 4.57256 12.0705 4.55939 12.0531C4.55939 11.8148 5.22212 11.4781 5.86313 11.1525C5.90384 11.1318 5.94518 11.1111 5.98712 11.0898C5.51631 11.8218 5.05071 12.1611 4.87286 12.1611ZM7.06708 6.14329C7.06708 5.43891 7.27097 5.43891 7.38055 5.43891C7.60218 5.43891 7.69402 5.43891 7.69402 6.11112C7.69402 6.25292 7.60586 6.60741 7.44452 7.16083C7.19838 6.75447 7.06708 6.40622 7.06708 6.14329ZM7.30738 9.75584C7.32698 9.69742 7.34596 9.63834 7.36433 9.57859C7.48064 9.2044 7.58535 8.86828 7.67871 8.56566C7.8088 8.71927 7.94901 8.87651 8.09932 9.03765C8.15809 9.10067 8.30379 9.24247 8.49789 9.42003C8.11152 9.51031 7.70042 9.62223 7.30738 9.75584ZM10.8286 9.93078C10.8286 10.0818 10.8286 10.1445 10.5378 10.1464C10.4524 10.1267 10.2549 10.002 10.0113 9.82412C10.0997 9.81363 10.1649 9.80836 10.2016 9.80836C10.6648 9.80836 10.7961 9.85692 10.8286 9.93078Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M3.74043 18.7V15.4186H5.06871C5.29443 15.4186 5.48543 15.4589 5.6417 15.5396C5.79796 15.6203 5.91661 15.7367 5.99764 15.8887C6.07867 16.0407 6.11918 16.2254 6.11918 16.4426C6.11918 16.6567 6.07867 16.8413 5.99764 16.9965C5.91661 17.1485 5.79796 17.2664 5.6417 17.3502C5.48543 17.4309 5.29443 17.4712 5.06871 17.4712H4.29605V18.7H3.74043ZM4.29605 17.0011H4.9819C5.17868 17.0011 5.32771 16.9546 5.429 16.8615C5.53028 16.7653 5.58093 16.6257 5.58093 16.4426C5.58093 16.2595 5.53028 16.1214 5.429 16.0283C5.32771 15.9352 5.17868 15.8887 4.9819 15.8887H4.29605V17.0011Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M6.57212 18.7V15.4186H7.7094C8.05088 15.4186 8.34026 15.4822 8.57756 15.6094C8.81775 15.7367 9.00006 15.9228 9.1245 16.168C9.25183 16.41 9.31549 16.7063 9.31549 17.057C9.31549 17.4076 9.25183 17.7055 9.1245 17.9506C9.00006 18.1958 8.81775 18.3819 8.57756 18.5092C8.34026 18.6364 8.05088 18.7 7.7094 18.7H6.57212ZM7.12774 18.2066H7.67468C8.03062 18.2066 8.29541 18.112 8.46904 17.9227C8.64557 17.7303 8.73383 17.4417 8.73383 17.057C8.73383 16.6722 8.64557 16.3852 8.46904 16.1959C8.29251 16.0066 8.02773 15.912 7.67468 15.912H7.12774V18.2066Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M9.87857 18.7V15.4186H11.8797V15.8934H10.4342V16.8196H11.7885V17.2943H10.4342V18.7H9.87857Z"
                                                                    fill="#838690" />
                                                            </svg>
                                                            <svg class="logo-download" xmlns="http://www.w3.org/2000/svg" width="19"
                                                                height="18" viewBox="0 0 19 18" fill="none">
                                                                <path
                                                                    d="M18.1981 11.0344C18.0158 11.0344 17.8409 11.1068 17.712 11.2357C17.5831 11.3647 17.5106 11.5395 17.5106 11.7219V14.0697C17.5106 14.6231 17.2908 15.1538 16.8995 15.5451C16.5082 15.9364 15.9775 16.1563 15.4241 16.1563H3.46156C2.90817 16.1563 2.37745 15.9364 1.98614 15.5451C1.59483 15.1538 1.375 14.6231 1.375 14.0697V11.7219C1.375 11.5395 1.30257 11.3647 1.17364 11.2357C1.0447 11.1068 0.869836 11.0344 0.6875 11.0344C0.505164 11.0344 0.330295 11.1068 0.201364 11.2357C0.0724328 11.3647 0 11.5395 0 11.7219V14.0697C0.000910049 14.9875 0.365901 15.8674 1.01487 16.5164C1.66384 17.1654 2.54378 17.5303 3.46156 17.5313H15.4241C16.3418 17.5303 17.2218 17.1654 17.8708 16.5164C18.5197 15.8674 18.8847 14.9875 18.8856 14.0697V11.7219C18.8856 11.5395 18.8132 11.3647 18.6843 11.2357C18.5553 11.1068 18.3805 11.0344 18.1981 11.0344Z"
                                                                    fill="#838690" />
                                                                <path
                                                                    d="M8.95469 13.0419C9.0186 13.1063 9.09464 13.1575 9.17842 13.1924C9.26219 13.2273 9.35205 13.2452 9.44281 13.2452C9.53357 13.2452 9.62343 13.2273 9.70721 13.1924C9.79099 13.1575 9.86703 13.1063 9.93094 13.0419L13.8428 9.13C13.952 8.99866 14.0083 8.83141 14.0009 8.6608C13.9935 8.49019 13.9229 8.32844 13.8028 8.20704C13.6827 8.08565 13.5217 8.0133 13.3512 8.00409C13.1807 7.99487 13.0128 8.04945 12.8803 8.15719L10.1303 10.9072V0.6875C10.1303 0.505164 10.0579 0.330295 9.92895 0.201364C9.80002 0.0724328 9.62515 0 9.44281 0C9.26048 0 9.08561 0.0724328 8.95668 0.201364C8.82775 0.330295 8.75531 0.505164 8.75531 0.6875V10.8969L6.00531 8.14688C5.87631 8.01787 5.70134 7.9454 5.51891 7.9454C5.33647 7.9454 5.1615 8.01787 5.0325 8.14688C4.9035 8.27588 4.83102 8.45084 4.83102 8.63328C4.83102 8.81572 4.9035 8.99068 5.0325 9.11969L8.95469 13.0419Z"
                                                                    fill="#838690" />
                                                            </svg>

                                                            <p>
                                                                <?php echo get_sub_field('title_file_downloads_repeater_antennas') ?>
                                                            </p>
                                                        </a>
                                                    </div>
                                                <?php endwhile;
                                            endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>

    </div>

</div>

<?php
// Supondo que você está dentro do loop do post principal
$related_cases = get_field('case_studies');

if ($related_cases):
    echo '<div class="tabs-content case" id="tab-6"><div class="wrapper">';
    foreach ($related_cases as $post):
        setup_postdata($post); ?>

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
                        // Data formatada com sufixo
                        $day = get_the_date('j');
                        $month = get_the_date('F');
                        $year = get_the_date('Y');
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
                        <p class="label-media-card">Read more &gt;</p>
                    </div>
                </div>
            </a>
        </article>

        <?php
    endforeach;
    echo '</div></div>';
    wp_reset_postdata();
endif;
?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"
    integrity="sha512-Ysw1DcK1P+uYLqprEAzNQJP+J4hTx4t/3X2nbVwszao8wD+9afLjBQYjz7Uk4ADP+Er++mJoScI42ueGtQOzEA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var swiper = new Swiper('.swiper-colecoes', {
        slidesPerView: 1,
        loop: true,
        effect: 'fade',
        fadeEffect: {
            crossFade: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Helper: extrai texto de um elemento
        function getText(el) {
            return (el?.textContent || '').trim();
        }

        // Preencher hidden antes do envio (desktop + mobile)
        document.querySelectorAll('.description-acc .formulario form, .description-acc-mobile .formulario form')
            .forEach(function (cf7Form) {
                cf7Form.addEventListener('submit', function () {
                    // 1) Detecta se estamos dentro do mobile
                    const mobileRoot = cf7Form.closest('.gnss-swiper-mobile');

                    let title = '';

                    if (mobileRoot) {
                        // ====== VERSÃO MOBILE ======
                        // Painel onde o form está:
                        const panel = cf7Form.closest('.row-slide-conteudo');

                        // (a) prioriza o título do painel (sempre consistente)
                        const panelTitleEl = panel?.querySelector('.box-textos-container .titulo-thumb, .titulo-thumb');
                        if (panelTitleEl) {
                            title = getText(panelTitleEl);
                        }

                        // (b) se quiser sincronizar com o thumb "ativo" (caso exista .is-active nos thumbs)
                        if (!title) {
                            const thumbsWrap = mobileRoot.querySelector('.box-thumbs .box-row-thumbs');
                            const activeThumbTitleEl = thumbsWrap?.querySelector('.row-slide.is-active .titulo-thumb');
                            if (activeThumbTitleEl) title = getText(activeThumbTitleEl);
                        }

                        // (c) fallback pelo índice: pega o índice do painel e mapeia para o thumb no mesmo índice
                        if (!title && panel) {
                            const panels = Array.from(mobileRoot.querySelectorAll('.box-conteudo-mobile .row-slide-conteudo'));
                            const thumbs = Array.from(mobileRoot.querySelectorAll('.box-thumbs .box-row-thumbs .row-slide'));
                            const idx = panels.indexOf(panel);
                            if (idx > -1 && thumbs[idx]) {
                                const t = thumbs[idx].querySelector('.titulo-thumb');
                                if (t) title = getText(t);
                            }
                        }

                    } else {
                        // ====== VERSÃO DESKTOP ======
                        // Sobe até o .box-slider e busca o .box-thumbnail irmão (thumbs)
                        const slider = cf7Form.closest('.box-slider');
                        const thumbList = slider?.previousElementSibling; // .box-thumbnail
                        const activeThumbTitleEl = thumbList?.querySelector('.box-swiper-slide.is-active .titulo-thumb');

                        // (a) tenta pegar do thumb ativo:
                        if (activeThumbTitleEl) {
                            title = getText(activeThumbTitleEl);
                        }

                        // (b) fallback: título do painel atual onde o form está
                        if (!title) {
                            const panel = cf7Form.closest('.box-swiper-slide-content');
                            const panelTitleEl = panel?.querySelector('.box-textos-container .titulo-thumb, .titulo-thumb');
                            if (panelTitleEl) title = getText(panelTitleEl);
                        }
                    }

                    // Preenche o hidden DENTRO deste form
                    const hiddenField = cf7Form.querySelector('input[name="selected-gnss-title"]');
                    if (hiddenField) hiddenField.value = title;
                });
            });

        // Após envio bem-sucedido, esconde só o form daquela instância e mostra seus downloads (desktop + mobile)
        document.addEventListener('wpcf7mailsent', function (event) {
            const form = event.target; // <form> enviado
            if (!form) return;

            // Tenta desktop
            let container = form.closest('.description-acc');
            // Se não achou, tenta mobile
            if (!container) container = form.closest('.description-acc-mobile');

            const formWrapper = form.closest('.formulario');
            const downloadBox = container?.querySelector('.box-repearter-downloads-off');

            if (formWrapper && downloadBox) {
                formWrapper.style.display = 'none';
                downloadBox.style.display = 'flex';
            }
        });

    });
</script>
<?php get_template_part('componentes/banner-lets-work'); ?>

<?php
get_footer();
?>