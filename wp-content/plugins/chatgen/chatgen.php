<?php
/*
 * Plugin Name: Chatgen
 * Version: 3.0.1
 * Description: Powerful platform that enables companies to launch a bot with minimum effort and maximum effect.
 * Author: Chatgen
 * Author URI: https://www.chatgen.ai/?ref=wordpress
 */

// Prevent Direct Access
defined('ABSPATH') or die("Restricted access!");

/*
* Define
*/
define('chatgen_4f050d29b8BB9_VERSION', '3.0.1');
define('chatgen_4f050d29b8BB9_DIR', plugin_dir_path(__FILE__));
define('chatgen_4f050d29b8BB9_URL', plugin_dir_url(__FILE__));
defined('chatgen_4f050d29b8BB9_PATH') or define('chatgen_4f050d29b8BB9_PATH', untrailingslashit(plugins_url('', __FILE__)));

require_once(chatgen_4f050d29b8BB9_DIR . 'includes/core.php');
require_once(chatgen_4f050d29b8BB9_DIR . 'includes/menus.php');
require_once(chatgen_4f050d29b8BB9_DIR . 'includes/admin.php');
require_once(chatgen_4f050d29b8BB9_DIR . 'includes/embed.php');


?>
