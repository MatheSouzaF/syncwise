<?php
/**
 * Fix pagination issues with custom post types
 */

// Fix the main query for custom post type archives
function fix_media_center_pagination($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive('media_center')) {
            $query->set('posts_per_page', 2);
        }
    }
}
add_action('pre_get_posts', 'fix_media_center_pagination');

// Add rewrite rules for pagination
function add_media_center_rewrite_rules() {
    add_rewrite_rule(
        'media-center/page/([0-9]+)/?$',
        'index.php?post_type=media_center&paged=$matches[1]',
        'top'
    );
}
add_action('init', 'add_media_center_rewrite_rules');

// Force permalink flush on theme activation
function force_permalink_flush() {
    if (get_option('theme_switched')) {
        delete_option('theme_switched');
        flush_rewrite_rules();
    }
}
add_action('after_switch_theme', function() {
    add_option('theme_switched', true);
});
add_action('init', 'force_permalink_flush');
