<?php
/**
 * Append 'modified' version number to enqueued scripts and styles to help bust cache.
 * Based on plugin by Paul Clark (http://github.com/pdclark/busted) with minor changes.
 */

namespace ATMDST\Lib\Classes;

class Busted {

	/**
	 * @var string Name for query arguements and version identifier.
	 */
	static protected $version_slug = 'b-modified';

	/**
	 * @var string Version string with current time to break caches.
	 */
	static protected $version_string;

	/**
	 * Setup hooks and vars.
	 *
	 * @return void
	 */
	static public function init(){

		/**
		 * PHP_INT_MAX - 1 used as hook priority because many developers
		 * use wp_enqueue_scripts for enqueues.
		 *
		 * Extremely high priority assures we catch everything.
		 */
		add_action( 'wp_enqueue_scripts', __CLASS__ . '::wp_enqueue_scripts', PHP_INT_MAX - 1 );

		add_filter( 'stylesheet_uri', __CLASS__ . '::stylesheet_uri' );
		add_filter( 'locale_stylesheet_uri', __CLASS__ . '::stylesheet_uri' );

	}

	/**
	 * Update version in scripts and styles that use wp_enqueue_* functions.
	 *
	 * @return void
	 */
	static public function wp_enqueue_scripts() {

		global $wp_scripts, $wp_styles;

		foreach( array( $wp_scripts, $wp_styles ) as $enqueue_list ) {

			if ( ! isset( $enqueue_list->__busted_filtered ) && is_object( $enqueue_list ) ) {

				foreach( (array) @ $enqueue_list->registered as $handle => $script ) {

					$modification_time = self::modification_time( $script->src );

					if ( $modification_time ) {

						$version = $script->ver . '-' . self::$version_slug . '-' . $modification_time;

						$enqueue_list->registered[ $handle ]->ver = $version;

					}

				}

				/**
				 * wp_enqueue_scripts runs in header in footer and when called.
				 * Only run this modification once.
				 */
				$enqueue_list->__busted_filtered = true;

			}

		}

	}

	/**
	 * Filter styles and scripts that use stylesheet_uri()
	 *
	 * @param  string  $uri  URI
	 * @return string  URI
	 */
	static public function stylesheet_uri( $uri ) {

		if ( in_array( pathinfo( $uri, PATHINFO_EXTENSION ), array( 'css', 'js' ) ) ) {

			$uri = add_query_arg( self::$version_slug, self::modification_time( $uri ), $uri );

		}

		return $uri;

	}

	/**
	 * @param  string $src Script relative path or URI
	 * @return int|bool File modification time or false.
	 */
	static public function modification_time( $src ) {

		if ( false !== strpos( $src, content_url() ) ) {
			$src = WP_CONTENT_DIR . str_replace( content_url(), '', $src );
		}

		$file = realpath( $src );

		if ( file_exists( $file ) ) {
			return filemtime( $file );
		}

		return false;

	}

}