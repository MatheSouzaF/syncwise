<?php
//Template Name: SyncUp Main
wp_enqueue_style('syncup-main', get_template_directory_uri() . '/assets/dist/css/syncup-main/syncup-main.css', ['main'], ASSETS_VERSION);

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

    </div>
</div>


<div class="tabs-content sync active" id="tab-1">
    <div class="wrapper">
        <div class="box-content">
            <p class="label-synciq"><?php echo get_field('label_syncup'); ?></p>
            <div class="box-svg">
                <?php $svg_file = get_field('svg_syncup');
                if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                    echo '<i class="element">';
                    echo file_get_contents($svg_file['url']);
                    echo '</i>';
                } ?>
            </div>
            <p class="description-synciq">
                <?php echo get_field('description_syncup'); ?>
            </p>
            <div class="box-repeater-item">
                <?php
                if (have_rows('repeater_itens_syncup')):
                    while (have_rows('repeater_itens_syncup')):
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
                                <?php echo get_sub_field('label_itens_repeater_syncup'); ?>
                            </p>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
            <p class="description-synciq">
                <?php echo get_field('description_syncup_02'); ?>
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
                    <?php if (have_rows('video_or_image')): ?>
                        <?php while (have_rows('video_or_image')):
                            the_row(); ?>
                            <?php
                            $slide_index = get_row_index() - 1; // 0-based
                            $extra_class = ''; // inicializa vazio
                    
                            if (get_row_layout() == 'video_syncup') {
                                $video_modal = get_sub_field('video_modal');
                                if (!empty($video_modal)) {
                                    $extra_class = ' has-modal';
                                }
                            } elseif (get_row_layout() == 'image_syncup') {
                                $image_has_modal = get_sub_field('video_modal_imagem');
                                if (!empty($image_has_modal)) {
                                    $extra_class = ' has-modal';
                                }
                            }
                            ?>
                            <div class="swiper-slide <?php echo $extra_class; ?>"
                                data-slide-index="<?php echo esc_attr($slide_index); ?>">
                                <?php if (get_row_layout() == 'video_syncup'):
                                    $video_url = get_sub_field('video_syncup');
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

                                <?php elseif (get_row_layout() == 'image_syncup'):
                                    $image = get_sub_field('image_syncup');
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
            <?php if (have_rows('video_or_image')): ?>
                <?php while (have_rows('video_or_image')):
                    the_row(); ?>
                    <?php $slide_index = get_row_index() - 1; // 0-based, igual ao de cima ?>
                    <div class="swiper-slide" data-slide-index="<?php echo esc_attr($slide_index); ?>">
                        <?php if (get_row_layout() == 'video_syncup'): ?>
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

                        <?php elseif (get_row_layout() == 'image_syncup'): ?>
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

