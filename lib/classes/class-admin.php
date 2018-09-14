<?php
/**
 * Admin functions, other than ACF.
 *
 * @package WordPress
 * @subpackage Basetheme Helper Plugin
 * @since 1.0
 * @version 1.2
 */

namespace BTH\Lib\Classes;

/**
 * Admin class
 */
class Admin {

	/**
	 * __construct()
	 */
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	/**
	 * Add notices to the admin.
	 */
	public function admin_notices() {
		if ( current_user_can( 'manage_options' ) &&
			( '0' === get_option( 'blog_public' ) || 0 === get_option( 'blog_public' ) )
			) {
			echo '<div class="error"><p>Search engines are currently blocked.</p></div>';
		}
	}
}
