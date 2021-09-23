<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       kelvindavid.net
 * @since      1.0.0
 *
 * @package    Progress_Plugin
 * @subpackage Progress_Plugin/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<h2>Progress Plugin Settings</h2>
<form method="post" action="options.php">
	<?php settings_fields( 'progress-plugin-settings' ); ?>
	<?php do_settings_sections( 'progress-plugin-settings' ); 

	?>
	<h3>
		Shortcodes for Progress Bar
	</h3>	
	
	<div><span>[display_progress_shortcode]</span></div>
	
	<h3>
		Shortcodes for buttons
	</h3>	
	
	<div><span>[display_btn_shortcode id="<?= get_option('1st_btn_id') ?>" title="<?= get_option('1st_btn_text') ?>"]</span></div>

	<div><span>[display_btn_shortcode id="<?= get_option('2nd_btn_id') ?>" title="<?= get_option('2nd_btn_text') ?>"]</span></div>

	<div><span>[display_btn_shortcode id="<?= get_option('3rd_btn_id') ?>" title="<?= get_option('3rd_btn_text') ?>"]</span></div>

	<div><span>[display_btn_shortcode id="<?= get_option('4th_btn_id') ?>" title="<?= get_option('4th_btn_text') ?>"]</span></div>

	<div><span>[display_btn_shortcode id="<?= get_option('5th_btn_id') ?>" title="<?= get_option('5th_btn_text') ?>"]</span></div>

	<div><span>[display_btn_shortcode id="<?= get_option('6th_btn_id') ?>" title="<?= get_option('6th_btn_text') ?>"]</span></div>

	<div><span>[display_btn_shortcode id="<?= get_option('7th_btn_id') ?>" title="<?= get_option('7th_btn_text') ?>"]</span></div>
	<table class="form-table">
		
		<tr valign="top">
			<th scope="row">1st Button Text</th>
			<td><input type="text" name="1st_btn_text" value="<?php echo esc_attr( get_option('1st_btn_text') ); ?>" />
			</td>
			<th scope="row">1st Button ID</th>
			<td><input type="text" name="1st_btn_id" value="<?php echo esc_attr( get_option('1st_btn_id') ); ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">2nd Button Text</th>
			<td><input type="text" name="2nd_btn_text" value="<?php echo esc_attr( get_option('2nd_btn_text') ); ?>" />
			</td>
			<th scope="row">2nd Button ID</th>
			<td><input type="text" name="2nd_btn_id" value="<?php echo esc_attr( get_option('2nd_btn_id') ); ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">3rd Button Text</th>
			<td><input type="text" name="3rd_btn_text" value="<?php echo esc_attr( get_option('3rd_btn_text') ); ?>" />
			</td>
			<th scope="row">3rd Button ID</th>
			<td><input type="text" name="3rd_btn_id" value="<?php echo esc_attr( get_option('3rd_btn_id') ); ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">4th Button Text</th>
			<td><input type="text" name="4th_btn_text" value="<?php echo esc_attr( get_option('4th_btn_text') ); ?>" />
			</td>
			<th scope="row">4th Button ID</th>
			<td><input type="text" name="4th_btn_id" value="<?php echo esc_attr( get_option('4th_btn_id') ); ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">5th Button Text</th>
			<td><input type="text" name="5th_btn_text" value="<?php echo esc_attr( get_option('5th_btn_text') ); ?>" />
			</td>
			<th scope="row">5th Button ID</th>
			<td><input type="text" name="5th_btn_id" value="<?php echo esc_attr( get_option('5th_btn_id') ); ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">6th Button Text</th>
			<td><input type="text" name="6th_btn_text" value="<?php echo esc_attr( get_option('6th_btn_text') ); ?>" />
			</td>
			<th scope="row">6th Button ID</th>
			<td><input type="text" name="6th_btn_id" value="<?php echo esc_attr( get_option('6th_btn_id') ); ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">7th Button Text</th>
			<td><input type="text" name="7th_btn_text" value="<?php echo esc_attr( get_option('7th_btn_text') ); ?>" />
			</td>
			<th scope="row">7th Button ID</th>
			<td><input type="text" name="7th_btn_id" value="<?php echo esc_attr( get_option('7th_btn_id') ); ?>" />
			</td>
		</tr>
		
	</table>
	
	<?php submit_button(); ?>

</form>
