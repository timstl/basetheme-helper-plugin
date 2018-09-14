<?php
/**
 * Do some cleanup when WordPress loads.
 *
 * @package WordPress
 * @subpackage Basetheme Helper Plugin
 * @since 1.0
 * @version 1.2
 */

namespace BTH\Lib\Classes;

/**
 * Cleanup Class.
 */
class Cleanup {

	/**
	 * __construct()
	 */
	public function __construct() {
		remove_action( 'wp_head', 'rsd_link' ); // Remove really simple discovery link.
		remove_action( 'wp_head', 'wp_generator' ); // Remove WordPress version.

		remove_action( 'wp_head', 'feed_links', 2 ); // Remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service).
		remove_action( 'wp_head', 'feed_links_extra', 3 ); // Removes all extra rss feed links.

		remove_action( 'wp_head', 'index_rel_link' ); // Remove link to index page.
		remove_action( 'wp_head', 'wlwmanifest_link' ); // Remove wlwmanifest.xml (needed to support windows live writer).

		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Remove random post link.
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Remove parent post link.
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // rRemove the next and previous post links.
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // Remove shortlink from wp_head.

		add_filter( 'the_generator', array( $this, 'version_removal' ) ); // Remove the version.
	}

	/**
	 * Return empty string to remove version.
	 */
	public function version_removal() {
		return '';
	}
}
