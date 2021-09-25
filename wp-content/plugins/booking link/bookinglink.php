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
	echo "<center></br>";
	echo "<h4>Schedule a date & time that suits you via Jenelle's 'calendly' link</h4>";
	echo '<p>';
	echo "<center></br>";
	echo '<input type="submit" name="submit" style="width:140px;height:60px" value="Book Now!" onclick="window.open(\'http://calendly.com\')"/>';
	echo '<br></center>';
}

add_shortcode( 'my_booking_link', 'bl_shortcode');

?>

