<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_lapa_preset_blog_01()
{
    return array(

        array(
            'key' => 'layout_blog',
            'value' => 'col-1c'
        ),
        array(
            'key' => 'blog_design',
            'value' => 'list_1'
        ),
        array(
            'key' => 'blog_excerpt_length',
            'value' => '18'
        ),
        array(
            'key' => 'blog_thumbnail_size',
            'value' => '670x450'
        )
    );
}