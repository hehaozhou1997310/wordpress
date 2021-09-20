<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
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



function wpackages_enqueue_assets() 
{
	wp_register_style('wpackages_icons', "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css");
    wp_enqueue_style('wpackages_icons');
	wp_register_style('wpackages_custom_style', plugins_url('WeeklyPackages-plugin/assets/style.css'));
    wp_enqueue_style('wpackages_custom_style');
}
  

function page_design() {
	?>
	
	<center> <h1>Weekly Packages</h1> </center>
	
	<div class="flex-container">

  	<div class="flex-child magenta">
		  
    Thumbnail 1

	<html>
	<body>

	<form action="upload.php" method="post" enctype="multipart/form-data">
  	Select image to upload:
  	<input type="file" name="fileToUpload" id="fileToUpload">
  	<input type="submit" value="Upload Image" name="submit">
	
	</form>
	<div button>
	<form action="http://localhost/package-1/" method="post" enctype="multipart/form-data">
	<button onclick="WeeklyPackagesPages/Package1='default.asp'">Begin</button>
	</div button>
	</form>
	


	</body>
	</html>
	
	
	
  	</div>
  
  	<div class="flex-child green">
		  
    

	<p>Week 1: 1hr call Pre-consultation - Getting to know you.</p>
	<p>•	Welcome call in starting your journey and outlining the agenda for the next 5 weeks.</p>
	<p>•	Explain what you can expect and also answer any questions you might have.</p>
	<p>•	Discuss your personal history.</p>
	<p>•	Why you have reached out.</p>
	<p>•	Finding out the core issues you want help with.</p>
	<p>•	We will explore internal conflicts that have been holding you back.</p>
	<p>•	Dig deep to find the core issues.</p>
	<p>•	Find your desired outcome and goal and plan a strategy to get you there.</p>

	
  	</div>
  
	</div>

	<div class="flex-container">

  	<div class="flex-child magenta">
		  
    Thumbnail 2
	
	<html>
	<body>

	<form action="upload.php" method="post" enctype="multipart/form-data">
  	Select image to upload:
  	<input type="file" name="fileToUpload" id="fileToUpload">
  	<input type="submit" value="Upload Image" name="submit">
	</form>

	</body>
	</html>
	
  	</div>
  
  	<div class="flex-child green">
		  

	<p>Week 2: 1 hr call Consultation 1 - Identifying what we do and why.</p>

	<p>•	Become aware of our pre-programmed behaviours.</p>
	<p>•	Unwrapping beliefs and perceptions that we have been passed on by our parents.</p>
	<p>•	Becoming aware of the cause and effect of your actions.</p>
	<p>•	How it has been impacting our lives.</p>


	
  	</div>
  
	</div>

	<div class="flex-container">

  	<div class="flex-child magenta">
		  
    Thumbnail 3
	
	<html>
	<body>

	<form action="upload.php" method="post" enctype="multipart/form-data">
  	Select image to upload:
  	<input type="file" name="fileToUpload" id="fileToUpload">
  	<input type="submit" value="Upload Image" name="submit">
	</form>

	</body>
	</html>
	
  	</div>
  
  	<div class="flex-child green">
		  

	<p>Week 3: 1 hr call Consultation 2- Acknowledging our feelings.</p>

	<p>•	To name a few: Our shame, our guilt, our sadness, our fear, our anger etc.</p>
	<p>•	We will delve into each of the feelings that are ruling you and taking up time and space in your mind daily.</p>
	<p>•	Freeing yourself of these emotions will give you back your energy and clear the brain fog that has been consuming you.</p>
	<p>•	Discussing the power of forgiveness.</p>


	
  	</div>
  
	</div>

	<div class="flex-container">

  	<div class="flex-child magenta">
		  
    Thumbnail 4
	
	<html>
	<body>

	<form action="upload.php" method="post" enctype="multipart/form-data">
  	Select image to upload:
  	<input type="file" name="fileToUpload" id="fileToUpload">
  	<input type="submit" value="Upload Image" name="submit">
	</form>

	</body>
	</html>
	
  	</div>
  
  	<div class="flex-child green">
		  

	<p>Week 4: 1hr call Consultation 3 - Upgrading our thoughts</p>

	<p>•	Taking back your power for yourself.</p>
	<p>•	Identity your self-worth & dignity.</p>
	<p>•	Becoming aware of our self-talk.</p>
	<p>•	Receive exercises specifically for your character type.</p>
	<p>•	Clearing our limiting beliefs.</p>




	
  	</div>
  
	</div>

	<div class="flex-container">

  	<div class="flex-child magenta">
		  
    Thumbnail 5
	
	<html>
	<body>

	<form action="upload.php" method="post" enctype="multipart/form-data">
  	Select image to upload:
  	<input type="file" name="fileToUpload" id="fileToUpload">
  	<input type="submit" value="Upload Image" name="submit">
	</form>

	</body>
	</html>
	
  	</div>
  
  	<div class="flex-child green">
		  

	<p>Week 5: 1hr call Consultation 4 - Looking at our life blocks</p>

	<p>•	Identifying what holds up back.</p>
	<p>•	Looking into why we have a foot on the brake to life.</p>
	<p>•	Deeply search for core reasons behind our blocks.</p>
	<p>•	Continue to work on taking our power back.</p>
	<p>•	Taking responsibility and ownership.</p>





	
  	</div>
  
	</div>

	<div class="flex-container">

  	<div class="flex-child magenta">
		  
    Thumbnail 6
	
	<html>
	<body>

	<form action="upload.php" method="post" enctype="multipart/form-data">
  	Select image to upload:
  	<input type="file" name="fileToUpload" id="fileToUpload">
  	<input type="submit" value="Upload Image" name="submit">
	</form>

	</body>
	</html>
	
  	</div>
  
  	<div class="flex-child green">
		  
    <p>Flex Column 2</p>

	<p>Week 6: 1hr call Consultation 5 - Strategy to keep the flow going</p>

	<p>•	Review confidence and self-esteem.</p>
	<p>•	Create a plan to maintain the flow to grow.</p>
	<p>•	How to set realistic goals that are achievable.</p>
	<p>•	Discuss options of keeping yourself accountable.</p>
	<p>•	Own your past and create your future.</p>






	
  	</div>
  
	</div>

	<div class="flex-container">

  	<div class="flex-child magenta">
		  
    Thumbnail 6
	
	<html>
	<body>

	<form action="upload.php" method="post" enctype="multipart/form-data">
  	Select image to upload:
  	<input type="file" name="fileToUpload" id="fileToUpload">
  	<input type="submit" value="Upload Image" name="submit">
	</form>

	</body>
	</html>
	
  	</div>
  
  	<div class="flex-child green">
		  
    <p>Flex Column 2</p>

	<p>Week 7: 30min call Consultation 6 - Where to now</p>

	<p>•	Overview discussion.</p>
	<p>•	How you are feeling and what’s next.</p>
	<p>•	Provide support via exclusive private FaceBook group.</p>
	<p>•	Lifetime support in community.</p>

	<?php
	
}

/*
if (class_exists( 'WeeklyPackages')) {
	$weeklyPackages = new WeeklyPackages();
	$weeklyPackages->register();
	
	
}
*/

function wp_shortcode() {
	ob_start();
	page_design();
}

add_shortcode( 'weekly_packages', 'wp_shortcode' );

?>
