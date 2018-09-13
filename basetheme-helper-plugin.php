<?php
/**
 * Plugin Name:     Basetheme Helper Plugin
 * Plugin URI:      https://github.com/timstl/basetheme-helper-plugin
 * Description:     Base functionality to use across sites. Requires ACF. Moves some functionality from Basetheme into plugin for use with other themes.
 * Version:         1.2
 * Author:          Tim Gieseking, timstl@gmail.com
 * Author URI:      http://timgweb.com/
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     basetheme
 *
 * @package WordPress
 * @subpackage Basetheme Helper Plugin
 * @since 1.0
 * @version 1.2
 */

namespace BTH;

use BTH\Lib\Classes;

/* Abort! */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/* Constants */
define( 'BASETHEME_HELPER_VERSION', '1.2' );
define( 'BASETHEME_HELPER_DIR', plugin_dir_path( __FILE__ ) );

/* Autoloaders.*/
require_once 'lib/loader.php';

/**
 * Plugins loaded.
 */
function basetheme_helper_plugins_loaded() {
	new Classes\Cleanup();
	new Classes\ACF();

	if ( is_admin() ) {
		new Classes\Plugins();
		new Classes\Admin();
	}
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\\basetheme_helper_plugins_loaded' );

/**
 * Init.
 */
function basetheme_helper_init() {
	$busted = new Classes\Busted();
	$busted->init();
}
add_action( 'init', __NAMESPACE__ . '\\basetheme_helper_init' );
add_action( 'admin_init', __NAMESPACE__ . '\\basetheme_helper_init' );

/**
 * This plugin activated.
 */
function basetheme_helper_plugin_activated() {
	new Classes\Activated();
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\\basetheme_helper_plugin_activated' );
