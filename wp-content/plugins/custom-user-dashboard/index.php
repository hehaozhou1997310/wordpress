<?php
/*
Plugin Name: custom User-Dashboard
Plugin URI: http://yazeed.net
description:
a plugin to create for user dahboard
Version: 1.2
Author: Yazeed
Author URI: http://yazeed.net
License: 123
*/


add_action('init', 'udash_enqueue_assets');

add_shortcode('udashboard_view','udash_view');

function udash_enqueue_assets()
{
    wp_register_style('udash_icons', "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css");
    wp_enqueue_style('udash_icons');
    wp_register_style('udash_custom_style', plugins_url('custom-user-dashboard/assets/style.css'));
    wp_enqueue_style('udash_custom_style');

//    scripts
    wp_register_script('udash_jquery-3.6.0','https://code.jquery.com/jquery-3.6.0.min.js');
    wp_enqueue_script('udash_jquery-3.6.0');
    wp_register_script('udash_custom_script', plugins_url('custom-user-dashboard/assets/index.js'));
    wp_enqueue_script('udash_custom_script');

}


function udash_view(){
    ob_start();
    if(!is_user_logged_in()){
      echo  "<div class='login-required'>login required... <a href='".site_url()."/register-3'>login</a></div>";
    }else {
        $loggedInUserId = get_current_user_id();
        $user = wp_get_current_user();

        $username = $user->user_login;
        $first_name = get_user_meta($loggedInUserId, "first_name",true);
        $last_name = get_user_meta($loggedInUserId, "last_name",true);
        $email = $user->user_email;
        $country = get_user_meta($loggedInUserId, "country",true);
        $phone = get_user_meta($loggedInUserId, "phone",true);
        ?>
        <div class="userdashboard">
            <div class="userdashoard-sidebar">
                <h4>User Dashboard</h4>
                <ul>
                    <li><a href="#"><i class="bi bi-box"></i> my packages</a></li>
                    <li><a href="#" class="active"><i class="bi bi-journal-text"></i> my details</a></li>
                    <li><a href="#"><i class="bi bi-chat"></i> my messages</a></li>
                    <li><a href="#"><i class="bi bi-calendar-date"></i> my schedule</a></li>
                </ul>
            </div>
            <div class="body-content-dashboard">
                <div class="dashboard-navbar">
                    <a href="#"><i class="bi bi-bell"></i></a>
                    <a href="#"><i class="bi bi-gear"></i></a>
                </div>
                <div class="content-dash">
                    <h3 class="margin-unset">my details</h3>
                    <div id="udashmessage"></div>
                    <form class="dash-form-detail" id="userdetailsForm">
                        <input type="hidden" name="user_id" value="<?= $loggedInUserId ?>">
                        <div class="same-style-dash-form">
                            <label>User Name</label>
                            <input type="text" name="username" value="<?= $username ?>">
                        </div>
                        <div class="same-style-dash-form">
                            <label>Phone Number</label>
                            <input type="number" name="phone_number" value="<?= $phone ?>">
                        </div>
                        <div class="same-style-dash-form">
                            <label>First Name</label>
                            <input type="text" name="fname" value="<?= $first_name ?>">
                        </div>
                        <div class="same-style-dash-form">
                            <label>Last Name</label>
                            <input type="text" name="lname" value="<?= $last_name ?>">
                        </div>
                        <div class="same-style-dash-form">
                            <label>Email Address</label>
                            <input type="email" name="email" value="<?= $email ?>">
                        </div>
                        <div class="same-style-dash-form">
                            <label>Confirm Email Address</label>
                            <input type="email" name="confirm_email" value="<?= $email ?>">
                        </div>
                        <div class="same-style-dash-form">
                            <label>Password</label>
                            <input type="password" name="password">
                        </div>
                        <div class="same-style-dash-form">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password">
                        </div>
                        <div class="same-style-dash-form">
                            <label>Country</label>
                            <input type="text" name="country" value="<?= $country ?>">
                        </div>
                        <div class="submit-dash-form">
                            <input type="submit" value="Update Details">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }
    echo ob_get_clean();
}


add_action('wp_ajax_update_user_details','update_user_details');
add_action('wp_ajax_nopriv_update_user_details','update_user_details');

function update_user_details(){

    $is_have_errors = false;
    $errors ='';

    $user_id = $_POST['user_id'];

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
        'ID' => $user_id,
        'user_login'  => $_POST['username'],
        'first_name'  => $_POST['fname'],
        'last_name'   => $_POST['lname'],
        'display_name'   => $_POST['fname'].' '.$_POST['lname'],
        'user_email'  => $email,
        'user_pass'   => $password,

    );
    $user = wp_update_user($userdata);
    update_user_meta($user, 'country', $_POST['country']);
    update_user_meta($user, 'phone', $_POST['phone_number']);

    global $wpdb;
    $wpdb->update(
        $wpdb->users,
        ['user_login' => $_POST['username']],
        ['ID' => $user_id]
    );

    echo json_encode(['status' => 'true','message' => "user details updated successfully"]);
    wp_die();


}
