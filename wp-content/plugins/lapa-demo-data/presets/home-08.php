<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_home_08()
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
            'value' => '8'
        ),
        array(
            'key' => 'header_full_width',
            'value' => 'no'
        ),
        array(
            'key' => 'header_transparency',
            'value' => 'yes'
        ),

        array(
            'key' => 'header_access_icon_2',
            'value' => array(
                array(
                    'type' => 'link_text',
                    'icon' => 'fa fa-phone',
                    'text' => '(+61 2) 9251 5600',
                    'link' => 'tel:+61292515600',
                    'el_class' => ''
                ),
                array(
                    'type' => 'text',
                    'icon' => 'fa fa-clock-o',
                    'text' => '9:00 - 18:00, Mon - Sat',
                    'el_class' => ''
                )
            ),
        ),

        array(
            'key' => 'header_height',
            'value' => '120px'
        ),

        array(
            'key' => 'header_sticky_height',
            'value' => '100px'
        ),
    );
}