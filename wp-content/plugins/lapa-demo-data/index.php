<?php
/*
Plugin Name:    Lapa Package Demo Data
Plugin URI:     http://la-studioweb.com/
Description:    This plugin use only for LA-Studio Theme
Author:         LA Studio
Author URI:     http://la-studioweb.com/
Version:        1.0.1
Text Domain:    lastudio-demodata
*/

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if(!function_exists('la_import_check_post_exists')){
    function la_import_check_post_exists( $title, $content = '', $date = '', $type = '' ){
        global $wpdb;

        $post_title = wp_unslash( sanitize_post_field( 'post_title', $title, 0, 'db' ) );
        $post_content = wp_unslash( sanitize_post_field( 'post_content', $content, 0, 'db' ) );
        $post_date = wp_unslash( sanitize_post_field( 'post_date', $date, 0, 'db' ) );
        $post_type = wp_unslash( sanitize_post_field( 'post_type', $type, 0, 'db' ) );

        $query = "SELECT ID FROM $wpdb->posts WHERE 1=1";
        $args = array();

        if ( !empty ( $date ) ) {
            $query .= ' AND post_date = %s';
            $args[] = $post_date;
        }

        if ( !empty ( $title ) ) {
            $query .= ' AND post_title = %s';
            $args[] = $post_title;
        }

        if ( !empty ( $content ) ) {
            $query .= ' AND post_content = %s';
            $args[] = $post_content;
        }

        if ( !empty ( $type ) ) {
            $query .= ' AND post_type = %s';
            $args[] = $post_type;
        }

        if ( !empty ( $args ) )
            return (int) $wpdb->get_var( $wpdb->prepare($query, $args) );

        return 0;
    }
}


class Lapa_Data_Demo_Plugin_Class{

    public static $plugin_dir_path = null;

    public static $plugin_dir_url = null;

    public static $instance = null;

    private $preset_allows = array();

    public static $theme_name = 'lapa';

    public static $demo_site = 'http://lapa.la-studioweb.com/';

    protected $demo_data = array();

