<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Lapa_Blog {

    public function __construct(){
        add_filter( 'get_the_excerpt', array( $this, 'trim_excerpt_length' ), 0 );
        add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 100 );
        add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
        add_filter( 'lapa/setting/get_setting_by_context', array( $this, 'override_setting_by_context'), 20, 3);
    }

    public function excerpt_more( ){
        return '&hellip;';
    }

    public function trim_excerpt_length( $text ) {
        if(!empty($text)){
            $excerpt_length = apply_filters( 'excerpt_length', 55 );
            $excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
            $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
        }
        return $text;
    }

    public function excerpt_length( $length ) {
        // Normal blog posts excerpt length.
        if ( ! is_null( Lapa()->settings()->get( 'blog_excerpt_length' ) ) ) {
            $length = Lapa()->settings()->get( 'blog_excerpt_length' );
        }
        $length = absint($length);
        return $length;
    }

    public function override_setting_by_context( $value, $key, $context ){
        if($key == 'page_title_bar_layout'){
            if(in_array('is_home', $context) || in_array('is_category', $context) || in_array('is_tag', $context)){
                $from_blog_setting = Lapa()->settings()->get('page_title_bar_layout_blog_global', 'off');
                $fn = 'get_term_meta';
                if(in_array('is_home', $context)){
                    $fn = 'get_post_meta';
                }
                $_from_current_setting = Lapa()->settings()->$fn( get_queried_object_id(), $key );
                if($from_blog_setting == 'off' && $_from_current_setting == 'inherit'){
                    return 'hide';
                }
            }
        }
        return $value;
    }

}