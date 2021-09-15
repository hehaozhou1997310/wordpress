<?php
/*
Plugin Name: Login/Sign-up
Plugin URI: http://yazeed.net
description:
a plugin to create for login and signup
Version: 1.2
Author: Yazeed
Author URI: http://yazeed.net
License: GPL2
*/


add_action('init', 'enqueue_assets');

add_shortcode('userLoginSignUp','userLoginSingup_view');

function enqueue_assets()
{
    wp_register_style('custom_style', plugins_url('/login-signup/assets/style.css'));
    wp_enqueue_style('custom_style');

//    scripts
    wp_register_script('jquery-3.6.0','https://code.jquery.com/jquery-3.6.0.min.js');
    wp_enqueue_script('jquery-3.6.0');
    wp_register_script('custom_script', plugins_url('login-signup/assets/index.js'));
    wp_enqueue_script('custom_script');

//    global const
    wp_localize_script('custom_script', 'global_obj', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ));
}

add_action('wp_ajax_submit_signup_form','submit_signup_form');
add_action('wp_ajax_nopriv_submit_signup_form','submit_signup_form');

add_action('wp_ajax_submit_login_form','submit_login_form');
add_action('wp_ajax_nopriv_submit_login_form','submit_login_form');

function userLoginSingup_view(){
    ob_start();
?>
    <div class="signin-page">
    <div class="fcontainer">
        <div id="message" style="color: red">

        </div>
        <form class="signup-form" name="formSenda" method="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
            <div class="flex pinp">
                <input name="username" type="text" placeholder="Username" required style="margin-left:0px;margin-right:0px;" />
            </div>
            <div class="flex pinp">
                <input name="fname" type="text" placeholder="First Name" required />
                <input name="lname" type="text" placeholder="Last Name" required />
            </div>
            <div class="flex pinp">
                <input name="email" type="email" placeholder="Email Address" required />
                <input name="confirm_email" type="email" placeholder="Confirm Email Address" required  />
            </div>
            <div class="flex pinp">
                <input name="country" type="text" placeholder="Country" required />
                <input name="phone_number" type="number" placeholder="Phone Number" required />
            </div>
            <div class="flex pinp">
                <input name="password" type="password" placeholder="Password" required />
                <input name="confirm_password" type="password" placeholder="Confirm Password" required />
            </div>
            <button type="submit" name="submitSignUp">Sign-up</button>
            <p class="message">Already registered? <a href="#" class="sign-in">Sign In</a></p>
        </form>
        <form class="login-form">
            <input type="text" name="username" placeholder="username" required />
            <input type="password" name="password" placeholder="password" required />
            <button>Sign-in</button>
            <p class="message">Not registered? <a href="#" class="create_account">Create an account</a></p>
        </form>
    </div>
</div>

    <?php
    echo ob_get_clean();
}

function submit_signup_form(){

    $is_have_errors = false;
    $errors ='';

    $fullName = $_POST['fname'].' '.$_POST['lname'];
    $email = $_POST['email'];
    $confirm_email = $_POST['confirm_email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($email != $confirm_email){
        $errors = "Mail not confirmed";
        $is_have_errors = true;
    }elseif ($password != $confirm_password){
        $errors = "Password doesn't matched";
        $is_have_errors = true;
    }

    if($is_have_errors){
        echo json_encode(['status' => 'false', 'message' => $errors]);
        wp_die();
    }

    $userdata = array(
        'user_login'  => $_POST['username'],
        'first_name'  => $_POST['fname'],
        'last_name'   => $_POST['lname'],
        'user_email'  => $email,
        'user_pass'   => $password,

    );
    $user = wp_insert_user($userdata);
    add_user_meta($user, 'country', $_POST['country']);
    add_user_meta($user, 'phone', $_POST['phone_number']);

    $url = site_url() . '/userlogin';
    echo json_encode(['status' => 'true','url' => $url, 'message' => $errors]);
    wp_die();
}

function submit_login_form(){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;

    $user_verify = wp_signon( $login_data, false );

    if ( is_wp_error($user_verify) )
    {
        echo json_encode(['status' => 'false', 'message' => $user_verify->get_error_message()]);
        wp_die();
    } else {
        $data = ['status' => 'true', 'message' => 'Login Successfully', 'url' => site_url() . "/user-dashboard"];
        echo json_encode($data);
        wp_die();
    }
}