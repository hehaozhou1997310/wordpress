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
	add_option( "display_copyright_text", "<p style='color:red'>Copyright©Jenelle Lymer Site. All rights reserved.</p>" );
	
}

//Defines the method to call when the plug-in is disabled
register_deactivation_hook( __FILE__, 'display_copyright_remove');

function display_copyright_remove() {
	
	//Delete the corresponding record in the wp_option table
	delete_option( "display_copyright_text");
	
}

add_action( "the_content", "display_copyright");

function display_copyright($content){
	if( is_front_page() )
	$content = $content.get_option("display_copyright_text" );
	return $content;
	
}





 