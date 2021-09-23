<?php
/*
Plugin Name: Custom Login Register
Plugin URI: 
Description: Create custom login and register form for users.
Version: 1.2
Author: Haozhou He
Author URI: 
*/

define('CLR_VERSION', '1.2');
define('CLR_FILE', basename(__FILE__));
define('CLR_NAME', str_replace('.php', '', CLR_FILE));
define('CLR_PATH', plugin_dir_path(__FILE__));
define('CLR_URL', plugin_dir_url(__FILE__));

if(!class_exists('CLR_Plugin'))
{
	class CLR_Plugin {
		
		public function __construct()
		{
			// Initialize Settings
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$CLR_Plugin_Settings = new CLR_Plugin_Settings();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
		} 

		// Activate the plugin
		public static function activate() {
		} 

		// Deactivate the plugin
		public static function deactivate()	{
		} 

		// Add the settings link to the plugins page
		function plugin_settings_link($links) {
			$settings_link = '<a href="options-general.php?page=clr_plugin_setting">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}

	} // END class CLR_Plugin
} // END if(!class_exists('CLR_Plugin'))

if(class_exists('CLR_Plugin')){

	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('CLR_Plugin', 'activate'));
	register_deactivation_hook(__FILE__, array('CLR_Plugin', 'deactivate'));

	// instantiate the plugin class
	$clr_plugin = new CLR_Plugin();
}

add_action( 'plugins_loaded', 'cmr_suregd_execute' );
function cmr_suregd_execute(){
add_filter('manage_users_columns', 'cmr_suregd_add_upwd_col');
	function cmr_suregd_add_upwd_col($columns) {
	    $columns['user_registered'] = 'Registration date';
	    return $columns;
	}
	 
	add_action('manage_users_custom_column',  'cmr_suregd_show_upwd_col_data', 10, 3);
	function cmr_suregd_show_upwd_col_data($value, $column_name, $user_id) {
	    $user = get_userdata( $user_id );
	    if ( 'user_registered' == $column_name )
	        return $user->user_registered;
	    return $value;
	}
}