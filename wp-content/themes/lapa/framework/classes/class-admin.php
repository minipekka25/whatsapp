<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Lapa_Admin {

    public function __construct(){
        $this->init_page_options();
        $this->init_meta_box();
        $this->init_shortcode_manager();
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts') );
        add_action( 'customize_register', array( $this, 'override_customize_control') );
        new Lapa_MegaMenu_Init();
        add_filter('lastudio/filter/framework/field/icon/json', array( $this, 'add_icon_to_fw'));
    }

    public function admin_scripts(){
        wp_enqueue_style('lapa-admin-css', Lapa::$template_dir_url. '/assets/admin/css/admin.css');
        wp_enqueue_script('lapa-admin-theme', Lapa::$template_dir_url . '/assets/admin/js/admin.js', array( 'jquery'), false, true );
        $asset_font_without_domain = apply_filters('lapa/filter/assets_font_url', lapa_get_relative_url(untrailingslashit(get_template_directory_uri())));
        wp_add_inline_style(
            "lapa-admin-css",
            "@font-face{
                font-family: 'dl-icon';
                src: url('{$asset_font_without_domain}/assets/fonts/dl-icon.eot');
                src: url('{$asset_font_without_domain}/assets/fonts/dl-icon.eot') format('embedded-opentype'),
                     url('{$asset_font_without_domain}/assets/fonts/dl-icon.woff') format('woff'),
                     url('{$asset_font_without_domain}/assets/fonts/dl-icon.ttf') format('truetype'),
                     url('{$asset_font_without_domain}/assets/fonts/dl-icon.svg') format('svg');
                font-weight:normal;
                font-style:normal
            }"
        );
    }

    public function add_icon_to_fw( $icon_path ) {
        $icon_path[] = Lapa::$template_dir_path . '/assets/fonts/dl-icon.json';
        return $icon_path;
    }

    private function init_page_options(){
        $options = !empty(Lapa()->options()->sections) ? Lapa()->options()->sections : array();
        if(class_exists('LaStudio_Theme_Options') && !empty($options)) {
            $settings = array(
                'menu_title' => esc_html_x('Theme Options', 'admin-view', 'lapa'),
                'menu_type' => 'theme',
                'menu_slug' => 'theme_options',
                'ajax_save' => false,
                'show_reset_all' => true,
                'disable_header' => false,
                'framework_title' => esc_html_x('Lapa', 'admin-view', 'lapa')
            );
            LaStudio_Theme_Options::instance( $settings, $options, Lapa::get_option_name());
        }
        if(class_exists('LaStudio_Theme_Customize') && function_exists('la_convert_option_to_customize')){
            if(!empty($options)){
                $customize_options = la_convert_option_to_customize($options);
                LaStudio_Theme_Customize::instance( $customize_options, Lapa::get_option_name());
            }
        }
    }

    private function init_meta_box(){


        $default_metabox_opts = !empty(Lapa()->options()->metabox_sections) ? Lapa()->options()->metabox_sections : array();

        if(!class_exists('LaStudio_Metabox') || empty($default_metabox_opts)){
            return;
        }

        $metaboxes = array();
        $taxonomy_metaboxes = array();

        /**
         * Pages
         */
        $metaboxes[] = array(
            'id'        => Lapa::get_original_option_name(),
            'title'     => esc_html_x('Page Options', 'admin-view', 'lapa'),
            'post_type' => 'page',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => Lapa()->options()->get_metabox_by_sections(array(
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional',
                'fullpage'
            ))
        );

        /**
         * Post
         */
        $metaboxes[] = array(
            'id'        => Lapa::get_original_option_name(),
            'title'     => esc_html_x('Post Options', 'admin-view', 'lapa'),
            'post_type' => 'post',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => Lapa()->options()->get_metabox_by_sections(array(
                'post',
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional'
            ))
        );

        /**
         * Product
         */
        $metaboxes[] = array(
            'id'        => Lapa::get_original_option_name(),
            'title'     => esc_html_x('Product View Options', 'admin-view', 'lapa'),
            'post_type' => 'product',
            'context'   => 'normal',
            'priority'  => 'default',
            'sections'  => Lapa()->options()->get_metabox_by_sections(array(
                //'product',
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional'
            ))
        );

        /**
         * Portfolio
         */
        $metaboxes[] = array(
            'id'        => Lapa::get_original_option_name(),
            'title'     => esc_html_x('Portfolio Options', 'admin-view', 'lapa'),
            'post_type' => 'la_portfolio',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => Lapa()->options()->get_metabox_by_sections(array(
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional'
            ))
        );

        /**
         * Testimonial
         */
        $metaboxes[] = array(
            'id'        => Lapa::get_original_option_name(),
            'title'     => esc_html_x('Testimonial Information', 'admin-view', 'lapa'),
            'post_type' => 'la_testimonial',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => Lapa()->options()->get_metabox_by_sections(array(
                'testimonial'
            ))
        );

        /**
         * Member
         */
        $metaboxes[] = array(
            'id'        => Lapa::get_original_option_name(),
            'title'     => esc_html_x('Page Options', 'admin-view', 'lapa'),
            'post_type' => 'la_team_member',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => Lapa()->options()->get_metabox_by_sections(array(
                'member',
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional'
            ))
        );

        /**
         * Product Category
         */
        $taxonomy_metaboxes[] = array(
            'id'        => Lapa::get_original_option_name(),
            'title'     => esc_html_x('Product Category Options', 'admin-view', 'lapa'),
            'taxonomy' => 'product_cat',
            'sections'  => Lapa()->options()->get_metabox_by_sections(array(
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional'
            ))
        );

        /**
         * Category
         */
        $taxonomy_metaboxes[] = array(
            'id'        => Lapa::get_original_option_name(),
            'title'     => esc_html_x('Category Options', 'admin-view', 'lapa'),
            'taxonomy' => 'category',
            'sections'  => Lapa()->options()->get_metabox_by_sections(array(
                'layout',
                'header',
                'page_title_bar',
                'footer',
                'additional'
            ))
        );
        LaStudio_Metabox::instance($metaboxes);
        LaStudio_Taxonomy::instance($taxonomy_metaboxes);
    }

    private function init_shortcode_manager(){
        if(class_exists('LaStudio_Shortcode_Manager')){
            $options       = array();
            $options[]     = array(
                'title'      => esc_html_x('La Shortcodes', 'admin-view', 'lapa'),
                'shortcodes' => array(
                    array(
                        'name'      => 'la_text',
                        'title'     => esc_html_x('Custom Text', 'admin-view', 'lapa'),
                        'fields'    => array(
                            array(
                                'id'    => 'color',
                                'type'  => 'color_picker',
                                'title' => esc_html_x('Color', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'        => 'font_size',
                                'type'      => 'responsive',
                                'title'     => esc_html_x('Font Size', 'admin-view', 'lapa'),
                                'desc'      => esc_html_x('Enter the font size (ie 20px )', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'        => 'line_height',
                                'type'      => 'responsive',
                                'title'     => esc_html_x('Line Height', 'admin-view', 'lapa'),
                                'desc'      => esc_html_x('Enter the line height (ie 20px )', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'    => 'el_class',
                                'type'  => 'text',
                                'title' => esc_html_x('Extra Class Name', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'    => 'content',
                                'type'  => 'textarea',
                                'title' => esc_html_x('Content', 'admin-view', 'lapa')
                            )
                        )
                    ),
                    array(
                        'name'      => 'la_btn',
                        'title'     => esc_html_x('Button', 'admin-view', 'lapa'),
                        'fields'    => array(
                            array(
                                'id'    => 'title',
                                'type'  => 'text',
                                'title' => esc_html_x('Text', 'admin-view', 'lapa'),
                                'default' => esc_html_x('Text on the button', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'        => 'link',
                                'type'      => 'fieldset',
                                'title'     => esc_html_x('URL (Link)', 'admin-view', 'lapa'),
                                'desc'      => esc_html_x('Add link to button.', 'admin-view', 'lapa'),
                                'before'    => '<div data-parent-atts="1" data-atts="link" data-atts-separator="|">',
                                'after'     => '</div>',
                                'fields'    => array(
                                    array(
                                        'id'    => 'url',
                                        'type'  => 'text',
                                        'title' => esc_html_x('URL', 'admin-view', 'lapa'),
                                        'default' => '#',
                                        'attributes' => array(
                                            'data-child-atts' => 'url'
                                        )
                                    ),
                                    array(
                                        'id'    => 'title',
                                        'type'  => 'text',
                                        'title' => esc_html_x('Link Text', 'admin-view', 'lapa'),
                                        'attributes' => array(
                                            'data-child-atts' => 'title'
                                        )
                                    ),
                                    array(
                                        'id'        => 'target',
                                        'type'      => 'radio',
                                        'default'   => '_self',
                                        'class'     => 'la-radio-style',
                                        'title'     => esc_html_x('Open link in a new tab', 'admin-view', 'lapa'),
                                        'options'   => array(
                                            '_self' => esc_html_x('No', 'admin-view', 'lapa'),
                                            '_blank' => esc_html_x('Yes', 'admin-view', 'lapa')
                                        ),
                                        'attributes' => array(
                                            'data-child-atts' => 'target',
                                            'data-check' => 'yes'
                                        )
                                    ),
                                ),
                            ),

                            array(
                                'id'    => 'style',
                                'type'  => 'select',
                                'title' => esc_html_x('Style', 'admin-view', 'lapa'),
                                'desc'  => esc_html_x('Select button display style.', 'admin-view', 'lapa'),
                                'options'        => array(
                                    'flat'          => esc_html_x('Flat', 'admin-view', 'lapa'),
                                    'outline'       => esc_html_x('Outline', 'admin-view', 'lapa'),
                                ),
                                'default' => 'flat'
                            ),
                            array(
                                'id'    => 'border_width',
                                'type'  => 'select',
                                'title' => esc_html_x('Border width', 'admin-view', 'lapa'),
                                'desc'  => esc_html_x('Select border width.', 'admin-view', 'lapa'),
                                'options'        => array(
                                    '0'       => esc_html_x('None', 'admin-view', 'lapa'),
                                    '1'       => esc_html_x('1px', 'admin-view', 'lapa'),
                                    '2'       => esc_html_x('2px', 'admin-view', 'lapa'),
                                    '3'       => esc_html_x('3px', 'admin-view', 'lapa')
                                ),
                                'default' => 'square'
                            ),
                            array(
                                'id'    => 'shape',
                                'type'  => 'select',
                                'title' => esc_html_x('Shape', 'admin-view', 'lapa'),
                                'desc'  => esc_html_x('Select button shape.', 'admin-view', 'lapa'),
                                'options'        => array(
                                    'rounded'   => esc_html_x('Rounded', 'admin-view', 'lapa'),
                                    'square'    => esc_html_x('Square', 'admin-view', 'lapa'),
                                    'round'     => esc_html_x('Round', 'admin-view', 'lapa')
                                ),
                                'default' => 'square'
                            ),
                            array(
                                'id'    => 'color',
                                'type'  => 'select',
                                'title' => esc_html_x('Color', 'admin-view', 'lapa'),
                                'desc'  => esc_html_x('Select button color.', 'admin-view', 'lapa'),
                                'options'        => array(
                                    'black'      => esc_html_x('Black', 'admin-view', 'lapa'),
                                    'primary'    => esc_html_x('Primary', 'admin-view', 'lapa'),
                                    'white'      => esc_html_x('White', 'admin-view', 'lapa'),
                                    'white2'     => esc_html_x('White2', 'admin-view', 'lapa'),
                                    'gray'       => esc_html_x('Gray', 'admin-view', 'lapa'),
                                ),
                                'default' => 'black'
                            ),
                            array(
                                'id'    => 'size',
                                'type'  => 'select',
                                'title' => esc_html_x('Size', 'admin-view', 'lapa'),
                                'desc'  => esc_html_x('Select button display size.', 'admin-view', 'lapa'),
                                'options'        => array(
                                    'md'    => esc_html_x('Normal', 'admin-view', 'lapa'),
                                    'lg'    => esc_html_x('Large', 'admin-view', 'lapa'),
                                    'sm'    => esc_html_x('Small', 'admin-view', 'lapa'),
                                    'xs'    => esc_html_x('Mini', 'admin-view', 'lapa')
                                ),
                                'default' => 'md'
                            ),
                            array(
                                'id'    => 'align',
                                'type'  => 'select',
                                'title' => esc_html_x('Alignment', 'admin-view', 'lapa'),
                                'desc'  => esc_html_x('Select button alignment.', 'admin-view', 'lapa'),
                                'options'        => array(
                                    'inline'    => esc_html_x('Inline', 'admin-view', 'lapa'),
                                    'left'      => esc_html_x('Left', 'admin-view', 'lapa'),
                                    'right'     => esc_html_x('Right', 'admin-view', 'lapa'),
                                    'center'    => esc_html_x('Center', 'admin-view', 'lapa')
                                ),
                                'default' => 'left'
                            ),
                            array(
                                'id'    => 'el_class',
                                'type'  => 'text',
                                'title' => esc_html_x('Extra Class Name', 'admin-view', 'lapa'),
                                'desc' => esc_html_x('Style particular content element differently - add a class name and refer to it in custom CSS.', 'admin-view', 'lapa')
                            )
                        )
                    ),
                    array(
                        'name'      => 'la_dropcap',
                        'title'     => esc_html_x('DropCap', 'admin-view', 'lapa'),
                        'fields'    => array(
                            array(
                                'id'    => 'style',
                                'type'  => 'select',
                                'title' => esc_html_x('Design', 'admin-view', 'lapa'),
                                'options'        => array(
                                    '1'          => esc_html_x('Style 1', 'admin-view', 'lapa')
                                )
                            ),
                            array(
                                'id'    => 'color',
                                'type'  => 'color_picker',
                                'title' => esc_html_x('Text Color', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'    => 'content',
                                'type'  => 'text',
                                'title' => esc_html_x('Content', 'admin-view', 'lapa')
                            )
                        )
                    ),
                    array(
                        'name'      => 'la_quote',
                        'title'     => esc_html_x('Custom Quote', 'admin-view', 'lapa'),
                        'fields'    => array(
                            array(
                                'id'    => 'style',
                                'type'  => 'select',
                                'title' => esc_html_x('Design', 'admin-view', 'lapa'),
                                'options'        => array(
                                    '1'          => esc_html_x('Style 1', 'admin-view', 'lapa'),
                                    '2'          => esc_html_x('Style 2', 'admin-view', 'lapa'),
                                    '3'          => esc_html_x('Style 3', 'admin-view', 'lapa')
                                )
                            ),
                            array(
                                'id'    => 'author',
                                'type'  => 'text',
                                'title' => esc_html_x('Source Name', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'    => 'link',
                                'type'  => 'text',
                                'title' => esc_html_x('Source Link', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'    => 'content',
                                'type'  => 'textarea',
                                'title' => esc_html_x('Content', 'admin-view', 'lapa')
                            )
                        )
                    ),
                    array(
                        'name'          => 'la_icon_list',
                        'title'         => esc_html_x('Icon List', 'admin-view', 'lapa'),
                        'view'          => 'clone',
                        'clone_id'      => 'la_icon_list_item',
                        'clone_title'   => esc_html_x('Add New', 'admin-view', 'lapa'),
                        'fields'        => array(
                            array(
                                'id'        => 'el_class',
                                'type'      => 'text',
                                'title'     => esc_html_x('Extra Class', 'admin-view', 'lapa'),
                                'desc'      => esc_html_x('Style particular content element differently - add a class name and refer to it in custom CSS.', 'admin-view', 'lapa'),
                            )
                        ),
                        'clone_fields'  => array(
                            array(
                                'id'        => 'icon',
                                'type'      => 'icon',
                                'default'   => 'fa fa-check',
                                'title'     => esc_html_x('Icon', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'        => 'icon_color',
                                'type'      => 'color_picker',
                                'title'     => esc_html_x('Icon Color', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'        => 'content',
                                'type'      => 'textarea',
                                'title'     => esc_html_x('Content', 'admin-view', 'lapa')
                            ),
                            array(
                                'id'        => 'el_class',
                                'type'      => 'text',
                                'title'     => esc_html_x('Extra Class', 'admin-view', 'lapa'),
                                'desc'     => esc_html_x('Style particular content element differently - add a class name and refer to it in custom CSS.', 'admin-view', 'lapa'),
                            )
                        )
                    ),
                )
            );
            LaStudio_Shortcode_Manager::instance( $options );
        }
    }

    public function override_customize_control( $wp_customize ) {
        $wp_customize->remove_section('colors');
        $wp_customize->remove_section('header_image');
        $wp_customize->remove_section('background_image');
        $wp_customize->remove_control('display_header_text');
        $wp_customize->remove_control('site_icon');
    }

}