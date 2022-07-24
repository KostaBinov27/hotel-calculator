<?php
/**
* Plugin Name: Hotel Calculator
* Description: Calculator for Hotel Pricing.
* Version: 1.0
* Author: Kosta Binov
**/
function register_top_level_menu_calc(){
	add_menu_page(
		'Hotel Calculator',
		'Hotel Calculator',
		'manage_options',
		'hotel-calculator-settings',
		'display_top_level_menu_page_calc',
		'',
		6
	);
}
add_action( 'admin_menu', 'register_top_level_menu_calc' );

function display_top_level_menu_page_calc(){
	include( plugin_dir_path( __FILE__ ) . 'dashboard-settings.php');
}

/**
 * Activate the plugin.
 */
function hotel_calc_activate() {
	$pricePerDay = get_option( 'pricePerDay' );
	$maxNumberOfDays = get_option( 'maxNumberOfDays' );
	$maxNumberOfPeople = get_option( 'maxNumberOfPeople' );
	if ($pricePerDay == ''){
		add_option( 'pricePerDay' , '10000' );
	}
	if ($maxNumberOfDays == ''){
		add_option( 'maxNumberOfDays' , '14' );
	}
	if ($maxNumberOfPeople == ''){
		add_option( 'maxNumberOfPeople' , '5' );
	}

	add_option('my_plugin_do_activation_redirect', true);

}
register_activation_hook( __FILE__, 'hotel_calc_activate' );
add_action('admin_init', 'my_plugin_redirect');

function my_plugin_redirect() {
    if (get_option('my_plugin_do_activation_redirect', false)) {
        delete_option('my_plugin_do_activation_redirect');
		wp_redirect( get_home_url().'/wp-admin/admin.php?page=hotel-calculator-settings', 301 ); exit;
    }
}

function calculatorview(){
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'calculator-view.php');
	return ob_get_clean();
}
add_shortcode('calculatorhotel', 'calculatorview'); 

function calculator_scripts(){
	wp_register_script('custom_js', plugins_url('/assets/js/script.js',__FILE__ ), array('jquery'), '', true);
	wp_enqueue_script('custom_js');

	wp_register_style( 'style', plugins_url( '/hotel-calculator/assets/css/style.css') );
	wp_enqueue_style( 'style' );
}
add_action('wp_enqueue_scripts', 'calculator_scripts');
