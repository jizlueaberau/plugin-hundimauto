<?php
/**
 * Plugin name: Elementor Custom Plugin
 * Description: Custom Elementor Plugin to extend and add custom elements to website hundimauto.ch
 * Plugin URI: 	https://kuckmal-gmbh.ch
 * Version: 	1.0.0
 * Author: 		Michael Kuck
 * Author URL: 	https://kuckmal-gmbh.ch
 * Text Domain: plugin-hundimauto
 * 
 * Elementor tested up to: 3.24.3
 * Elementor Pro tested up to: 3.24.3
 */

if ( ! defined('ABSPATH') ) {
	exit; // Exit if accessed directly
}

function plugin_hundimauto() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\Plugin_Hundimauto\Plugin::instance();

}
add_action( 'plugins_loaded', 'plugin_hundimauto' );