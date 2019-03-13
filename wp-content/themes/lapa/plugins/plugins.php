<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'tgmpa_register', 'lapa_register_required_plugins' );

if(!function_exists('lapa_register_required_plugins')){

	function lapa_register_required_plugins() {

		$plugins = array();

		$plugins[] = array(
			'name'					=> esc_html_x('WPBakery Visual Composer', 'admin-view', 'lapa'),
			'slug'					=> 'js_composer',
			'source'				=> get_template_directory() . '/plugins/js_composer.zip',
			'required'				=> true,
			'version'				=> '5.5.2'
		);

		$plugins[] = array(
			'name'					=> esc_html_x('LA-Studio Core', 'admin-view', 'lapa'),
			'slug'					=> 'lastudio',
			'source'				=> get_template_directory() . '/plugins/lastudio.zip',
			'required'				=> true,
			'version'				=> '1.0.2'
		);

		$plugins[] = array(
			'name'					=> esc_html_x('Lapa Package Demo Data', 'admin-view', 'lapa'),
			'slug'					=> 'lapa-demo-data',
			'source'				=> get_template_directory() . '/plugins/lapa-demo-data.zip',
			'required'				=> true,
			'version'				=> '1.0.1'
		);

		$plugins[] = array(
			'name'     				=> esc_html_x('WooCommerce', 'admin-view', 'lapa'),
			'slug'     				=> 'woocommerce',
			'version'				=> '3.4.5',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'					=> esc_html_x('Slider Revolution', 'admin-view', 'lapa'),
			'slug'					=> 'revslider',
			'source'				=> get_template_directory() . '/plugins/revslider.zip',
			'required'				=> false,
			'version'				=> '5.4.8'
		);

		$plugins[] = array(
			'name' 					=> esc_html_x('Contact Form 7', 'admin-view', 'lapa'),
			'slug' 					=> 'contact-form-7',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'     				=> esc_html_x('Envato Market', 'admin-view', 'la-zyra'),
			'slug'     				=> 'envato-market',
			'source'   				=> 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required' 				=> false,
			'version' 				=> '2.0.0'
		);

		$plugins[] = array(
			'name' 					=> esc_html_x('Easy Forms for MailChimp by YIKES', 'admin-view', 'lapa'),
			'slug' 					=> 'yikes-inc-easy-mailchimp-extender',
			'required' 				=> false
		);

		$config = array(
			'id'           				=> 'lapa',
			'default_path' 				=> '',
			'menu'         				=> 'tgmpa-install-plugins',
			'has_notices'  				=> true,
			'dismissable'  				=> true,
			'dismiss_msg'  				=> '',
			'is_automatic' 				=> false,
			'message'      				=> ''
		);

		tgmpa( $plugins, $config );

	}

}
