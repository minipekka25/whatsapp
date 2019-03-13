<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_shop_03_columns()
{
    return array(

        array(
            'key' => 'layout_archive_product',
            'value' => 'col-1c'
        ),

        array(
            'key' => 'active_shop_filter',
            'value' => 'on'
        ),
        array(
            'key' => 'woocommerce_toggle_grid_list',
            'value' => 'no'
        ),

        array(
            'key' => 'main_full_width',
            'value' => 'no'
        ),

        array(
            'key' => 'woocommerce_shop_page_columns',
            'value' => array(
                'xlg' => 3,
                'lg' => 3,
                'md' => 3,
                'sm' => 2,
                'xs' => 1,
                'mb' => 1
            )
        ),

        array(
            'filter_name' => 'lapa/setting/option/get_single',
            'filter_func' => function( $value, $key ){
                if( $key == 'la_custom_css'){
                    $value .= '
@media(min-width: 1200px){
    .la-advanced-product-filters .sidebar-inner .widget:not([class*="col-"]) {
        width: 25% !important;
    }
    .la-advanced-product-filters .sidebar-inner .widget:not([class*="col-"]).woocommerce-widget-layered-nav li {
        width: 50%;
    }
}
@media(max-width: 1200px) and (min-width: 767px){
    .la-advanced-product-filters .sidebar-inner .widget .widget-title:after{
        display: none;
    }
}
';
                }
                return $value;
            },
            'filter_priority'  => 10,
            'filter_args'  => 3
        ),

        array(
            'filter_name' => 'lapa/filter/page_title',
            'value' => '<header><h1 class="page-title h3">Shop 03 Columns</h1></header>'
        ),
    );
}