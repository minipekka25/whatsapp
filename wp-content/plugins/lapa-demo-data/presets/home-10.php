<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_home_10()
{
    return array(

        array(
            'key'   => 'header_layout',
            'value' => '7'
        ),

        array(
            'key'   => 'enable_header_top',
            'value' => 'yes'
        ),

        array(
            'key'   => 'header_top_elements',
            'value' => array(
                array(
                    'type' => 'link_text',
                    'icon' => 'fa fa-phone',
                    'text' => '(+61 2) 9251 5600',
                    'link' => 'tel:+61292515600',
                    'el_class' => 'hidden-xs'
                ),
                array(
                    'type' => 'text',
                    'icon' => 'fa fa-clock-o',
                    'text' => '9:00 - 18:00, Mon - Sat',
                    'el_class' => 'hidden-xs'
                ),
                array(
                    'type' => 'dropdown_menu',
                    'icon' => '',
                    'text' => 'Currency',
                    'menu_id'   => 38,
                    'el_class' => 'component-dropdown-display-arrow component-dropdown-display-active-item pull-right'
                ),
                array(
                    'type' => 'dropdown_menu',
                    'icon' => '',
                    'text' => 'Language',
                    'menu_id'   => 37,
                    'el_class' => 'component-dropdown-display-arrow component-dropdown-display-active-item pull-right'
                ),
                array(
                    'type' => 'dropdown_menu',
                    'icon' => '',
                    'text' => 'Welcome to {{user_name}}',
                    'menu_id'   => 20,
                    'el_class' => 'component-dropdown-display-arrow pull-right hidden-xs'
                )
            ),
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
                    'type' => 'cart',
                    'icon' => 'dl-icon-cart28',
                    'link' => '#',
                    'el_class' => ''
                ),
                array(
                    'type' => 'aside_header',
                    'icon' => 'dl-icon-menu3',
                    'el_class' => ''
                )
            )
        ),

        array(
            'key' => 'header_height',
            'value' => '120px'
        ),

        array(
            'key' => 'header_sticky_height',
            'value' => '100px'
        ),

        array(
            'filter_name' => 'lapa/setting/option/get_single',
            'filter_func' => function( $value, $key ){
                if( $key == 'la_custom_css'){
                    $value .= '
.site-header-top {
    border-bottom: 1px solid #e8e8e8;
}
.header-v7 .site-header__nav-primary {
    background-image: -moz-linear-gradient( 0deg, rgb(247,247,247) 0%, rgb(243,234,228) 100%);
    background-image: -webkit-linear-gradient( 0deg, rgb(247,247,247) 0%, rgb(243,234,228) 100%);
    background-image: -ms-linear-gradient( 0deg, rgb(247,247,247) 0%, rgb(243,234,228) 100%);
}
';

                }
                return $value;
            },
            'filter_priority'  => 10,
            'filter_args'  => 3
        ),


    );
}