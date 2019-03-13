<?php if ( ! defined( 'ABSPATH' ) ) { die; }

add_filter('LaStudio/global_loop_variable', 'lapa_set_loop_variable');
if(!function_exists('lapa_set_loop_variable')){
    function lapa_set_loop_variable( $var = ''){
        return 'lapa_loop';
    }
}

add_filter('LaStudio/core/google_map_api', 'lapa_add_googlemap_api');
if(!function_exists('lapa_add_googlemap_api')){
    function lapa_add_googlemap_api( $key = '' ){
        return Lapa()->settings()->get('google_key', $key);
    }
}

add_filter('lapa/filter/page_title', 'lapa_override_page_title_bar_title', 10, 2);
if(!function_exists('lapa_override_page_title_bar_title')){
    function lapa_override_page_title_bar_title( $title, $args ){

        $context = (array) Lapa()->get_current_context();

        if(in_array('is_singular', $context)){
            $custom_title = Lapa()->settings()->get_post_meta( get_queried_object_id(), 'page_title_custom');
            if(!empty( $custom_title) ){
                return sprintf($args['page_title_format'], $custom_title);
            }
        }

        if(in_array('is_tax', $context) || in_array('is_category', $context) || in_array('is_tag', $context)){
            $custom_title = Lapa()->settings()->get_term_meta( get_queried_object_id(), 'page_title_custom');
            if(!empty( $custom_title) ){
                return sprintf($args['page_title_format'], $custom_title);
            }
        }

        if(in_array('is_shop', $context) && function_exists('wc_get_page_id') && ($shop_page_id = wc_get_page_id('shop')) && $shop_page_id){
            $custom_title = Lapa()->settings()->get_post_meta( $shop_page_id, 'page_title_custom');
            if(!empty( $custom_title) ){
                return sprintf($args['page_title_format'], $custom_title);
            }
        }

        return $title;
    }
}

add_action( 'pre_get_posts', 'lapa_set_posts_per_page_for_portfolio_cpt' );
if(!function_exists('lapa_set_posts_per_page_for_portfolio_cpt')){
    function lapa_set_posts_per_page_for_portfolio_cpt( $query ) {
        if ( !is_admin() && $query->is_main_query() ) {
            if( is_post_type_archive( 'la_portfolio' ) || is_tax(get_object_taxonomies( 'la_portfolio' ))){
                $pf_per_page = (int) Lapa()->settings()->get('portfolio_per_page', 9);
                $query->set( 'posts_per_page', $pf_per_page );
            }
        }
    }
}

add_filter('yith_wc_social_login_icon', 'lapa_override_yith_wc_social_login_icon', 10, 3);
if(!function_exists('lapa_override_yith_wc_social_login_icon')){
    function lapa_override_yith_wc_social_login_icon($social, $key, $args){
        if(!is_admin()){
            $social = sprintf(
                '<a class="%s" href="%s">%s</a>',
                'social_login ywsl-' . esc_attr($key) . ' social_login-' . esc_attr($key),
                $args['url'],
                isset( $args['value']['label'] ) ? $args['value']['label'] : $args['value']
            );
        }
        return $social;
    }
}

add_action('wp', 'lapa_hook_maintenance');
if(!function_exists('lapa_hook_maintenance')){
    function lapa_hook_maintenance(){
        wp_reset_postdata();
        $enable_private = Lapa()->settings()->get('enable_maintenance', 'no');
        if($enable_private == 'yes'){
            if(!is_user_logged_in()){
                $page_id = Lapa()->settings()->get('maintenance_page');
                if(empty($page_id)){
                    wp_redirect(wp_login_url());
                    exit;
                }
                else{
                    $page_id = absint($page_id);
                    if(!is_page($page_id)){
                        wp_redirect(get_permalink($page_id));
                        exit;
                    }
                }
            }
        }
    }
}

add_filter('widget_archives_args', 'lapa_modify_widget_archives_args');
if(!function_exists('lapa_modify_widget_archives_args')){
    function lapa_modify_widget_archives_args( $args ){
        if(isset($args['show_post_count'])){
            unset($args['show_post_count']);
        }
        return $args;
    }
}
if(isset($_GET['la_doing_ajax'])){
    remove_action('template_redirect', 'redirect_canonical');
}
add_filter('woocommerce_redirect_single_search_result', '__return_false');


