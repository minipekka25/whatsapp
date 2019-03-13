<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


add_filter('woocommerce_product_related_posts_relate_by_category', '__return_false');
add_filter('woocommerce_product_related_posts_relate_by_tag', '__return_false');
add_filter('woocommerce_product_related_posts_force_display', '__return_true');


add_filter('body_class', 'lapa_preset_add_body_classes');

function lapa_preset_add_body_classes( $class ){
    $class[] = 'isLaWebRoot';
    return $class;
}

add_action( 'pre_get_posts', 'lapa_preset_change_blog_posts' );
function lapa_preset_change_blog_posts( $query ){

    if($query->is_home() && $query->is_main_query()){

        if(isset($_GET['la_preset']) && $_GET['la_preset'] == 'blog-02'){
            $query->set( 'posts_per_page', 9 );
        }
        if(isset($_GET['la_preset']) && $_GET['la_preset'] == 'blog-04'){
            $query->set( 'posts_per_page', 6 );
        }

    }

}

add_action( 'woocommerce_product_query', 'lapa_demo_product_query', 20);
function lapa_demo_product_query( $q ){
    if(is_shop()){
        if(!isset($_GET['orderby']) || ( isset($_GET['orderby']) && $_GET['orderby'] != 'date' )){
            $q->set( 'orderby', 'date' );
            $q->set( 'order', 'ASC' );
        }
        if(isset($_GET['la_preset']) && $_GET['la_preset'] == 'shop-fullwidth'){
            $q->set( 'posts_per_page', 15 );
        }
        if(isset($_GET['la_preset']) && $_GET['la_preset'] == 'shop-04-columns'){
            $tax_query[] = array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => array( 35, 22 ),
                'operator' => 'IN'
            );

            $q->set( 'tax_query', $tax_query );
            $q->set( 'orderby', 'date' );
            $q->set( 'order', 'DESC' );
        }
    }
}

add_filter( 'lapa/filter/page_title', 'lapa_demo_modify_product_page_title', 10, 1 );
function lapa_demo_modify_product_page_title( $title ) {
    if(is_singular('product')){
        global $product;
        return sprintf( '<header><h3 class="text-capitalize page-title h3">%s</h3></header>', $product->get_type() . ' Product' );
    }
    return $title;
}