<?php
/*
Plugin Name: hhz Custom User Registration
Plugin URI: 
Description: Modify the default user registration form
Version: 1.0
Author: HaozhouHe
Author URI: 
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function custom_registration_function() {
    if (isset($_POST['submit'])) {
        registration_validation(
        $_POST['username'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['email'],
        $_POST['confirmemail'],
        $_POST['country'],
        $_POST['phone'],
        $_POST['password'],
        $_POST['confirmpass'],
        
		);
		
		// sanitize user form input
        global $username, $first_name, $last_name, $email, $confirm_email, $country, $phone, $password, $confirm_pass;
        $username	= 	sanitize_user($_POST['username']);
        $first_name = 	sanitize_text_field($_POST['fname']);
        $last_name 	= 	sanitize_text_field($_POST['lname']);
        $email		= 	sanitize_email($_POST['email']);
        $confirm_email		= 	sanitize_email($_POST['confirmemail']);
        $country = 	sanitize_text_field($_POST['country']);
        $phone 	= 	sanitize_text_field($_POST['phone']);
        $password 	= 	esc_attr($_POST['password']);
        $confirm_pass 	= 	esc_attr($_POST['confirmpass']);

		// call @function complete_registration to create the user
		// only when no WP_error is found
        complete_registration(
        $username,
        $first_name,
        $last_name,
        $email,
        $confirm_email,
        $country,
        $phone,
        $password,
        $confirm_pass,
		);
    }

        registration_form(
    	$username="",
        $first_name="",
        $last_name="",
        $email="",
        $confirm_email="",
        $country="",
        $phone="",
        $password="",   
        $confirm_pass="",    
		); 
}

function registration_form( $username, $first_name, $last_name, $email, $confirm_email, $country, $phone, $password, $confirm_pass) {
    echo '
    <style>
	div {
         margin-bottom: 1px;
	}
	
	input {
         margin-bottom: 1px;   
	}
	</style>
	'; 

   
    echo '
    <hand>
    <link rel="stylesheet" href="//apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css"  
    rel="external nofollow" target="_blank" >
    <script src="//apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js" rel="external nofollow"    
    rel="external nofollow"  rel="external nofollow" >
    </script>
    <script src="//apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js" rel="external nofollow"  
    </script>
    </head>

    <body>
    <div class="container">
    <form action="' . $_SERVER['REQUEST_URI'] . '" class="form-horizontal" method="post">
        <div class="ur-form-grid">
            <div class="col-lg-10">
                <label for="username" class=""col-lg control-label">Username <strong>*</strong></label>
                <input type="text" class="form-control" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
	        </div>
	    </div>

        <div class="ur-form-grid">
            <div class="col-lg-5">
	            <label for="firstname" class=""col-lg control-label">First Name</label>
	            <input type="text" class="form-control" name="fname" value="' . (isset($_POST['fname']) ? $first_name : null) . '">
	        </div>
            <div class="col-lg-5">
                <label for="lastname" class=""col-lg control-label">Last Name</label>
	            <input type="text" class="form-control" name="lname" value="' . (isset($_POST['lname']) ? $last_name : null) . '">
	    </div>
	       
	    <div class="ur-form-grid">
             <div class="col-lg-5">
                     <label for="email" class=""col-lg control-label">Email <strong>*</strong></label>
	                 <input type="text" class="form-control" name="email" value="' . (isset($_POST['email']) ? $email : null) . '">
	            </div>
                <div class="col-lg-5">
                     <label for="email" class=""col-lg control-label">Confirm Email <strong>*</strong></label>
	                 <input type="text" class="form-control" name="email" value="' . (isset($_POST['confirmemail']) ? $confirm_email : null) . '">
	            </div>
            </div>

            <div class="ur-form-grid">
             <div class="col-lg-5">
                     <label for="country" class=""col-lg control-label">Country</label>
	                 <input type="text" class="form-control" name="country" value="' . (isset($_POST['country']) ? $country : null) . '">
	            </div>
                <div class="col-lg-5">
                     <label for="phone" class=""col-lg control-label">Phone Number</label>
	                 <input type="text" class="form-control" name="phone" value="' . (isset($_POST['phone']) ? $phone : null) . '">
	            </div>
            </div>
	
            <div class="ur-form-grid">
                <div class="col-lg-5">
	                <label for="password" class="col-lg control-label">Password <strong>*</strong></label>
	                <input type="password" class="form-control" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
	            </div> 
                <div class="col-lg-5">
	                <label for="password" class="col-lg control-label">Confirm Password <strong>*</strong></label>
	                <input type="password" class="form-control" name="password" value="' . (isset($_POST['confiempass']) ? $confirm_pass : null) . '">
                    </div> 
	        </div>
    
            <div class="ur-form-grid">
                <div class="col-lg-10">	
                <br>
                <button type="submit" class="btn btn-success btn-block" name="submit">Sign Up</button>
                </div> 
            </div>
        </div>
	</form>

            <div class="ur-form-grid">	
                <div class="col-lg-10">	
                    <label for="text">Already rigistered?</label>
                    <button type="submit" class="btn btn-md btn-link" name="submit">Login</button>
                </div> 
            </div>
	';
}

function registration_validation( $username, $first_name, $last_name, $email, $confirm_email, $password, $confirm_pass)  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $email ) || empty( $password ) ) {
        $reg_errors->add('field', 'Required form field is missing');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', 'Username too short. At least 4 characters is required');
    }

    if ( username_exists( $username ) )
        $reg_errors->add('username', 'Sorry, that username already exists!');

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', 'Sorry, the username you entered is not valid');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'Email is not valid');
    }

    if ( email_exists( $email ) ) 
        $reg_errors->add('email', 'Email Already in use');
    elseif  ( $_POST['email'] != $_POST['confirmemail'])
        $reg_errors->add('email_error', 'The two emails are inconsistent');

     
    if ( strlen( $password) < 6 ) 
        $reg_errors->add('password_length', 'Password length must be greater than 6');
    elseif ( $_POST['password'] != $_POST['confirmpass'])
        $reg_errors->add('password_error', 'The two passwords are inconsistent');

}

    if ( is_wp_error( $reg_errors="" ) ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';

            echo '</div>';
        }
    } 

function complete_registration() {
    global $reg_errors, $username,$first_name, $last_name, $email, $country, $phone, $password;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'	=> 	$username, 
        'first_name' 	=> 	$first_name,
        'last_name' 	=> 	$last_name,
        'user_email' 	=> 	$email,
        'user_country'  =>  $country,
        'user_phone'    =>  $phone,
        'user_pass' 	=> 	$password,
		);

        $user = wp_insert_user( $userdata );
        echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';   
	}
}

// Register a new shortcode: [cr_custom_registration]
add_shortcode('sccs2-21-2_custom_registration', 'custom_registration_shortcode');

// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}