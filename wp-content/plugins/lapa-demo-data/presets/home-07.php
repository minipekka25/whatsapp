<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_home_07()
{
    return array(

        array(
            'key' => 'header_full_width',
            'value' => 'yes'
        ),
        array(
            'key' => 'header_transparency',
            'value' => 'no'
        ),

        array(
            'filter_name' => 'lapa/setting/option/get_single',
            'filter_func' => function( $value, $key ){
                if( $key == 'la_custom_css'){
                    $value .= '

';

                }
                return $value;
            },
            'filter_priority'  => 10,
            'filter_args'  => 3
        ),

    );
}