<?php
/*
Plugin Name: Booking Link
Plugin URI: http://kelvindavid.net
description:
a plugin to create a link to booking system
Version: 1
Author: Kelvin and David
Author URI: http://kelvindavid.net
License: 1234
*/

function bl_shortcode() {

if(!is_user_logged_in()){
		echo  "<div class='login-required'>You are currently not logged in. Please <a href='".site_url()."/login-2'>login or register</a> to access this page. </div>";
	  }
	  else{
	echo "<center></br>";
	echo "<h4>Schedule a date & time that suits you via Jenelle's 'calendly' link</h4>";
	echo '<p>';
	echo "<center></br>";
	echo '<input type="submit" name="submit" style="width:140px;height:60px" value="Book Now!" onclick="window.open(\'https://calendly.com/itsareallyniceday\')"/>';
	echo '<br></center>';
	}
}

add_shortcode( 'my_booking_link', 'bl_shortcode');

?>

