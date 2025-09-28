</main>

<footer class="footer">
    <div class="wrapper content-footer">
        <div class="box-links-footer">
            <?php
            if (have_rows('repeater_links_footer', 'options')):
                while (have_rows('repeater_links_footer', 'options')):
                    the_row(); ?>
                    <div class="content-links">
                        <h3 class="title-box-links blue-txt"><?php echo get_sub_field('title_box_link', 'options'); ?></h3>

                        <div class="box-links">
                            <?php
                            if (have_rows('link_footer_box', 'options')):
                                while (have_rows('link_footer_box', 'options')):
                                    the_row(); ?>
                                    <?php
                                    $link = get_sub_field('link_footer', 'options');
                                    if ($link):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                        <a class="grey-txt" href="<?php echo esc_url($link_url); ?>"
                                            target="<?php echo esc_attr($link_target); ?>">
                                            <p class=""><?php echo esc_html($link_title); ?></p>
                                        </a>
                                    <?php endif; ?>
                                <?php endwhile;
                            endif; ?>
                        </div>
                    </div>
                <?php endwhile;
            endif; ?>
        </div>
        <div class="box-logos-footer">
            <div class="box-email-footer">
                <h3 class="titulo-email blue-txt"><?php echo get_field('title_email', 'options'); ?></h3>
                <div class="email-footer">
                    <?php
                    // Chamar o formulário CF7 via ACF
                    $form_id = get_field('form_footer', 'options');
                    if ($form_id) {
                        echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
                    } else {
                        echo 'Formulário não configurado.';
                    }
                    ?>
                </div>
            </div>
            <div class="box-social-midias-footer">

                <h3 class="titulo-social blue-txt"><?php echo get_field('title_social_media', 'options'); ?></h3>
                <div class="box-social-midias">
                    <?php
                    if (have_rows('social_media_logo_repeater', 'options')):
                        while (have_rows('social_media_logo_repeater', 'options')):
                            the_row(); ?>
                            <?php
                            $link = get_sub_field('link_social_media_logos', 'options');
                            if ($link):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                <a class="" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                    <div class="box-svg">
                                        <?php $svg_file = get_sub_field('svg_social_media_logos', 'options');
                                        if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                                            echo '<i class="element">';
                                            echo file_get_contents($svg_file['url']);
                                            echo '</i>';
                                        } ?>
                                    </div>
                                </a>
                            <?php endif; ?>
                        <?php endwhile;
                    endif; ?>
                </div>
            </div>
            <div class="box-links-politicas">
                <?php
                if (have_rows('links_policies', 'options')):
                    $first = true; // Flag para controlar o primeiro item
                    while (have_rows('links_policies', 'options')):
                        the_row();

                        // Se não for o primeiro, adiciona o bullet
                        if (!$first) {
                            echo '<span class="bullet-separator">•</span>';
                        }

                        $first = false; // Define como false após o primeiro loop
                        ?>
                        <div class="row-links">
                            <?php
                            $link = get_sub_field('link_policies', 'options');
                            if ($link):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                <a class="link-policies" href="<?php echo esc_url($link_url); ?>"
                                    target="<?php echo esc_attr($link_target); ?>">
                                    <p><?php echo esc_html($link_title); ?></p>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endwhile;
                endif;
                ?>
            </div>

        </div>
    </div>
    <div class="wrapper content-copy">
        <div class="box-copy">
            <div class="box-svg-header">
                <?php $svg_file = get_field('svg_logo', 'options');
                if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
                    echo '<a href="' . esc_url(home_url('/')) . '">';
                    echo '<i class="element">';
                    echo file_get_contents($svg_file['url']);
                    echo '</i>';
                    echo '</a>';
                } ?>
            </div>
            <p class="grey-txt">© SyncWise, LLC. • <?php echo date('Y'); ?> All rights reserved.</p>

        </div>
    </div>
</footer>
<script src="https://cdn.plyr.io/3.8.3/plyr.js"></script>

<?php wp_footer(); ?>
</body>

</html>