<?php

/**
 * This function allow get property of `woocommerce_loop` inside the loop
 * @since 1.0.1
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */

if(!function_exists('lapa_get_wc_loop_prop')){
    function lapa_get_wc_loop_prop( $prop, $default = ''){
        return isset( $GLOBALS['woocommerce_loop'], $GLOBALS['woocommerce_loop'][ $prop ] ) ? $GLOBALS['woocommerce_loop'][ $prop ] : $default;
    }
}

/**
 * This function allow set property of `woocommerce_loop`
 * @since 1.0.1
 * @param string $prop Prop to set.
 * @param string $value Value to set.
 */

if(!function_exists('lapa_set_wc_loop_prop')){
    function lapa_set_wc_loop_prop( $prop, $value = ''){
        if(isset($GLOBALS['woocommerce_loop'])){
            $GLOBALS['woocommerce_loop'][ $prop ] = $value;
        }
    }
}

/**
 * This function allow get property of `lapa_loop` inside the loop
 * @since 1.0.1
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */

if(!function_exists('lapa_get_theme_loop_prop')){
    function lapa_get_theme_loop_prop( $prop, $default = ''){
        return isset( $GLOBALS['lapa_loop'], $GLOBALS['lapa_loop'][ $prop ] ) ? $GLOBALS['lapa_loop'][ $prop ] : $default;
    }
}

remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );

if(!function_exists('lapa_override_yikes_mailchimp_page_data')){
    function lapa_override_yikes_mailchimp_page_data($page_data, $form_id){
        $new_data = new stdClass();
        if(isset($page_data->ID)){
            $new_data->ID = $page_data->ID;
        }
        return $new_data;
    }
    add_filter('yikes-mailchimp-page-data', 'lapa_override_yikes_mailchimp_page_data', 10, 2);
}


if( !function_exists('lapa_allow_shortcode_text_in_component_text') ) {
    function lapa_allow_shortcode_text_in_component_text( $text ){
        return do_shortcode($text);
    }
    add_filter('lapa/filter/component/text', 'lapa_allow_shortcode_text_in_component_text');
}

if(!function_exists('lapa_override_woothumbnail_size')){
    function lapa_override_woothumbnail_size( $size ) {
        if(!function_exists('wc_get_theme_support')){
            return $size;
        }
        $size['width'] = absint( wc_get_theme_support( 'gallery_thumbnail_image_width', 100 ) );
        $cropping      = get_option( 'woocommerce_thumbnail_cropping', '1:1' );

        if ( 'uncropped' === $cropping ) {
            $size['height'] = '';
            $size['crop']   = 0;
        }
        elseif ( 'custom' === $cropping ) {
            $width          = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_width', '4' ) );
            $height         = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_height', '3' ) );
            $size['height'] = absint( round( ( $size['width'] / $width ) * $height ) );
            $size['crop']   = 1;
        }
        else {
            $cropping_split = explode( ':', $cropping );
            $width          = max( 1, current( $cropping_split ) );
            $height         = max( 1, end( $cropping_split ) );
            $size['height'] = absint( round( ( $size['width'] / $width ) * $height ) );
            $size['crop']   = 1;
        }

        return $size;
    }
    add_filter('woocommerce_get_image_size_gallery_thumbnail', 'lapa_override_woothumbnail_size');
}

if(!function_exists('lapa_override_filter_woocommerce_format_content')){
    function lapa_override_filter_woocommerce_format_content( $format, $raw_string ){
        $format = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $raw_string);
        return apply_filters( 'woocommerce_short_description', $format );
    }
    add_filter('woocommerce_format_content', 'lapa_override_filter_woocommerce_format_content', 99, 2);
}

if(!function_exists('lapa_wc_product_loop')){
    function lapa_wc_product_loop(){
        if(!function_exists('WC')){
            return false;
        }
        return have_posts() || 'products' !== woocommerce_get_loop_display_mode();
    }
}

/**
 * @since 1.0.3
 */

if(!function_exists('lapa_get_the_excerpt')){
    function lapa_get_the_excerpt($length = null){
        ob_start();

        $length = absint($length);

        if(!empty($length)){
            remove_filter('get_the_excerpt', 'wp_trim_excerpt');
            add_filter('excerpt_length', function() use ($length) {
                return $length;
            }, 1012);
        }

        the_excerpt();

        if(!empty($length)) {
            remove_all_filters('excerpt_length', 1012);
        }
        $output = ob_get_clean();

        $output = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $output);

        $output = strip_tags( $output );

        if(!empty($output)){
            $output = sprintf('<p>%s</p>', $output);
        }

        return $output;
    }
}

if(!function_exists('lapa_override_portfolio_content_type_args')){
    function lapa_override_portfolio_content_type_args( $args, $post_type_name ) {
        if($post_type_name == 'la_portfolio'){
            $label = esc_html(Lapa()->settings()->get('portfolio_custom_name'));
            $label2 = esc_html(Lapa()->settings()->get('portfolio_custom_name2'));
            $slug = sanitize_title(Lapa()->settings()->get('portfolio_custom_slug'));
            if(!empty($label)){
                $args['label'] = $label;
                $args['labels']['name'] = $label;
            }
            if(!empty($label2)){
                $args['labels']['singular_name'] = $label2;
            }
            if(!empty($slug)){
                if(!empty($args['rewrite'])){
                    $args['rewrite']['slug'] = $slug;
                }
                else{
                    $args['rewrite'] = array( 'slug' => $slug );
                }
            }
        }

        return $args;
    }
    add_filter('register_post_type_args', 'lapa_override_portfolio_content_type_args', 99, 2);
}

if(!function_exists('lapa_override_portfolio_tax_type_args')){
    function lapa_override_portfolio_tax_type_args( $args, $tax_name ) {
        if( $tax_name == 'la_portfolio_category' ) {
            $label = esc_html(Lapa()->settings()->get('portfolio_cat_custom_name'));
            $label2 = esc_html(Lapa()->settings()->get('portfolio_cat_custom_name2'));
            $slug = sanitize_title(Lapa()->settings()->get('portfolio_cat_custom_slug'));
            if(!empty($label)){
                $args['labels']['name'] = $label;
            }
            if(!empty($label2)){
                $args['labels']['singular_name'] = $label2;
            }
            if(!empty($slug)){
                if(!empty($args['rewrite'])){
                    $args['rewrite']['slug'] = $slug;
                }
                else{
                    $args['rewrite'] = array( 'slug' => $slug );
                }
            }
        }
        else if( $tax_name == 'la_portfolio_skill' ) {
            $label = esc_html(Lapa()->settings()->get('portfolio_skill_custom_name'));
            $label2 = esc_html(Lapa()->settings()->get('portfolio_skill_custom_name2'));
            $slug = sanitize_title(Lapa()->settings()->get('portfolio_skill_custom_slug'));
            if(!empty($label)){
                $args['labels']['name'] = $label;
            }
            if(!empty($label2)){
                $args['labels']['singular_name'] = $label2;
            }
            if(!empty($slug)){
                if(!empty($args['rewrite'])){
                    $args['rewrite']['slug'] = $slug;
                }
                else{
                    $args['rewrite'] = array( 'slug' => $slug );
                }
            }
        }

        return $args;
    }
    add_filter('register_taxonomy_args', 'lapa_override_portfolio_tax_type_args', 99, 2);
}

add_action('woocommerce_product_meta_start', function(){
    add_filter('wc_product_sku_enabled', '__return_false', 100);
});
add_action('woocommerce_product_meta_end', function(){
    add_filter('wc_product_sku_enabled', '__return_true', 100);
});