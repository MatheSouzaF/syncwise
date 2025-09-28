<?php

// ACF functions here

setup_options_page();

function setup_options_page()
{

    if (function_exists('acf_add_options_page')) {

        $option_page = acf_add_options_page(array(
            'page_title'     => 'Configurações Gerais',
            'menu_title'     => 'Configurações Gerais',
            'menu_slug'     => 'configuracoes-gerais',
            'capability'     => 'edit_posts',
            'redirect'     => false
        ));

        $menu_page = acf_add_options_page(array(
            'page_title'  => __('Menu'),
            'menu_title'  => 'Menu',
            'menu_slug'  => 'Menu',
            'parent_slug' => 'configuracoes-gerais',
        ));
        $footer_page = acf_add_options_page(array(
            'page_title'  => __('Footer'),
            'menu_title'  => 'Footer',
            'menu_slug'  => 'Footer',
            'parent_slug' => 'configuracoes-gerais',
        ));
        $lets_work_together_page = acf_add_options_page(array(
            'page_title'  => __('Banner Let’s work together'),
            'menu_title'  => __('Banner Let’s work together'),
            'menu_slug'  => 'lets-work-together',
            'parent_slug' => 'configuracoes-gerais',
        ));
        $media_center_page = acf_add_options_page(array(
            'page_title'  => __('Banner Media Center'),
            'menu_title'  => __('Banner Media Center'),
            'menu_slug'  => 'banner-media-center',
            'parent_slug' => 'configuracoes-gerais',
        ));
        
    }
}

// Remover apenas o primeiro item "Configurações Gerais"
add_action('admin_menu', 'remove_configuracoes_gerais_main_item', 999);
function remove_configuracoes_gerais_main_item()
{
    remove_submenu_page('configuracoes-gerais', 'configuracoes-gerais');
}