add_filter('lapa/filter/breadcrumbs/items', 'lapa_theme_setup_breadcrumbs_for_dokan', 10, 2);
if(!function_exists('lapa_theme_setup_breadcrumbs_for_dokan')){
    function lapa_theme_setup_breadcrumbs_for_dokan( $items, $args ){
        if (  function_exists('dokan_is_store_page') && dokan_is_store_page() ) {

            $custom_store_url = dokan_get_option( 'custom_store_url', 'dokan_general', 'store' );

            $author      = get_query_var( $custom_store_url );
            $seller_info = get_user_by( 'slug', $author );

            $items[] = sprintf(
                '<div class="la-breadcrumb-item"><a href="%4$s" class="%2$s" rel="tag" title="%3$s">%1$s</a></div>',
                esc_attr(ucwords($custom_store_url)),
                'la-breadcrumb-item-link',
                esc_attr(ucwords($custom_store_url)),
                esc_url(site_url() .'/'.$custom_store_url)
            );
            $items[] = sprintf(
                '<div class="la-breadcrumb-item"><span class="%2$s">%1$s</span></div>',
                esc_attr($seller_info->data->display_name),
                'la-breadcrumb-item-link'
            );
        }

        return $items;
    }
}


add_filter('lapa/filter/show_page_title', 'lapa_filter_show_page_title', 10, 1 );
add_filter('lapa/filter/show_breadcrumbs', 'lapa_filter_show_breadcrumbs', 10, 1 );

if(!function_exists('lapa_filter_show_page_title')){
    function lapa_filter_show_page_title( $show ){
        $context = Lapa()->get_current_context();
        if( in_array( 'is_product', $context ) && Lapa()->settings()->get('product_single_hide_page_title', 'no') == 'yes' ){
            return false;
        }
        return $show;
    }
}

if(!function_exists('lapa_filter_show_breadcrumbs')){
    function lapa_filter_show_breadcrumbs( $show ){
        $context = Lapa()->get_current_context();
        if( in_array( 'is_product', $context ) && Lapa()->settings()->get('product_single_hide_breadcrumb', 'no') == 'yes'){
            return false;
        }
        return $show;
    }
}


add_filter('LaStudio/swatches/args/show_option_none', 'lapa_allow_translate_woo_text_in_swatches', 10, 1);
if(!function_exists('lapa_allow_translate_woo_text_in_swatches')){
    function lapa_allow_translate_woo_text_in_swatches( $text ){
        return esc_html_x( 'Choose an option', 'front-view', 'lapa' );
    }
}

add_filter('LaStudio/swatches/get_attribute_thumbnail_src', 'lapa_allow_resize_image_url_in_swatches', 10, 4);

if(!function_exists('lapa_allow_resize_image_url_in_swatches')){
    function lapa_allow_resize_image_url_in_swatches( $image_url, $image_id, $size_name, $instance ) {
        if($size_name == 'la_swatches_image_size'){
            $width = $instance->get_width();
            $height = $instance->get_height();
            $image_url = Lapa()->images()->get_attachment_image_url($image_id, array( $width, $height ));
            return $image_url;
        }
        return $image_url;
    }
}

add_filter('LaStudio/swatches/get_product_variation_image_url_by_attribute', 'lapa_allow_resize_variation_image_url_by_attribute_in_swatches', 10, 2);
if(!function_exists('lapa_allow_resize_variation_image_url_by_attribute_in_swatches')){
    function lapa_allow_resize_variation_image_url_by_attribute_in_swatches( $image_url, $image_id ) {
        global $precise_loop;
        if(isset($precise_loop['image_size'])){
            return Lapa()->images()->get_attachment_image_url($image_id, $precise_loop['image_size'] );
        }
        return $image_url;
    }
}

if(!function_exists('lapa_get_relative_url')){
    function lapa_get_relative_url( $url ) {
        return lapa_is_external_resource( $url ) ? $url : str_replace( array( 'http://', 'https://' ), '//', $url );
    }
}
if(!function_exists('lapa_is_external_resource')){
    function lapa_is_external_resource( $url ) {
        $wp_base = str_replace( array( 'http://', 'https://' ), '//', get_home_url( null, '/', 'http' ) );
        return strstr( $url, '://' ) && strstr( $wp_base, $url );
    }
}

if (!function_exists('lapa_wpml_object_id')) {
    function lapa_wpml_object_id( $element_id, $element_type = 'post', $return_original_if_missing = false, $ulanguage_code = null ) {
        if ( function_exists( 'wpml_object_id_filter' ) ) {
            return wpml_object_id_filter( $element_id, $element_type, $return_original_if_missing, $ulanguage_code );
        } elseif ( function_exists( 'icl_object_id' ) ) {
            return icl_object_id( $element_id, $element_type, $return_original_if_missing, $ulanguage_code );
        } else {
            return $element_id;
        }
    }

}