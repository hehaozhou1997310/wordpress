<?php
/**
* @package PackagesPlugin
*/
/*
Plugin Name: WeeklyPackages plugin
Plugin URI: http://WeeklyPackagesplugin.com
Description:Weekly packages page plugin
Version: 1.0.0
Author: Ali Dhaidan
Author URI: http://WeeklyPackagesplugin.com
License: GPLv2 or later
Text Domain: WeeklyPackages-plugin

*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

add_action('init', 'wpackages_enqueue_assets');

add_shortcode('weeklypackages_page','wpackages_page');

function wpackages_enqueue_assets() 
{
	wp_register_style('wpackages_icons', "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css");
    wp_enqueue_style('wpackages_icons');
	wp_register_style('wpackages_custom_style', plugins_url('WeeklyPackages-plugin/assets/mystyle.css'));
    wp_enqueue_style('wpackages_custom_style');


}



if (class_exists( 'WeeklyPackages')) {
	$weeklyPackages = new WeeklyPackages();
	$weeklyPackages->register();
	
	
}



// activation
register_activation_hook( __FILE__, array( $weeklyPackages, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array( $weeklyPackages, 'deactivate' ) );