    public static function get_instance() {
        if ( null === static::$instance ) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function __construct( ) {

        self::$plugin_dir_path = plugin_dir_path(__FILE__);

        self::$plugin_dir_url = plugin_dir_url(__FILE__);

        include_once self::$plugin_dir_path . 'demodata.php';

        $this->_setup_demo_data();

        if( self::isLocal() ){
            $this->_load_other_hook();
        }

        $this->load_importer();

        add_filter(self::$theme_name . '/filter/demo_data', array( $this, 'get_data_for_import_demo') );

        add_action( 'wp', array( $this, 'init_override'), 99 );

        add_action( 'init', array( $this, 'register_menu_import_demo'), 99 );

        add_action('LaStudio_Importer/copy_image', array( $this, 'copy_demo_image') );

    }

    private function load_importer(){
        require_once self::$plugin_dir_path . 'importer.php';
        if(class_exists('LaStudio_Importer')){
            new LaStudio_Importer(self::$theme_name, $this->get_data_for_import_demo(), self::$demo_site );
        }
    }

    public function init_override(){
        if(!is_admin()){
            $this->_override_settings();
        }
    }

    public function copy_demo_image(){
        if(file_exists(self::$plugin_dir_path . 'data/images.zip')){
            $status = get_option(self::$theme_name . '_was_copy_image');
            if(!$status){
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $destination = wp_upload_dir();
                $destination_path = $destination['basedir'];
                ob_start();
                $unzipfile = unzip_file( self::$plugin_dir_path . 'data/images.zip', $destination_path);
                ob_end_clean();
                if($unzipfile){
                    update_option( self::$theme_name . '_was_copy_image' , true );
                }
            }
        }
    }

    public function register_menu_import_demo(){
        if(class_exists('LaStudio')){
            require_once self::$plugin_dir_path . 'panel.php';
        }
    }

    public function get_data_for_import_demo(){
        $demo = (array) $this->filter_demo_item_by_category('demo');
        return $demo;
    }

    private function _setup_demo_data(){

        $this->preset_allows = array(
            'home-01',
            'home-02',
            'home-03',
            'home-04',
            'home-05',
            'home-06',
            'home-07',
            'home-08',
            'home-09',
            'home-10',
            'blog-01',
            'blog-02',
            'blog-03',
            'blog-04',
            'blog-05',
            'shop-fullwidth',
            'shop-sidebar',
            'shop-03-columns',
            'shop-04-columns',
            'shop-masonry',
            'product-01',
            'product-02',
            'product-03',
        );

        $func_name = 'la_'. self::$theme_name .'_get_demo_array';

        $this->demo_data = call_user_func( $func_name, self::$plugin_dir_url . 'previews/', self::$plugin_dir_path . 'data/');

    }

    private function _get_preset_from_file( $preset = ''){

        if(!empty($preset)){
            $file = self::$plugin_dir_path . 'presets/' . $preset . '.php';
            if(file_exists($file)){
                include_once $file;
                return call_user_func( 'la_'. self::$theme_name .'_preset_' . str_replace('-', '_', $preset) );
            }
            return false;
        }
        return false;
    }

    private function _load_data_from_preset( $preset ){
        $settings = $this->_get_preset_from_file( $preset );
        if(!empty($settings)){
            foreach ( $settings as $setting ) {
                if(isset($setting['filter_name'])){

                    if(!empty($setting['filter_func'])){
                        $filter_priority = isset($setting['filter_priority']) ? $setting['filter_priority'] : 10;
                        $filter_args = isset($setting['filter_args']) ? $setting['filter_args'] : 1;
//                        la_log(array(
//                            'filter_name' => $setting['filter_name'],
//                            'filter_func' => $setting['filter_func'],
//                            'filter_priority' => $filter_priority,
//                            'filter_args' => $filter_args,
//                        ));
                        add_filter($setting['filter_name'], $setting['filter_func'], $filter_priority, $filter_args );
                    }
                    else{
                        $new_filter_value = $setting['value'];
                        add_filter("{$setting['filter_name']}", function() use ( $new_filter_value ){
                            return $new_filter_value;
                        },20);
                    }

                }else{
                    $new_value = $setting['value'];
                    $keys = explode('|', $setting['key']);
                    foreach( $keys as $key ){
                        add_filter(self::$theme_name . "/setting/option/get_single", function( $old_val, $old_key ) use ( $new_value, $key ){
                            if( $old_key == $key ){
                                return $new_value;
                            }
                            return $old_val;
                        }, 11, 2);
                    }
                }
            }
        }
    }
    
    private function _override_settings(){
        if(!empty($_GET['la_preset']) && in_array( $_GET['la_preset'], $this->preset_allows )){
            $this->_load_data_from_preset($_GET['la_preset']);
        }
        if(self::isLocal() && is_page()){
            $lists_preset = $this->get_demo_with_preset();
            if(!empty($lists_preset)){
                $current_page_name = get_queried_object()->post_name;
                if( array_key_exists( $current_page_name, $lists_preset ) ) {
                    $this->_load_data_from_preset($lists_preset[$current_page_name]);
                }
            }
        }
        if(self::isLocal()){
//            $post_presets = array(
//                1118 => 'header-white',
//                1139 => 'header-white',
//            );
//            foreach($post_presets as $k => $preset){
//                if(is_single($k)){
//                    $this->_load_data_from_preset($preset);
//                }
//            }
        }
    }

    private function get_demo_with_preset(){
        $lists = array();
        $demo_data = (array) $this->demo_data;
        if(!empty($demo_data)){
            foreach($demo_data as $key => $demo){
                if(!empty($demo['demo_preset'])){
                    $lists[$key] = $demo['demo_preset'];
                }
            }
        }
        $lists['about-us-01'] = 'about-us-01';
        $lists['about-us-02'] = 'about-us-01';
        $lists['our-services'] = 'about-us-01';
        $lists['coming-soon'] = 'about-us-01';
//        $lists['our-services'] = 'our-services';
        return $lists;
    }

    public static function isLocal(){
        $is_local = false;
        if (isset($_SERVER['X_FORWARDED_HOST']) && !empty($_SERVER['X_FORWARDED_HOST'])) {
            $hostname = $_SERVER['X_FORWARDED_HOST'];
        } else {
            $hostname = $_SERVER['HTTP_HOST'];
        }
        if (strpos($hostname, '.la-studioweb.com') !== false ) {
            $is_local = true;
        }
        return $is_local;
    }

    public function filter_demo_item_by_category( $category ){
        $demo_data = (array) $this->demo_data;
        $return = array();
        if(!empty($demo_data) && !empty($category)){
            foreach( $demo_data as $key => $demo ){
                if(!empty($demo['category']) && $demo['category'] == $category){
                    $return[$key] = $demo;
                }
            }
        }
        return $return;
    }

    private function _load_other_hook(){
        include_once self::$plugin_dir_path . 'other-hook.php';
    }
}


add_action('plugins_loaded', array('Lapa_Data_Demo_Plugin_Class','get_instance') );