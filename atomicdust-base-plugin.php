<?php
/**
 * Plugin Name:		Atomicdust Base Plugin
 * Plugin URI:		http://atomicdust.com/
 * Description:		Base functionality to use across sites.
 * Version:			1.0.0
 * Author:			Atomicdust, Tim Gieseking
 * Author URI:		http://atomicdust.com.com/
 * License:			GPL-2.0+
 * License URI:		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:		concordia-events-import
 */

namespace ATMDST;
use ATMDST\Lib\Classes;

/* Abort! */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/* Constants */
define( 'ATMDST_BASE_PLUGIN', '1.0' );
define( 'ATMDST_PLUGIN_DIR', plugin_dir_path(__FILE__));

/* Autoloaders.*/
include_once( 'lib/loader.php' );

/* Plugins Loaded */
function _atmdst_basetheme_plugins_loaded() {
	new Classes\Cleanup();
	new Classes\ACF();
	
	if (is_admin()) { 
		new Classes\Plugins();
		new Classes\Admin();
	}
}
add_action('plugins_loaded', __NAMESPACE__ . '\\_atmdst_basetheme_plugins_loaded');

/* This plugin activated */
function _atmdst_basetheme_plugin_activated() {
	new Classes\Activated();
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\\_atmdst_basetheme_plugin_activated' );

/* 
	Logging function.
	In wp-config.php define the WP_DEBUG_LOG constant: define('WP_DEBUG_LOG', true);
	
	You can then use this function anywhere in your themes or plugin:
	
	atomic_log("log message here");
	
	This will write to wp-content/debug.log.
	In terminal: tail -f debug.log 
*/
if (!function_exists('atomic_log')) {
	function atomic_log ( $log )  {
		if ( true === WP_DEBUG ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				error_log( print_r( $log, true ) );
			} else {
				error_log( $log );
			}
		}
	}
}

