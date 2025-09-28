<?php
$link = get_field('link_lets_work_together', 'options');
if ($link):
    $link_url = $link['url'];
    $link_target = $link['target'] ? $link['target'] : '_self';
    ?>
    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="banner-lets-work">
        <div class="background">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/dist/img/lets-talk.webp" alt="Let’s work together">
        </div>
        <h3><?php echo get_field('title_lets_work_together', 'options'); ?></h3>
        <p class="cta-text"><?php echo esc_html($link['title']); ?></p>
    </a>
<?php endif; ?>