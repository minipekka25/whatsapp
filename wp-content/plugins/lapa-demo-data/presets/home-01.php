<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_home_01()
{
    return array(

        array(
            'key' => 'logo',
            'value' => 502
        ),
        array(
            'key' => 'logo_2x',
            'value' => 503
        ),

        array(
            'key' => 'header_layout',
            'value' => '6'
        ),
        array(
            'key' => 'header_transparency',
            'value' => 'no'
        ),
        array(
            'key' => 'offcanvas_text_color|offcanvas_link_color',
            'value' => '#343538'
        ),
        array(
            'key' => 'offcanvas_link_hover_color|primary_color',
            'value' => '#e7d7cb'
        ),

        array(
            'key' => 'footer_layout',
            'value' => '1col'
        ),
        array(
            'key' => 'footer_full_width',
            'value' => 'yes'
        ),
        array(
            'key' => 'footer_copyright',
            'value' => '<div class="small text-uppercase text-center">&copy; 2018 by LaStudio</div>'
        ),
        array(
            'key' => 'footer_background',
            'value' => array(
                'color' => 'rgba(0,0,0,0)'
            )
        ),
        array(
            'key' => 'footer_copyright_background_color',
            'value' => '#fff'
        ),
        array(
            'key' => 'footer_copyright_text_color|footer_copyright_link_color|footer_text_color|footer_heading_color|footer_link_color',
            'value' => '#8a8a8a'
        ),
        array(
            'key' => 'footer_copyright_link_hover_color|footer_link_hover_color',
            'value' => '#232324'
        ),

        array(
            'key' => 'footer_space',
            'value' => array(
                'padding_top' => '30px',
                'padding_bottom' => '10px'
            )
        ),

        array(
            'key' => 'la_custom_css',
            'value' => '
.site-footer{
	font-size: 12px;
}
@media(min-width: 992px){
    .footer-bottom {
        position: absolute;
        background: transparent;
        transform: rotate(-90deg);
        bottom: 40px;
        z-index: 999;
        letter-spacing: 3px;
        transform-origin: 0 100% 0;
    }
    body:not(.rtl) .footer-bottom{
        left: -25px;
    }
    body.rtl .footer-bottom{
        right: -225px;
    }
    .footer-bottom .container {
        padding: 0 !important;
        width: 100%;
    }
}
            '
        ),

        array(
            'filter_name' => 'lapa/filter/footer_column_1',
            'value' => 'home-01-footers'
        ),
    );
}