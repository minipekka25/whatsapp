<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_blog_02()
{
    return array(

        array(
            'key' => 'layout_blog',
            'value' => 'col-1c'
        ),
        array(
            'key' => 'blog_design',
            'value' => 'grid_3'
        ),
        array(
            'key' => 'blog_excerpt_length',
            'value' => '11'
        ),
        array(
            'key' => 'blog_thumbnail_size',
            'value' => '370x280'
        ),
        array(
            'key' => 'blog_post_column',
            'value' => array(
                'xlg' => 3,
                'lg' => 3,
                'md' => 2,
                'sm' => 2,
                'xs' => 2,
                'mb' => 1
            )
        ),
        array(
            'filter_name' => 'lapa/setting/option/get_single',
            'filter_func' => function( $value, $key ){
                if( $key == 'la_custom_css'){
                    $value .= '
.showposts-grid.grid-3 .blog_item--title .entry-title{
    font-size: 20px;
}
.showposts-grid.grid-space-default .blog_item--inner{
    margin-bottom: 60px;
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