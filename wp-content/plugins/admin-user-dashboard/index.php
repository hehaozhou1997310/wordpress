<?php
/*
Plugin Name: Admin/User Dashboard
Plugin URI: 
description:
a plugin to create for user dahboard
Version: 1.2
Author: Yazeed
Author URI:
License: 1234
*/


add_action('init', 'udash_enqueue_assets');

add_shortcode('udashboard_view','udash_view');
add_shortcode('admin_dashboard_view','admin_dash_view');

function udash_enqueue_assets()
{
    wp_register_style('udash_icons', "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css");
    wp_enqueue_style('udash_icons');
    wp_register_style('udash_custom_style', plugins_url('/admin-user-dashboard/assets/style.css'));
    wp_enqueue_style('udash_custom_style');

//    scripts
    wp_register_script('udash_jquery-3.6.0','https://code.jquery.com/jquery-3.6.0.min.js');
    wp_enqueue_script('udash_jquery-3.6.0');
    wp_register_script('udash_custom_script', plugins_url('admin-user-dashboard/assets/index.js'));
    wp_enqueue_script('udash_custom_script');

    //    global const
    wp_localize_script('udash_custom_script', 'global_obj', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ));

}


function udash_view(){
    ob_start();
    if(!is_user_logged_in()){
      echo  "<div class='login-required'>You are currently not logged in. Please <a href='".site_url()."/login-2'>login or register</a> to access this page.</div>";
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
                            <div class="submit-dash-form add-new-packages-btn">
                                <a href="<?= site_url()."/package-2"?>" class="btn btn-primary">View Packages</a>
                            </div>
                        </div>
                    </div>
                    <div id="my-schedule" class="content-dash-body d-none">
                        <h3 class="margin-unset">my schedule</h3>
                        <div>
                            <div class="submit-dash-form add-new-schedule-btn">
                                <a href="<?= site_url()."/booking"?>" class="btn btn-primary">Add new Schedule</a>
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
                                <input type="submit" value="Update my Details">
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
        $args = array(
            'role__not_in' => 'administrator'
        );
        $user_query = new WP_User_Query( $args );
        ?>
        <div class="userdashboard">
            <div class="userdashoard-sidebar">
                <h4>Admin Dashboard</h4>
                <ul>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-packages')" class="nav-items"><i class="bi bi-box"></i>Packages</a></li>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-details')" class="nav-items active"><i class="bi bi-journal-text"></i>Clients</a></li>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-schedule')" class="nav-items"><i class="bi bi-calendar-date"></i>Schedule</a></li>
                    <li><a href="#" onclick="DisplayTabs.pagesController(this,'my-tracker')" class="nav-items"><i class="bi bi-bar-chart"></i>Progress Tracker</a></li>
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
                            <div class="submit-dash-form add-new-packages-btn">
                                <a href="<?= site_url()."/wp-admin/edit.php"?>" class="btn btn-primary">Edit Packages</a>
                            </div>
                        </div>
                    </div>
                    <div id="my-schedule" class="content-dash-body d-none">
                        <h3 class="margin-unset">Schedules</h3>
                        <div>
                            <div class="submit-dash-form add-new-schedule-btn">
                                <a href="<?= site_url()."/booking"?>" class="btn btn-primary">Add New Schedules</a>
                            </div>
                        </div>
                    </div>
                   
                    <div id="my-tracker" class="content-dash-body d-none" style="max-height: 640px;overflow: scroll;">
                    <h3 class="margin-unset">Progress System Tracker</h3>
                    <?php

                    if(is_user_logged_in()){
                        // echo "<pre>";
                        $users = get_users( array( 'fields' => array( 'ID' ) ) );
                        foreach($users as $user){
                            $progress_status = get_user_meta ( $user->ID, 'progress_btn_id', true);
                           
                                $exist_btn_array = explode(',', $progress_status);
                                $current_status = count($exist_btn_array);
                                $user_first_name = get_user_meta ( $user->ID, 'first_name', true);
                                $user_last_name = get_user_meta ( $user->ID, 'last_name', true);
                                $user_nickname = get_user_meta ( $user->ID, 'nickname', true);

                                ?>
                                <div style="margin-top: 20px; margin-bottom: 50px;">
                                <h4><b>Client Name:</b> <?php 

                                if(!empty($user_first_name) || !empty($user_last_name)){
                                   ?> <?= $user_first_name ?> <?= $user_last_name ?>
                                   <?php
                                }else{
                                    echo $user_nickname;
                                }
                                ?> </h4>
                                <h4><b>Modules Completed:</b> 
                                    <?php if(empty($progress_status)){
                                        echo "0";
                                        $progress_exist =  (0/7)*100;
                                    }else{
                                        echo $current_status;
                                        $progress_exist =  ($current_status/7)*100;
                                    }
                                    ?>/7
                                </h4>
                                <?php  ?>
                                <div class="twt_progress u_dashboard" style="width:30%;margin: 0px;">
                                    <div class="twt_bar" style='width: <?= $progress_exist ?>%'></div>
                                    <input type="hidden" name="twt_progress" value="<?= $progress_exist ?>">
                                </div>
                                </div>
                                <?php
                            
                        }

                    }

                    ?>
                </div>

                    <div id="my-details" class="content-dash-body">
                        <span id="dashboard_loader" style="display: none;">
                            <img src="<?= plugins_url('/admin-user-dashboard/assets/loader-3.gif') ?>"/>
                        </span>
                        <div class="flex">
                            <h3 class="margin-unset">Clients</h3>
                            <div class="submit-dash-form add-new-client">
                                <button class="btn-same-detail">add new client</button>
                            </div>
                            <div class="submit-dash-form back-to-listing d-none">
                                <button class="btn-same-detail">back to listing</button>
                            </div>
                        </div>
                        <div id="dashboardMessage"></div>
                        <div class="client-listing-box">
                            <?php

                            if ( ! empty( $user_query->results ) ) {
                                foreach ( $user_query->results as $user ) {
                              ?>
                                    <div class="client-name-box flex">
                                        <div class="user-client">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div class="client-text">
                                            <h3><?= $user->display_name ?></h3>
                                            <ul>
                                                <li>Member since <?= date( "d M Y", strtotime( $user->user_registered  ) )?></li>
                                                <li><?= $user->user_email ?></li>
                                                <li><?= get_user_meta($user->ID,'phone')[0] ?></li>
                                            </ul>
                                        </div>
                                        <div class="details-client">
                                            <button class="btn-same-detail" onclick="Clients.viewClientDetials(<?= $user->ID ?>)">View Details</button>
                                            <button class="btn-delete" onclick="Clients.deleteClient(<?= $user->ID ?>)">Delete</button>
                                        </div>
                                    </div>
                              <?php
                                }
                            } else {
                                echo 'No users found.';
                            }

                            ?>
                        </div>
                        <div class="signin-page client-register-page d-none">
                            <div class="fcontainer">
                                <div id="message" style="color: green"></div>
                                <form class="new-client-form" style="display: block" name="formSenda" method="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
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
                                    <button type="button" onclick="Clients.addNewClient('new-client-form')" class="btn-same-detail" name="submitSignUp">create client</button>
                                </form>
                            </div>
                        </div>
                        <div class="view-client-details-box d-none">

                        </div>

                    </div>
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

add_action('wp_ajax_submitAddNewClientForm','submitAddNewClientForm');
add_action('wp_ajax_nopriv_submitAddNewClientForm','submitAddNewClientForm');

add_action('wp_ajax_deleteClient','deleteClient');
add_action('wp_ajax_nopriv_deleteClient','deleteClient');

add_action('wp_ajax_viewClientDetials','viewClientDetials');
add_action('wp_ajax_nopriv_viewClientDetials','viewClientDetials');

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
function submitAddNewClientForm(){

    $is_have_errors = false;
    $msg ='';

    if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['fname'] )|| empty($_POST['lname'] )|| empty($_POST['password'] )|| empty($_POST['country'] )|| empty($_POST['phone_number'])){
        $msg = "Field Missing";
        $is_have_errors = true;
    }

    if($is_have_errors){
        echo json_encode(['status' => 'false', 'message' => $msg]);
        wp_die();
    }

    $userdata = array(
        'user_login'  => $_POST['username'],
        'first_name'  => $_POST['fname'],
        'last_name'   => $_POST['lname'],
        'display_name'   => $_POST['fname'].' '.$_POST['lname'],
        'user_email'  => $_POST['email'],
        'user_pass'   => $_POST['password'],

    );
    $user = wp_insert_user($userdata);
    add_user_meta($user, 'country', $_POST['country']);
    add_user_meta($user, 'phone', $_POST['phone_number']);

    $msg = "Client Created Successfully";
    echo json_encode(['status' => 'true', 'message' => $msg]);
    wp_die();

}
function deleteClient(){

    if (wp_delete_user($_POST['user_id'])) {
        echo json_encode(['status' => 'true','message'=> 'user deleted successfully']);
    } else {
        echo json_encode(['status' => 'false' ,'message'=> 'something went wrong, try again']);
    }
    wp_die();
}
function viewClientDetials(){
    ob_start();
    $user_id = $_POST['user_id'];
    $user = get_user_by('id',$user_id);

    ?>
        <div class="fcontainer">
            <div class="client-name-box-content">
                <div class="user-client">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="flex j-center">
                    <div class="client-text">
                        <p><?= $user->display_name ?></p>
                        <div class="flex">
                            <p>Member since :</p>
                            <span><?= date( "d M Y", strtotime( $user->user_registered  ) )?></span>
                        </div>
                        <div class="flex">
                            <p>Email :</p>
                            <span><?= $user->user_email ?></span>
                        </div>
                        <div class="flex">
                            <p>Phone :</p>
                            <span><?= get_user_meta($user->ID,'phone')[0] ?></span>
                        </div>
                        <div class="flex">
                            <p>Country :</p>
                            <span><?= get_user_meta($user->ID,'country')[0] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    echo ob_get_clean();
    wp_die();
}

add_filter( 'wp_nav_menu_items', 'add_extra_item_to_nav_menu', 10, 2 );
function add_extra_item_to_nav_menu( $items, $args ) {

    if (is_user_logged_in() && !current_user_can('manage_options')) {
        $items .= '<li><a href="'. site_url().'/user-dashboard'.'">User dashboard</a></li>';
    }
    if(is_user_logged_in() && current_user_can('manage_options')){
        $items .= '<li><a href="'. site_url().'/admin-dashboard'.'">Admin dashboard</a></li>';
    }
   
    return $items;
}