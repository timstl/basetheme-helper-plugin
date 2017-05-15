<?php
/**
 * Do some cleanup when this plugin is first activated.
 */
namespace ATMDST\Lib\Classes;

class Admin {
	
	public function __construct() {
		add_action('admin_notices', array($this, 'admin_notices'));
	}

	public function admin_notices() {
		if (current_user_can('manage_options') && '0' == get_option('blog_public')) { 
			echo '<div class="error"><p>Search engines are currently blocked.</p></div>';	
		}
	}
}