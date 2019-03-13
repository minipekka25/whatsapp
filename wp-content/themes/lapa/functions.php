<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Require plugins vendor
 */

require_once get_template_directory() . '/plugins/tgm-plugin-activation/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/plugins/plugins.php';

/**
 * Include the main class.
 */

include_once get_template_directory() . '/framework/classes/class-core.php';


Lapa::$template_dir_path   = get_template_directory();
Lapa::$template_dir_url    = get_template_directory_uri();
Lapa::$stylesheet_dir_path = get_stylesheet_directory();
Lapa::$stylesheet_dir_url  = get_stylesheet_directory_uri();

/**
 * Include the autoloader.
 */
include_once Lapa::$template_dir_path . '/framework/classes/class-autoload.php';

new Lapa_Autoload();

/**
 * load functions for later usage
 */

require_once Lapa::$template_dir_path . '/framework/functions/functions.php';

new Lapa_Multilingual();

if(!function_exists('Lapa')){
    function Lapa(){
        return Lapa::get_instance();
    }
}

new Lapa_Scripts();

new Lapa_Admin();

new Lapa_WooCommerce();

new Lapa_WooCommerce_Wishlist();

new Lapa_WooCommerce_Compare();

new Lapa_Visual_Composer();

/**
 * Set the $content_width global.
 */
global $content_width;
if ( ! is_admin() ) {
    if ( ! isset( $content_width ) || empty( $content_width ) ) {
        $content_width = (int) Lapa()->layout()->get_content_width();
    }
}

require_once Lapa::$template_dir_path . '/framework/functions/extra-functions.php';

require_once Lapa::$template_dir_path . '/framework/functions/update.php';
