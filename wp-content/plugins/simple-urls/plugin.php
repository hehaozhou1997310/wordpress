<?php
/**
 * Plugin Name: Simple URLs
 * Plugin URI: https://getlasso.co/?utm_source=SimpleURLs&utm_campaign=WP
 * Description: Simple URLs is a complete URL management system that allows you create, manage, and track outbound links from your site by using custom post types and 301 redirects.
 * Author: Lasso
 * Author URI: https://getlasso.co/?utm_source=SimpleURLs&utm_campaign=WP
 * Version: 106

 * Text Domain: simple-urls
 * Domain Path: /languages

 * License: GNU General Public License v2.0 (or later)
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 *
 * @package simple-urls
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SIMPLE_URLS_DIR', plugin_dir_path( __FILE__ ) );
define( 'SIMPLE_URLS_URL', plugins_url( '', __FILE__ ) );

require_once SIMPLE_URLS_DIR . '/includes/class-simple-urls.php';

new Simple_Urls();

if ( is_admin() ) {
	require_once SIMPLE_URLS_DIR . '/includes/class-simple-urls-admin.php';
	new Simple_Urls_Admin();
}
