<?php
/*
Plugin Name: hhz Custom User Registration
Plugin URI: 
Description: Modify the default user registration form
Version: 1.0
Author: HaozhouHe
Author URI: 
*/


function custom_registration_function() {
    if (isset($_POST['submit'])) {
        registration_validation(
        $_POST['username'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['email'],
        $_POST['password'],
		);
		
		// sanitize user form input
        global $username, $first_name, $last_name, $email,$password;
        $username	= 	sanitize_user($_POST['username']);
        $first_name = 	sanitize_text_field($_POST['fname']);
        $last_name 	= 	sanitize_text_field($_POST['lname']);
        $email 		= 	sanitize_email($_POST['email']);
        $password 	= 	esc_attr($_POST['password']);

		// call @function complete_registration to create the user
		// only when no WP_error is found
        complete_registration(
        $username,
        $first_name,
        $last_name,
        $email,
        $password,
		);
    }

   registration_form(
    	$username="",
        $first_name="",
        $last_name="",
        $email="",
        $password="",      
		); 
}

function registration_form( $username, $first_name, $last_name, $email, $password) {
    echo '
    <style>
	div {
		margin-bottom:2px;
	}
	
	input{
		margin-bottom:4px;
	}
	</style>
	';

    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
	<div>
	<label for="username">Username <strong>*</strong></label>
	<input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
	</div>
	
	<div class="fcontainer">
	<label for="firstname">First Name</label>
	<input type="text" name="fname" value="' . (isset($_POST['fname']) ? $first_name : null) . '">
	</div>
	
	<div class="fcontainer">
	<label for="website">Last Name</label>
	<input type="text" name="lname" value="' . (isset($_POST['lname']) ? $last_name : null) . '">
	</div>
	
	<div class="fcontainer">
	<label for="email">Email <strong>*</strong></label>
	<input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '">
	</div>
	
	<div class="fcontainer">
	<label for="password">Password <strong>*</strong></label>
	<input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
	</div>
		
    <input type="submit" name="submit" value="Register"/>
	</form>
	';
}

function registration_validation( $username, $first_name, $last_name, $email,$password )  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $email ) || empty( $password ) ) {
        $reg_errors->add('field', 'Required form field is missing');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', 'Username too short. At least 4 characters is required');
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name', 'Sorry, that username already exists!');

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', 'Sorry, the username you entered is not valid');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'Email is not valid');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Email Already in use');
    }
     
    if ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', 'Password length must be greater than 5');
    }
}

    if ( is_wp_error( $reg_errors="") ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';

            echo '</div>';
        }
    } 

function complete_registration() {
    global $reg_errors, $username,$first_name, $last_name, $email, $password;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'	=> 	$username, 
        'first_name' 	=> 	$first_name,
        'last_name' 	=> 	$last_name,
        'user_email' 	=> 	$email,
        'user_pass' 	=> 	$password,
		);
        $user = wp_insert_user( $userdata );
        echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';   
	}
}

// Register a new shortcode: [cr_custom_registration]
add_shortcode('hhz_custom_registration', 'custom_registration_shortcode');

// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}
