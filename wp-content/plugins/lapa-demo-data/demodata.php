<?php

function la_lapa_get_demo_array($dir_url, $dir_path){


    $default_image_setting = array(
        'shop_catalog_image_size' => array(
            'width' => 500,
            'height' => 0,
            'crop' => false
        ),
        'shop_single_image_size' => array(
            'width' => 500,
            'height' => 0,
            'crop' => false
        ),
        'shop_thumbnail_image_size' => array(
            'width' => 100,
            'height' => 0,
            'crop' => false
        ),
        'thumbnail_size_w' => 0,
        'thumbnail_size_h' => 0,
        'medium_size_w' => 0,
        'medium_size_h' => 0,
        'medium_large_size_w' => 0,
        'medium_large_size_h' => 0,
        'large_size_w' => 0,
        'large_size_h' => 0
    );

    $default_menu = array(
        'main-nav'              => 'Primary Navigation',
        'mobile-nav'            => 'Primary Navigation',
        'aside-nav'             => 'Primary Navigation',
        'shop-category-nav'     => 'Primary Navigation'
    );

    $default_page = array(
        'page_for_posts' 	            => 'Blog',
        'woocommerce_shop_page_id'      => 'Shop',
        'woocommerce_cart_page_id'      => 'Cart',
        'woocommerce_checkout_page_id'  => 'Checkout',
        'woocommerce_myaccount_page_id' => 'My Account'
    );

    $slider = $dir_path . 'Slider/';
    $content = $dir_path . 'Content/';
    $widget = $dir_path . 'Widget/';
    $setting = $dir_path . 'Setting/';
    $preview = $dir_url;


    $demo_data = array();

    for( $i = 1; $i <= 10; $i ++ ){
        $id = $i;
        if( $i < 10 ) {
            $id = '0'. $i;
        }

        $value = array();
        $value['title']             = 'Demo ' . $id;
        $value['category']          = 'demo';
        $value['demo_preset']       = 'home-' . $id;
        $value['demo_url']          = 'http://lapa.la-studioweb.com/home-' . $id . '/';
        $value['preview']           = $preview  .   'demo-' . $id . '.jpg';
        $value['option']            = $setting  .   'option-' . $id . '.json';
        $value['content']           = $content  .   'data-sample.xml';

        if( $i == 1 || $i == 4 || $i == 9 ) {
            $value['widget']            = $widget   .   'widget-' . $id . '.json';
        }
        else{
            $value['widget']            = $widget   .   'widget-default.json';
        }

        $value['pages']             = array_merge(
            $default_page,
            array(
                'page_on_front' => 'Home ' . $id
            )
        );

        $value['menu-locations']    = array_merge(
            $default_menu,
            array(

            )
        );
        $value['other_setting']    = array_merge(
            $default_image_setting,
            array(

            )
        );

        if($i != 2 && $i != 7){
            $value['slider']            = $slider   .   'home-'. $id .'.zip';
        }

        $demo_data['home-'. $id] = $value;
    }

    return $demo_data;
}