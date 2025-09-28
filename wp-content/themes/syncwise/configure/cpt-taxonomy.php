<?php
function register_cpt_media_center() {
    $labels = array(
        'name'                  => 'Media Center',
        'singular_name'         => 'Media Center Item',
        'menu_name'             => 'Media Center',
        'name_admin_bar'        => 'Media Center',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Media Item',
        'new_item'              => 'New Media Item',
        'edit_item'             => 'Edit Media Item',
        'view_item'             => 'View Media Item',
        'all_items'             => 'All Media Items',
        'search_items'          => 'Search Media Items',
        'parent_item_colon'     => 'Parent Media Items:',
        'not_found'             => 'No media items found.',
        'not_found_in_trash'    => 'No media items found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'media-center', 'with_front' => false),
        'menu_icon'          => 'dashicons-clipboard',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true, // Enables Gutenberg and REST API
        'publicly_queryable' => true,
        'hierarchical'       => false,
        'capability_type'    => 'post',
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 5,
        'query_var'          => true,
    );

    register_post_type('media_center', $args);
}
add_action('init', 'register_cpt_media_center', 0);
function register_cpt_case_studies() {
    $labels = array(
        'name'                  => 'Case Studies',
        'singular_name'         => 'Case Studies Item',
        'menu_name'             => 'Case Studies',
        'name_admin_bar'        => 'Case Studies',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Case Studies Item',
        'new_item'              => 'New Case Studies Item',
        'edit_item'             => 'Edit Case Studies Item',
        'view_item'             => 'View Case Studies Item',
        'all_items'             => 'All Case Studies Items',
        'search_items'          => 'Search Case Studies Items',
        'parent_item_colon'     => 'Parent Case Studies Items:',
        'not_found'             => 'No case studies items found.',
        'not_found_in_trash'    => 'No case studies items found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'case-studies', 'with_front' => false),
        'menu_icon'          => 'dashicons-book',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true, // Enables Gutenberg and REST API
        'publicly_queryable' => true,
        'hierarchical'       => false,
        'capability_type'    => 'post',
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 6,
        'query_var'          => true,
    );

    register_post_type('case_studies', $args);
}
add_action('init', 'register_cpt_case_studies', 0);
