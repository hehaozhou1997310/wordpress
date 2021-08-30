<?php
/*
Plugin Name: hhz-copyright
Plugin URI: 
Description: Displays a copyright message in the footer
Version: 1.0
Author: Haozhou He
Author URI: 
License: GPL
*/


//Defines the method to call when the plug-in starts
register_activation_hook( __FILE__, 'display_copyright_install');

function display_copyright_install() {
	
	//Add a record in the wp_option table
	add_option( "display_copyright_text", "<p style='color:red'>All articles on this site are original, please indicate the source of reprint!</p>" );
	
}

//Defines the method to call when the plug-in is disabled
register_deactivation_hook( __FILE__, 'display_copyright_remove');

function display_copyright_remove() {
	
	//Delete the corresponding record in the wp_option table
	delete_option( "display_copyright_text");
	
}

add_filter( "the_content", "display_copyright");







 