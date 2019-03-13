<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_blog_05()
{
    return array(

        array(
            'key' => 'layout_blog',
            'value' => 'col-1c'
        ),
        array(
            'key' => 'blog_design',
            'value' => 'list_2'
        ),
        array(
            'key' => 'blog_excerpt_length',
            'value' => '20'
        ),
        array(
            'key' => 'blog_thumbnail_size',
            'value' => 'full'
        ),
        array(
            'filter_name' => 'lapa/setting/option/get_single',
            'filter_func' => function( $value, $key ){
                if( $key == 'la_custom_css'){
                    $value .= '
.showposts-list.list-2 .blog_item--title .entry-title{
    font-size: 30px;
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