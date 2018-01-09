<?php
/**
 * Plugin Name:		Basetheme Helper Plugin
 * Plugin URI:		https://github.com/timstl/basetheme-helper-plugin
 * Description:		Base functionality to use across sites. Moves some functionality from Basetheme into plugin for use with other themes.
 * Version:			1.0.0
 * Author:			Tim Gieseking, timstl@gmail.com
 * Author URI:		http://timgweb.com/
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
define( 'BASETHEME_HELPER_VERSION', '1.0' );
define( 'BASETHEME_HELPER_DIR', plugin_dir_path(__FILE__));

/* Autoloaders.*/
include_once( 'lib/loader.php' );

/* Plugins Loaded */
function basetheme_helper_plugins_loaded() {
	new Classes\Cleanup();
	new Classes\ACF();
	
	if (is_admin()) { 
		new Classes\Plugins();
		new Classes\Admin();
	}
}
add_action('plugins_loaded', __NAMESPACE__ . '\\basetheme_helper_plugins_loaded');

/* This plugin activated */
function basetheme_helper_plugin_activated() {
	new Classes\Activated();
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\\basetheme_helper_plugin_activated' );