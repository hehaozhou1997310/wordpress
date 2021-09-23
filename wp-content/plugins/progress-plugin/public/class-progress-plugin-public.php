<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       kelvindavid.net
 * @since      1.0.0
 *
 * @package    Progress_Plugin
 * @subpackage Progress_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Progress_Plugin
 * @subpackage Progress_Plugin/public
 * @author     Kelvin and David <kelvindavid@gmail.com>
 */
class Progress_Plugin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Progress_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Progress_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/progress-plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Progress_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Progress_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/progress-plugin-public.js', array( 'jquery' ), $this->version, false );

	}

	public function create_shortcodes(){
		add_shortcode( 'display_btn_shortcode', array($this,'btns_shortcode_function') );
		add_shortcode( 'display_progress_shortcode', array($this,'progressBar') );
	}
	public function progressBar(){
		ob_start();
		
		if(is_user_logged_in()){
			$user_id = get_current_user_id();
			$user_meta = get_user_meta($user_id);
			$progress_exist = get_user_meta($user_id, 'progress_percent', true);
			if(empty($progress_exist)){ $progress_exist = 0; }
?>
				<div class="twt_progress">
					<div class="twt_bar" style='width: <?= $progress_exist ?>%'></div>
					<input type="hidden" name="twt_progress" value="<?= $progress_exist ?>">
				</div>				
			<?php   
		}
		
		?>

		<?php
		return ob_get_clean();
	}
	public function btns_shortcode_function($atts){

		$per = 100 / 7;

		$attributes = shortcode_atts( array(
			'id' => 'test_id',
			'title' => 'test',
		), $atts );

		ob_start();
		
		if(is_user_logged_in()){
			$bool = '';
			$user_id = get_current_user_id();
			$user_meta = get_user_meta($user_id);
			$btn_exist = get_user_meta($user_id, 'progress_btn_id', true);
			$progress_exist = get_user_meta($user_id, 'progress_percent', true);
			$exist_btn_array = explode(',', $btn_exist);
			if(in_array($attributes['id'], $exist_btn_array)){ $bool = 'disabled';}
		}
		?>
		<button class="ajax_btn twt_btn" id="<?= $attributes['id'] ?>" data-percentage="<?= $per ?>" <?= $bool ?>>
			<?= $attributes['title'] ?>
		</button>
		<?php if(empty($progress_exist)){ $progress_exist = 0; } ?>
		<input type="hidden" name="twt_progress" value="<?= $progress_exist ?>">
		<?php
			return ob_get_clean();
	}
	public function wp_footer(){
		?>
		<input type="hidden" id="ajax_url" value="<?= admin_url('admin-ajax.php') ?>"
		<?php
	}
	
	public function progress_ajax_call_action(){
		
		$id = $_GET['id'];
		$progress = $_GET['progress'];
		$response = array();
		if(is_user_logged_in()){
			$user_id = get_current_user_id();
			$user_meta = get_user_meta($user_id);
			$dismissed = array_filter( explode( ',', (string) get_user_meta( $user_id, 'progress_btn_id', true ) ) );
			$new_pointer = $id;
			if ( ! in_array( $new_pointer, $dismissed ) ) {
				$dismissed[] = $new_pointer;
				$dismissed = implode( ',', $dismissed );

				update_user_meta( $user_id, 'progress_btn_id', $dismissed );
			}

			update_user_meta( $user_id, 'progress_percent', $progress );
			
			$btn_exist = get_user_meta($user_id, 'progress_btn_id', true);
			$progress_exist = get_user_meta($user_id, 'progress_percent', true);
			if($btn_exist == $id){
				$response['status'] = 'true';
			}else{
				$response['status'] = 'false';
			}
			if($progress_exist == $progress){
				$response['progress'] = $progress_exist;
			}
		}
		$response_json = json_encode($response);
		echo $response_json;
		exit;
	}
	
}
