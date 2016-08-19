<?php
/*
 * Plugin Name: Apptopia
 * Description: This plugin integrates with the Apptopia API and displays a searchable database on the page. Use the shortcode [apptopia client_id="" client_secret=""]
 * Version: 1.0
 * Author: Brandon Shelley / Jeremy Anticouni
 * Author URI: TBD
 * License: TBD
 * License URI: TBD
 * Text Domain: apptopia-wp-plugin
 * Domain Path: /translation
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// load plugin text domain
function vscf_init() { 
	load_plugin_textdomain( 'apptopia', false, plugin_dir_url(__FILE__) . '/translation' );
}
add_action('plugins_loaded', 'vscf_init');

// enqueues plugin scripts and stylesheets
function apptopia_css_js() {	
	wp_enqueue_style('apptopia_vendor', plugin_dir_url(__FILE__) . '/css/vendor.css');
	wp_enqueue_script('apptopia_vendor', plugin_dir_url(__FILE__) . '/js/vendor.js');
	wp_enqueue_style('apptopia_app', plugin_dir_url(__FILE__) . '/css/app.css');
	wp_enqueue_script('apptopia_app', plugin_dir_url(__FILE__) . '/js/app.js');
}
add_action('wp_enqueue_scripts', 'apptopia_css_js');

// includes
include 'apptopia-auth.php';
include 'apptopia-content.php';

?>