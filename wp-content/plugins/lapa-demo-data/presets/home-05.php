<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_home_05()
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
@media (min-width: 1300px){
    #main.site-main > .container{
        padding-left: 0;
        padding-right: 0;
    }
    footer#colophon{
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 40px;
    }
    #main.site-main{
        padding-left: 25px;
        padding-right: 25px;
    }
}
@media (min-width: 1400px){
    #main.site-main{
        padding-left: 45px;
        padding-right: 45px;
    }
    footer#colophon{
        padding-left: 60px;
        padding-right: 60px;
        padding-bottom: 60px;
    }
}
@media (min-width: 1500px){
    #main.site-main{
        padding-left: 65px;
        padding-right: 65px;
    }
    footer#colophon{
        padding-left: 80px;
        padding-right: 80px;
        padding-bottom: 80px;
    }
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