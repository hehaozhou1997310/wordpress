<?php
if(!class_exists('cLR_Plugin_Settings'))
{
	class CLR_Plugin_Settings
	{
        private $username;
        private $first_name;
        private $last_name;
        private $email;
        private $confirm_email;
        private $country;
        private $phone;
        private $password;
        private $confirm_pass;


		// Construct the plugin object
		public function __construct()
		{
			// register actions
            add_action('init', array($this, 'localize_plugin'));
        	add_action('admin_menu', array($this, 'add_menu'));

        // Add style and script
        add_action('wp_print_styles', array($this, 'clr_styles'));
        add_action('wp_print_scripts', array($this, 'clr_scripts'));

        // Create shortcode
            add_shortcode('clr_login', array($this, 'clr_login_shortcode'));
            add_shortcode('clr_register', array($this, 'clr_register_shortcode'));
        
        // ajax call
            add_action( 'wp_ajax_clr_ajaxlogin',  array($this, 'clr_custom_ajax_login' ));
            add_action( 'wp_ajax_nopriv_clr_ajaxlogin',  array($this, 'clr_custom_ajax_login' ));

            add_action( 'wp_ajax_clr_ajaxregister',  array($this, 'clr_custom_ajax_registration' ));
            add_action( 'wp_ajax_nopriv_clr_ajaxregister',  array($this, 'clr_custom_ajax_registration' ));
        
        } //END public function construct    
        
        function localize_plugin(){
            // register styles
            wp_register_style('clr_plugin_css', CLR_URL . 'css/clr-style.css', null, '1.0');
                
                // register scripts
                wp_register_script('clr_login_js', CLR_URL . 'js/clr-custom.js', array('jquery'), '1.0.0', true);
                wp_localize_script( 'clr_login_js', 'clr_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
                //wp_register_script('clr_regiter_js', CLR_URL . 'js/clr-regiter.js', array('jquery'), '1.0.0', true);
            }

        // Calling Style 
        function clr_styles() {
            wp_enqueue_style('clr_plugin_css');
            wp_enqueue_style('clr_font_css');
        }// END public function clr_styles()

        // Calling Script
        function clr_scripts() {
           wp_enqueue_script('clr_login_js');            
        }// END public function clr_scripts()   
        
        function clr_login_shortcode(){
            if (is_user_logged_in()) {
                return('Already logged in.');
            }  

            $output  = '<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
            <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>
        <div class="clr-login-from">
            <form class="forms-control" method="post" id="clr_login_form">
                <div class="col-lg-13">
                    <label class"form-control">Username</label>
                    <input type="text" name="clr_user_login" class="form-control" />
                </div>          
                 <div class="col-lg-13">
                    <label class"form-control">Password</label>
                    <input type="password" name="clr_user_password" class="form-control"  />
                </div>
                <div>
                    <label class="checkbox">
                    <input type="checkbox" name="clr_rememberme" value="true"> Remember me</label>
                </div>

                 <div>
                    <button type="primary" class="clr_login_btn btn-sm btn-success btn-block">Login</button>
                    <img src="'.CLR_URL.'/loading.gif" id="clr_loader" style="display:none;">
                </div>
                <div style="display:none" class="clr_response_msg">
                    <div class="alert"></div>
                </div>
            </form>
        </div>

         <div class="col-lg-12">
            <center>	
                <label for="text">Not rigistered?</label>
                <a href = "localhost/register-3/"><button type="submit" class="btn btn-md btn-link" name="submit">Register</button></a>
            </center>
        </div>';   
        return $output;
        }
      
        // User login code.
        function clr_custom_ajax_login(){
            if($_POST) {
                $login_data = array();
                $login_data['user_login']    = trim($_POST['username']);
                $login_data['user_password'] = $_POST['password'];
                
                if($_POST['rememberme']){
                    $login_data['remember'] = "true";
                }else{
                    $login_data['remember'] = "false";
                }

                $user_signon = wp_signon( $login_data, false );
                if ( is_wp_error($user_signon) ){
                    echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
                } else {
                    $redirectUrl = site_url()."/home";
                    echo json_encode(array('loggedin'=>true,"redirectUrl" => $redirectUrl, 'message'=>__('Login successful, redirecting...')));
                }
                die();
            }else{
                echo json_encode(array('loggedin'=>false, 'message'=>__('Invalid login details')));
                die();
            }
        }


        // Registration shortcode function
        function clr_register_shortcode(){
           
            $output  = '<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
            <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>
        <div class="clr-register-from">
            <form class="forms-control" method="post" id="clr_register_form">
                <div class="col-lg-13">
                    <label for="reg-name" class"form-control">Username <span class="req">*</span> </label>
                    <input type="text" name="reg_username" class="form-control" id="reg-username" required/>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label class"form-control">First Name </label>
                        <input type="text"  name="reg_fname" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label class"form-control">Last Name </label>
                        <input type="text" name="reg_lname" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label class="control-label">Email <span class="req" >*</span> </label>
                        <input type="email" name="reg_email" class="form-control" required/>
                    </div>
                    <div class="col-lg-6">
                        <label class="control-label">Confirm Email <span class="req">*</span> </label>
                        <input type="email" name="reg_confirm_email" class="form-control" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label class"form-control">Country</label>
                        <input type="text"  name="reg_country" class="form-control">
                    </div>
                <div>
                    <div class="col-lg-6">
                        <label class"form-control">Phone</label>
                        <input type="tel" name="reg_phone" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label class="control-label">Password <span class="req" >*</span> </label>
                        <input type="password" name="reg_password" class="form-control" required/>
                    </div>
                    <div class="col-lg-6">
                        <label class="control-label">Confirm Password <span class="req">*</span> </label>
                        <input type="password" name="reg_confirm_pass" class="form-control" required/>
                    </div>
                </div>
           
                <section>
                </br><center>
                <button type="primary" class="clr_reg_btn btn-sm btn-success btn-block">Register</button>
                <center>
                <img src="'.CLR_URL.'loading.gif" id="clr_loader" style="display:none;">
            </section>
            <section style="display:none" class="clr_response_msg">
                <div class="alert"></div>
            </section>

         </form>    
    </div> 

            <div class="col-lg-12">	
            <center>
            <label for="text">Already rigistered?</label>
            <a href = "user-dashboard"><button type="submit" class="btn btn-md btn-link" name="submit">Login</button></a>
            </center>
            </div>';               
        return $output;
        }


        // Register ajax function
        function clr_custom_ajax_registration()
        {   
            if ($_POST) {
                $this->username   = $_POST['reg_username'];
                $this->first_name = $_POST['reg_fname'];
                $this->last_name  = $_POST['reg_lname'];
                $this->email      = $_POST['reg_email'];
                $this->confirm_email      = $_POST['reg_confirm_email'];
                $this->password   = $_POST['reg_password'];
                $this->confirm_pass   = $_POST['reg_confirm _pass'];
            }

            $userdata = array(
                            'user_login'  => esc_attr($this->username),
                            'first_name'  => esc_attr($this->first_name),
                            'last_name'   => esc_attr($this->last_name),
                            'user_email'  => esc_attr($this->email),
                            'user_pass'   => esc_attr($this->password),
                            
                        );

            if (is_wp_error($this->validation())) {
                echo json_encode(array('loggedin'=>false, 'message'=> $this->validation()->get_error_message() ));
            } else {
                $register_user = wp_insert_user($userdata);
                if (!is_wp_error($register_user)) {
                    add_user_meta($register_user, 'country', $_POST['reg_country']);
                    add_user_meta($register_user, 'phone', $_POST['reg_phone']);
                    echo json_encode(array('loggedin'=>true, 'message'=> 'Registration completed.' ));
                } else {
                    echo json_encode(array('loggedin'=>false, 'message'=> $register_user->get_error_message() ));                    
                }
            }
            die();
        }

        // Recitation validations
        function validation()
        {

            if (empty($this->username) || empty($this->password) || empty($this->email)) {
                return new WP_Error('field', 'Required form field is missing.');
            }

            if (strlen($this->username) < 4) {
                return new WP_Error('username_length', 'Username too short. At least 4 characters is required.');
            }

            if (!is_email($this->email)) {
                return new WP_Error('email_invalid', 'Email is not valid');
            }

            if (email_exists($this->email)) {
                return new WP_Error('email', 'Email Already in use');
            }
            elseif  ( $this->email != $this->confirm_email) {
                return new WP_Error('email', 'The two emails are inconsistent');
           }

            if (strlen($this->password) < 6) {
                return new WP_Error('password', 'Password length must be greater than 6.');
            }
                /* elseif ( $this->password != $this->confirm_pass) {
                return new WP_Error('password_error', 'The two passwords are inconsistent'); 
            }  */
            
            $details = array(
                            'Username'   => $this->username,
                            'First Name' => $this->first_name,
                            'Last Name'  => $this->last_name,
                        );

            foreach ($details as $field => $detail) {
                if (!validate_username($detail)) {
                    return new WP_Error('name_invalid', 'Sorry, the "' . $field . '" you entered is not valid');
                }
            }
        }
        
        // add a menu	
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
            add_options_page(
               'Custom Login Register Settings', 
               'CRL Settings', 
               'manage_options', 
               'clr_plugin_setting', 
               array(&$this, 'clr_plugin_settings_page')
           );
        } // END public function add_menu()}
     
        // Menu Callback
        public function clr_plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have permissions to access this page.'));
        	}

            echo "1. Add a shortcode in login page.";
            echo "<h2> [clr_login] </h2>";
            echo "<br/><br/>";

            echo "2. Add a shortcode in register page.";
            echo "<h2> [clr_register] </h2>";

	
        	// Render the settings template
        	//include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class SLR_Plugin_Settings
} // END if(!class_exists('SLR_Plugin_Settings'))
