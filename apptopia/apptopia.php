<?php
/*
 * Plugin Name: Apptopia
 * Description: This plugin integrates with the Apptopia API and displays a searchable database on the page. Use the shortcode [apptopia client_id="" client_secret=""]
 * Version: 1.0
 * Author: Brandon Shelley / Jeremy Anticouni
 * Author URI: mailto:jeremy@anticouni.net
 * License: TBD
 * License URI: TBD
 * Text Domain: apptopia
 */

/* Debug only */
/** ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL); */

// adds logger
function wplog($message) {
	// Uncomment next line for visual debugging
	// echo $message;
    if ( WP_DEBUG === true ) {
        if ( is_array($message) || is_object($message) ) {
            error_log( print_r($message, true) );
        } else {
            error_log( $message );
        }
    }
}

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