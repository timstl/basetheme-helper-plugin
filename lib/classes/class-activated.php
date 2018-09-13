<?php
/**
 * Do some cleanup when this plugin is first activated.
 */
namespace ATMDST\Lib\Classes;

class Activated {
	
	public function __construct() {
		$this->goodbye_dolly();
		$this->setup_pages();
	}
	
	private function goodbye_dolly() {
		/* Goodbye Dolly */
		if (file_exists(WP_PLUGIN_DIR.'/hello.php')) {
			require_once(ABSPATH.'wp-admin/includes/plugin.php');
			require_once(ABSPATH.'wp-admin/includes/file.php');
			delete_plugins(array('hello.php'));
		}
	}
	
	private function setup_pages() {
		/* Pages to auto-create */
		$page_titles = array("Home", "Blog");
			
		if (!get_page_by_path('home') && get_page_by_path('sample-page')) {		
			/* Delete default sample page */
			wp_delete_post( get_page_by_path('sample-page')->ID );
			
			$args = array (
				"post_type" => "page",
				"post_content" => "",
				"post_status" => "publish",
				"post_author" => 1
			);
			
			/* Create default pages */
			foreach ($page_titles as $pt)
			{
				$args['post_title'] = $pt;
				
				$id = wp_insert_post($args);
				
				if (!is_wp_error($id) && $id > 0) {
					if ($pt == "Home") {
						/* Set homepage to be default Home instead of a blog page */
						update_option('show_on_front', 'page');
						update_option('page_on_front', $id);
						
						/* 
							Set to homepage template 
							This won't work for all themes but does for https://github.com/timstl/basetheme-scss
						*/
						update_post_meta($id, '_wp_page_template', 'template-home.php');
					}
					elseif ($pt == "Blog") {
						/* Set default blog reading page */
						update_option('page_for_posts', $id);
					}
				}
			}
			
			/* Block search engines */
			update_option('page-created', true);
			update_option('blog_public', '0');		
		}
	}
}