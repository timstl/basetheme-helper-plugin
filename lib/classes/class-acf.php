<?php
/**
 * Creates General "Site Settings" ACF Options page
 * Creates ACF fields for site-wide head and footer code, as well as page-by-page head and footer code.
 * Hooks in to wp_head and wp_footer to output code.
 *
 * @package WordPress
 * @subpackage Basetheme Helper Plugin
 * @since 1.0
 * @version 1.2
 */

namespace BTH\Lib\Classes;

/**
 * ACF Class
 */
class ACF {

	/**
	 * __construct()
	 */
	public function __construct() {
		if ( is_admin() ) {
			$this->create_acf_pages();
		} else {
			add_action( 'wp_head', array( $this, 'custom_output_prewphead' ), apply_filters( 'bth_custom_output_prewphead_priority', 0 ) );
			add_action( 'wp_head', array( $this, 'custom_output_wphead' ), apply_filters( 'bth_custom_output_head_priority', 9999 ) );
			add_action( 'wp_footer', array( $this, 'custom_output_wpfooter' ), apply_filters( 'bth_custom_output_footer_priority', 9999 ) );
		}
	}

	/**
	 * Output at start of wp_head();
	 */
	public function custom_output_prewphead() {
		$this->custom_output( 'pre-wp_head' );
	}

	/**
	 * Output at end of wp_head();
	 */
	public function custom_output_wphead() {
		$this->custom_output( 'header' );
	}

	/**
	 * Output at end of wp_footer();
	 */
	public function custom_output_wpfooter() {
		$this->custom_output( 'footer' );
	}

	/**
	 * Pull ACF fields and output.
	 *
	 * @param string $location Field to display.
	 */
	private function custom_output( $location = 'header' ) {
		if ( ! function_exists( 'the_field' ) ) {
			return;
		}

		the_field( 'custom_' . $location . '_scripts', 'options' );
		the_field( 'custom_' . $location . '_scripts' );
	}

	/**
	 * Create ACF options in the admin.
	 */
	public function create_acf_pages() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				array(
					'page_title' => 'Site Settings',
					'menu_title' => 'Site Settings',
					'menu_slug'  => 'site-general-settings',
					'capability' => 'manage_options',
					'redirect'   => false,
				)
			);
		}
	}
}
