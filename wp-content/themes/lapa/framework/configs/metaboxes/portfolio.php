<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * MetaBox
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function lapa_metaboxes_section_portfolio( $sections )
{
    $sections['portfolio'] = array(
        'name'      => 'portfolio',
        'title'     => esc_html_x('Portfolio', 'admin-view', 'lapa'),
        'icon'      => 'laicon-file',
        'fields'    => array(
            array(
                'id'        => 'short_description',
                'type'      => 'textarea',
                'title'     => esc_html_x('Short Description', 'admin-view', 'lapa')
            ),
            array(
                'id'        => 'portfolio_design',
                'type'      => 'select',
                'title'     => esc_html_x('Portfolio Single Design', 'admin-view', 'lapa'),
                'options'    => array(
                    'inherit' => esc_html_x('Inherit', 'admin-view', 'lapa'),
                    '1' => esc_html_x('Design 01', 'admin-view', 'lapa'),
                    '2' => esc_html_x('Design 02', 'admin-view', 'lapa'),
                    'use_vc' => esc_html_x('Show only post content', 'admin-view', 'lapa')
                )
            ),
            array(
                'id'        => 'gallery',
                'type'      => 'gallery',
                'title'     => esc_html_x('Gallery', 'admin-view', 'lapa')
            ),
            array(
                'id'        => 'client',
                'type'      => 'text',
                'title'     => esc_html_x('Client Name', 'admin-view', 'lapa')
            ),
            array(
                'id'        => 'timeline',
                'type'      => 'text',
                'title'     => esc_html_x('Timeline', 'admin-view', 'lapa')
            ),
            array(
                'id'        => 'location',
                'type'      => 'text',
                'title'     => esc_html_x('Location', 'admin-view', 'lapa')
            ),
            array(
                'id'        => 'website',
                'type'      => 'text',
                'title'     => esc_html_x('Website', 'admin-view', 'lapa')
            )
        )
    );
    return $sections;
}