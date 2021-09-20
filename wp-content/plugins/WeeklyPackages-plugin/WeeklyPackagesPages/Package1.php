<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<?php

add_action('init', 'wpackages_enqueue_assets');



function wpackages_enqueue_assets() 
{
	wp_register_style('wpackages_icons', "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css");
    wp_enqueue_style('wpackages_icons');
	wp_register_style('wpackages_custom_style', plugins_url('WeeklyPackages-plugin/assets/style.css'));
    wp_enqueue_style('wpackages_custom_style');
}

function packagepage1_design() {
	?>
	
	<center> <h1>Weekly Packages</h1> </center>

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

    <?php
}

function wp_shortcode() {
	ob_start();
	packagepage1_design();
}

add_shortcode( 'package_page1', 'wp_shortcode' );


?>