<div class="tabs-content lte" id="tab-2">

    <div class="wrapper">
        <div class="box-img">
            <?php
            $image = get_field('image_lte_global_sim');
            if ($image):
                $image_url = $image['url'];
                $image_alt = $image['alt']; ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            <?php endif; ?>
        </div>

        <div class="box-conteudo">
            <h3 class="title-conteudo-lte"><?php echo get_field('title_lte_global_sim'); ?></h3>
            <p class="label-conteudo-lte"><?php echo get_field('label_lte_global_sim'); ?></p>
            <p class="description-conteudo-lte"><?php echo get_field('description_lte_global_sim'); ?></p>

            <div class="box-repetidor">
                <?php
                if (have_rows('repeater_itens_lte_global_sim')):
                    while (have_rows('repeater_itens_lte_global_sim')):
                        the_row(); ?>
                        <div class="row-text">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14 28C15.8385 28 17.659 27.6379 19.3576 26.9343C21.0561 26.2307 22.5995 25.1995 23.8995 23.8995C25.1995 22.5995 26.2307 21.0561 26.9343 19.3576C27.6379 17.659 28 15.8385 28 14C28 12.1615 27.6379 10.341 26.9343 8.64243C26.2307 6.94387 25.1995 5.40052 23.8995 4.1005C22.5995 2.80048 21.0561 1.76925 19.3576 1.06569C17.659 0.362121 15.8385 -2.73959e-08 14 0C10.287 5.53285e-08 6.72601 1.475 4.1005 4.1005C1.475 6.72601 0 10.287 0 14C0 17.713 1.475 21.274 4.1005 23.8995C6.72601 26.525 10.287 28 14 28Z"
                                        fill="#04174F" />
                                    <path d="M8 13.7773L12.5962 18.3735L20.3744 10.5954" stroke="white" stroke-width="2" />
                                </svg>
                            </i>
                            <p class="text-item"><?php echo get_sub_field('text_label_repeater_lte_global_sim'); ?></p>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="tabs-content sync connectivity" id="tab-3">
    <div class="box-component-sync">
        <?php
        if (have_rows('box_repeater_connectivity')):
            while (have_rows('box_repeater_connectivity')):
                the_row(); ?>
                <?php
                $reverse = get_sub_field('reverse_side'); // retorna true ou false
                ?>

                <div class="wrapper <?php echo $reverse ? 'reverse-side' : ''; ?>">
                    <div class="box-content">
                        <p class="label-synciq"><?php echo get_sub_field('label_connectivity'); ?></p>
                        <div class="box-svg">
                            <?php $svg_file = get_sub_field('svg_connectivity');
                            if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                                echo '<i class="element">';
                                echo file_get_contents($svg_file['url']);
                                echo '</i>';
                            } ?>
                        </div>
                        <p class="description-synciq">
                            <?php echo get_sub_field('description_connectivity'); ?>
                        </p>
                        <div class="box-repeater-item">
                            <?php
                            if (have_rows('repeater_itens_connectivity')):
                                while (have_rows('repeater_itens_connectivity')):
                                    the_row(); ?>
                                    <div class="row-item">
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29"
                                                fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M14 28.5C15.8385 28.5 17.659 28.1379 19.3576 27.4343C21.0561 26.7307 22.5995 25.6995 23.8995 24.3995C25.1995 23.0995 26.2307 21.5561 26.9343 19.8576C27.6379 18.159 28 16.3385 28 14.5C28 12.6615 27.6379 10.841 26.9343 9.14243C26.2307 7.44387 25.1995 5.90052 23.8995 4.6005C22.5995 3.30048 21.0561 2.26925 19.3576 1.56569C17.659 0.862121 15.8385 0.5 14 0.5C10.287 0.5 6.72601 1.975 4.1005 4.6005C1.475 7.22601 0 10.787 0 14.5C0 18.213 1.475 21.774 4.1005 24.3995C6.72601 27.025 10.287 28.5 14 28.5Z"
                                                    fill="#04174F" />
                                                <path d="M8 14.2773L12.5962 18.8735L20.3744 11.0954" stroke="white" stroke-width="2" />
                                            </svg>
                                        </i>
                                        <p class="item-text">
                                            <?php echo get_sub_field('label_itens_repeater_connectivity'); ?>
                                        </p>
                                    </div>
                                <?php endwhile;
                            endif; ?>
                        </div>
                        <p class="description-synciq">
                            <?php echo get_sub_field('description_connectivity_02'); ?>
                        </p>

                    </div>
                    <?php
                    $video_modal = get_sub_field('video_modal_synvup');
                    if (!empty($video_modal)) {
                        $extra_class = ' has-modal';
                    }
                    ?>
                    <div class="box-image-video<?php echo $extra_class; ?>">
                        <?php
                        $image = get_sub_field('image_connectivity');
                        if ($image):
                            $image_url = $image['url'];
                            $image_alt = $image['alt']; ?>
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                        <?php endif; ?>
                        <?php
                        $video_url = get_sub_field('video_background');
                        $video_modal = get_sub_field('video_modal_synvup');

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
                                    <source src="<?php echo esc_url(get_sub_field('video_modal_synvup')); ?>"
                                        type="video/mp4" />
                                </video>
                            </div>


                        </div>

                    </div>
                </div>
            <?php endwhile;
        endif; ?>
    </div>
</div>


<?php
// Supondo que você está dentro do loop do post principal
$related_cases = get_field('case_studies');

if ($related_cases):
    echo '<div class="tabs-content case" id="tab-4"><div class="wrapper">';
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
<?php get_template_part('componentes/banner-lets-work'); ?>

<?php
get_footer();
?>