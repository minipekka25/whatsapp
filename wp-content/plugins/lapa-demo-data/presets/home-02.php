<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_home_02()
{
    return array(

        array(
            'key' => 'header_layout',
            'value' => '9'
        ),
        array(
            'key' => 'header_full_width|header_transparency',
            'value' => 'no'
        ),
        array(
            'key' => 'header_access_icon_2',
            'value' => array(
                array(
                    'type' => 'text',
                    'icon' => '',
                    'text' => 'Hurry Up! Get 10% Discount. Use Coupon Code:',
                    'el_class' => ''
                ),
                array(
                    'type' => 'link_text',
                    'icon' => '',
                    'text' => 'Lapastore',
                    'link' => 'javascript:;',
                    'el_class' => 'margin-left-5 text-color-primary'
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