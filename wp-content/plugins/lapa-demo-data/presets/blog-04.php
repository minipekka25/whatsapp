<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_blog_04()
{
    return array(

        array(
            'key' => 'layout_blog',
            'value' => 'col-1c'
        ),
        array(
            'key' => 'blog_design',
            'value' => 'grid_4'
        ),
        array(
            'key' => 'blog_excerpt_length',
            'value' => '11'
        ),
        array(
            'key' => 'blog_thumbnail_size',
            'value' => '570x320'
        ),
        array(
            'key' => 'blog_post_column',
            'value' => array(
                'xlg' => 2,
                'lg' => 2,
                'md' => 2,
                'sm' => 1,
                'xs' => 1,
                'mb' => 1
            )
        ),
        array(
            'filter_name' => 'lapa/setting/option/get_single',
            'filter_func' => function( $value, $key ){
                if( $key == 'la_custom_css'){
                    $value .= '
.showposts-grid.grid-4 .blog_item--title .entry-title{
    font-size: 24px;
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