<?php
/*
Plugin Name: User Dashboard
Plugin URI: 
description:
a plugin to create for user dahboard
Version: 1.2
Author: Yazeed
Author URI: 
License: GPL2
*/


add_action('init', 'udash_enqueue_assets');

add_shortcode('udashboard_view','udash_view');
add_shortcode('admin_dashboard_view','admin_dash_view');

function udash_enqueue_assets()
{
    wp_register_style('udash_icons', "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css");
    wp_enqueue_style('udash_icons');
    wp_register_style('udash_custom_style', plugins_url('/user-dashboard/assets/style.css'));
    wp_enqueue_style('udash_custom_style');

//    scripts
    wp_register_script('udash_jquery-3.6.0','https://code.jquery.com/jquery-3.6.0.min.js');
    wp_enqueue_script('udash_jquery-3.6.0');
    wp_register_script('udash_custom_script', plugins_url('user-dashboard/assets/index.js'));
    wp_enqueue_script('udash_custom_script');

    //    global const
    wp_localize_script('udash_custom_script', 'global_obj', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ));

}


function udash_view(){
    ob_start();
    if(!is_user_logged_in()){
      echo  "<div class='login-required'>login required... <a href='".site_url()."/login-2'>login</a></div>";
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
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-packages')" class="nav-items"><i class="bi bi-box"></i> my packages</a></li>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-details')" class="nav-items active"><i class="bi bi-journal-text"></i> my details</a></li>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-messages')" class="nav-items"><i class="bi bi-chat"></i> my messages</a></li>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-schedule')" class="nav-items"><i class="bi bi-calendar-date"></i> my schedule</a></li>
                </ul>
            </div>
            <div class="body-content-dashboard">
                <div class="dashboard-navbar">
                    <a href="#"><i class="bi bi-bell"></i></a>
                    <a href="#"><i class="bi bi-gear"></i></a>
                </div>
                <div class="content-dash">
                    <div id="my-packages" class="content-dash-body d-none">
                        <h3 class="margin-unset">my packages</h3>
                        <div>
                            <div class="submit-dash-form">
                                <a href="<?= site_url()."/home"?>" class="btn btn-primary">Add new Package</a>
                            </div>
                        </div>
                    </div>
                    <div id="my-messages" class="content-dash-body d-none">
                        <h3 class="margin-unset">my messages</h3>
                        <div>
                            <div class="submit-dash-form">
                                <a href="<?= site_url()."/home"?>" class="btn btn-primary">Message admin</a>
                            </div>
                        </div>
                    </div>
                    <div id="my-schedule" class="content-dash-body d-none">
                        <h3 class="margin-unset">my schedule</h3>
                        <div>
                            <div class="submit-dash-form">
                                <a href="<?= site_url()."/my-booking"?>" class="btn btn-primary">Add new Schedule</a>
                            </div>
                        </div>
                    </div>
                    <div id="my-details" class="content-dash-body">
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
        </div>

        <?php
    }
    echo ob_get_clean();
}

function admin_dash_view(){
    ob_start();
    if(!current_user_can('manage_options')){
        echo  "<div class='login-required'>you don't have access to admin page</div>";
        die;
    }
    if(!is_user_logged_in()){
      echo  "<div class='login-required'>login required... <a href='".site_url()."/userlogin'>login</a></div>";
    }else {
       
    
        ?>
        <div class="userdashboard">
            <div class="userdashoard-sidebar">
                <h4>Admin Dashboard</h4>
                <ul>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-packages')" class="nav-items"><i class="bi bi-box"></i>Packages</a></li>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-details')" class="nav-items active"><i class="bi bi-journal-text"></i>Clients</a></li>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-messages')" class="nav-items"><i class="bi bi-chat"></i>Conversations</a></li>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-schedule')" class="nav-items"><i class="bi bi-calendar-date"></i>Schedule</a></li>
                </ul>
            </div>
            <div class="body-content-dashboard">
                <div class="dashboard-navbar">
                    <a href="#"><i class="bi bi-bell"></i></a>
                    <a href="#"><i class="bi bi-gear"></i></a>
                </div>
                <div class="content-dash">
                    <div id="my-packages" class="content-dash-body d-none">
                        <h3 class="margin-unset">Packages</h3>
                        <div>
                            <div class="submit-dash-form">
                                <a href="<?= site_url()."/home"?>" class="btn btn-primary">Add new Package</a>
                            </div>
                        </div>
                    </div>
                    <div id="my-messages" class="content-dash-body d-none">
                        <h3 class="margin-unset">Conversations</h3>
                    </div>
                    <div id="my-schedule" class="content-dash-body d-none">
                        <h3 class="margin-unset">Schedules</h3>
                    </div>
                    <div id="my-details" class="content-dash-body">
                        <div class="flex">
                            <h3 class="margin-unset">Clients</h3>
                            <div class="submit-dash-form add-new-client">
                                <button class="btn-same-detail">add new client</button>
                            </div>
                            <div class="submit-dash-form back-to-listing d-none">
                                <button class="btn-same-detail">back to listing</button>
                            </div>
                            <div class="client-listing-box">
                            <div class="client-name-box flex">
                                <div class="user-client">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                
                        
                                <div class="details-client">
                                    <button class="btn-same-detail">View Detials</button>
                                    <button class="btn-same-detail">Edit</button>
                                </div>
                            </div>
                            <div class="client-name-box flex">
                                <div class="user-client">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                               
                                <div class="details-client">
                                    <button class="btn-same-detail">View Detials</button>
                                    <button class="btn-same-detail">Edit</button>
                                </div>
                            </div>
                            <div class="client-name-box flex">
                                <div class="user-client">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                
                                </div>
                                <div class="details-client">
                                    <button class="btn-same-detail">View Detials</button>
                                    <button class="btn-same-detail">Edit</button>
                                </div>
                            </div>
                        </div>

                        <div class="signin-page client-register-page d-none">
                            <div class="fcontainer">
                                <div id="message" style="color: red"></div>
                                <form class="signup-form" style="display: block" name="formSenda" method="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
                                    <div class="flex pinp">
                                        <input type="text" name="username" placeholder="username" required />
                                    </div>
                                    <div class="flex pinp">
                                        <input name="fname" type="text" placeholder="First Name" required />
                                        <input name="lname" type="text" placeholder="Last Name" required />
                                    </div>
                                    <div class="flex pinp">
                                        <input name="email" type="email" placeholder="Email Address" required />
                                    </div>
                                    <div class="flex pinp">
                                        <input name="country" type="text" placeholder="Country" required />
                                        <input name="phone_number" type="number" placeholder="Phone Number" required />
                                    </div>
                                    <div class="flex pinp">
                                        <input name="password" type="password" placeholder="Password" required />
                                    </div>
                                    <button type="submit" class="btn-same-detail" name="submitSignUp">create client</button>
                                </form>
                            </div>
                        </div>

                    </div>
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

/* add_filter( 'wp_nav_menu_items', 'add_extra_item_to_nav_menu', 10, 2 );
function add_extra_item_to_nav_menu( $items, $args ) {
    if (is_user_logged_in()) {
        $items .= '<li><a href="'. site_url().'/user-dashboard'.'">User dahsboard</a></li>';
    }
    return $items;
} */