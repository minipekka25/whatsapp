<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_home_09()
{
    return array(

        array(
            'key' => 'logo',
            'value' => 170
        ),
        array(
            'key' => 'logo_2x',
            'value' => 171
        ),
        array(
            'key' => 'header_layout',
            'value' => '5'
        ),

        array(
            'key' => 'header_full_width',
            'value' => 'no'
        ),

        array(
            'key' => 'header_transparency',
            'value' => 'no'
        ),

        array(
            'key' => 'header_access_icon_1',
            'value' => array(
                array(
                    'type' => 'search_1',
                    'el_class' => ''
                ),
                array(
                    'type' => 'dropdown_menu',
                    'icon' => 'dl-icon-user12',
                    'menu_id' => 20,
                    'el_class' => ''
                ),
                array(
                    'type' => 'cart',
                    'icon' => 'dl-icon-cart28',
                    'link' => '#',
                    'el_class' => ''
                )
            )
        ),
        array(
            'key' => 'header_text_color',
            'value' => '#8a8a8a'
        ),

        array(
            'filter_name' => 'lapa/filter/header_sidebar_widget_bottom',
            'value' => 'home-09-header-bottom'
        ),
    );
}