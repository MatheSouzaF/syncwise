<?php

// CPT TAXONOMY

include('configure/cpt-taxonomy.php');

// PAGINATION FIX

include('configure/pagination-fix.php');

// Flush rewrite rules after registering custom post types
function flush_rewrite_rules_after_cpt() {
    // Only flush if we're in admin and the option doesn't exist
    if (is_admin() && !get_option('syncwise_flush_rewrite_rules_flag')) {
        flush_rewrite_rules();
        add_option('syncwise_flush_rewrite_rules_flag', true);
    }
}
add_action('init', 'flush_rewrite_rules_after_cpt', 999);

// CONFIG

include('configure/configure.php');

// JAVASCRIPT & CSS

include('configure/js-css.php');

// SHORTCODES

include('configure/shortcodes.php');

// ACF

include('configure/acf.php');

// HOOKS ADMIN


if (is_admin()) {
	include('configure/admin.php');
}

