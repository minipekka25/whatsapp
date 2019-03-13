<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_home_04()
{
    return array(

        array(
            'key' => 'logo_transparency',
            'value' => 504
        ),
        array(
            'key' => 'logo_transparency_2x',
            'value' => 505
        ),

        array(
            'key' => 'header_layout',
            'value' => '5'
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
            'key' => 'transparency_mm_lv_1_color',
            'value' => 'rgba(255,255,255,0.7)'
        ),

        array(
            'key' => 'transparency_mm_lv_1_hover_color',
            'value' => 'rgba(255,255,255,1)'
        ),

        array(
            'key' => 'header_access_icon_1',
            'value' => array()
        ),
        array(
            'key' => 'header_transparency',
            'value' => 'yes'
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
            'key' => 'enable_footer_copyright',
            'value' => 'no'
        ),

        array(
            'key' => 'footer_space',
            'value' => array(
                'padding_top' => '25px',
                'padding_bottom' => '0px'
            )
        ),

        array(
            'key' => 'la_custom_css',
            'value' => '
.header-v5 #masthead_aside .site-header-inner{
    padding: 70px 0px 70px 70px;
}
.header-v5 #masthead_aside{
    width: 270px;
}
.header-v5 #masthead_aside .header-component-outer:not(.header-bottom){
    text-align: inherit;
}
.header-v5:not(.rtl) #page.site{
    padding-left: 270px;
}
.header-v5.rtl #page.site{
    padding-right: 270px;
}
.header-v5:not(.rtl) #masthead_aside .accordion-menu li > ul{
    margin-left: 20px;
}
.header-v5.rtl #masthead_aside .accordion-menu li > ul{
    margin-right: 20px;
}
.header-v5 #masthead_aside .header-component-outer.header-right {
    margin-top: 15vh;
    max-height: 60vh;
    overflow: auto;
}
@media(max-width: 1500px){
    .header-v5 #masthead_aside .header-component-outer.header-right{
        margin-top: 7vh;
    }
}
.site-footer{
    font-size: 12px;
}
@media(min-width: 992px){
    .enable-header-transparency.header-v5 .site-footer{
        position: absolute;
        left: 0;
        width: 100%;
        bottom: 0;
    }
    .enable-header-transparency.header-v5 .site-footer .footer-top a,
    .enable-header-transparency.header-v5 .site-footer .footer-top{
        color: #fff;
    }
}

            '
        ),

        array(
            'filter_name' => 'lapa/filter/footer_column_1',
            'value' => 'home-04-footers'
        ),
    );
}