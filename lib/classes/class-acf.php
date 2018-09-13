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
			$this->create_acf_fields();
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

	/**
	 * Create ACF fields.
	 */
	public function create_acf_fields() {
		if ( function_exists( 'acf_add_local_field_group' ) ) :
			acf_add_local_field_group(
				array(
					'key'                   => 'group_58c94f4463370',
					'title'                 => 'Custom Scripts',
					'fields'                => array(
						array(
							'key'               => 'field_58c94f4a25008',
							'label'             => 'Custom Header Scripts and CSS',
							'name'              => 'custom_header_scripts',
							'type'              => 'textarea',
							'instructions'      => 'Outputs after wp_head(). Include &lt;script&gt; and &lt;style&gt; tags.',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'placeholder'       => '',
							'maxlength'         => '',
							'rows'              => '',
							'new_lines'         => '',
						),
						array(
							'key'               => 'field_58c94fbf25009',
							'label'             => 'Custom Footer Scripts and CSS',
							'name'              => 'custom_footer_scripts',
							'type'              => 'textarea',
							'instructions'      => 'Outputs after wp_footer(). Include &lt;script&gt; and &lt;style&gt; tags.',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'placeholder'       => '',
							'maxlength'         => '',
							'rows'              => '',
							'new_lines'         => '',
						),
					),
					'location'              => array(
						array(
							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'post',
							),
						),
						array(
							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'page',
							),
						),
						array(
							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'directory',
							),
						),
						array(
							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'tribe_events',
							),
						),
						array(
							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'product',
							),
						),
					),
					'menu_order'            => 99,
					'position'              => 'normal',
					'style'                 => 'default',
					'label_placement'       => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen'        => '',
					'active'                => 1,
					'description'           => '',
				)
			);

			acf_add_local_field_group(
				array(
					'key'                   => 'group_58c950368b253',
					'title'                 => 'Custom Scripts (Site-wide)',
					'fields'                => array(
						array(
							'key'               => 'field_58c950368f6c7_prewphead',
							'label'             => 'Custom Header Scripts and CSS - Before wp_head()',
							'name'              => 'custom_pre-wp_head_scripts',
							'type'              => 'textarea',
							'instructions'      => 'Outputs before wp_head(). Include &lt;script&gt; and &lt;style&gt; tags. Place font services here.',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'placeholder'       => '',
							'maxlength'         => '',
							'rows'              => '',
							'new_lines'         => '',
						),
						array(
							'key'               => 'field_58c950368f6c7',
							'label'             => 'Custom Header Scripts and CSS',
							'name'              => 'custom_header_scripts',
							'type'              => 'textarea',
							'instructions'      => 'Outputs after wp_head(). Include &lt;script&gt; and &lt;style&gt; tags.',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'placeholder'       => '',
							'maxlength'         => '',
							'rows'              => '',
							'new_lines'         => '',
						),
						array(
							'key'               => 'field_58c950368f7cc',
							'label'             => 'Custom Footer Scripts and CSS',
							'name'              => 'custom_footer_scripts',
							'type'              => 'textarea',
							'instructions'      => 'Outputs after wp_footer(). Include &lt;script&gt; and &lt;style&gt; tags.',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'placeholder'       => '',
							'maxlength'         => '',
							'rows'              => '',
							'new_lines'         => '',
						),
					),
					'location'              => array(
						array(
							array(
								'param'    => 'options_page',
								'operator' => '==',
								'value'    => 'site-general-settings',
							),
						),
					),
					'menu_order'            => 99,
					'position'              => 'normal',
					'style'                 => 'default',
					'label_placement'       => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen'        => '',
					'active'                => 1,
					'description'           => '',
				)
			);
		endif;

		if ( function_exists( 'acf_add_local_field_group' ) ) :

			acf_add_local_field_group(
				array(
					'key'                   => 'group_5b3e46a826f7b',
					'title'                 => 'Copyright',
					'fields'                => array(
						array(
							'key'               => 'field_5b3e4ca259594',
							'label'             => 'Copyright',
							'name'              => 'footer_copyright',
							'type'              => 'text',
							'instructions'      => 'Use %year% to dynamically insert the year.',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '&copy; %year%',
							'placeholder'       => '',
							'prepend'           => '',
							'append'            => '',
							'maxlength'         => '',
						),
					),
					'location'              => array(
						array(
							array(
								'param'    => 'options_page',
								'operator' => '==',
								'value'    => 'site-general-settings',
							),
						),
					),
					'menu_order'            => 50,
					'position'              => 'normal',
					'style'                 => 'default',
					'label_placement'       => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen'        => '',
					'active'                => 1,
					'description'           => '',
				)
			);

			endif;
	}

}
