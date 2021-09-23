<?php
/**
* Plugin Name: Custom User Comments
* Plugin URI: 
* Description: User comments completed packages.
* Version: 1.0
* Author: Haozhou He
**/

add_action('save_post', 'user_edit_pending_reviews');

function user_edit_pending_reviews($post_id) {
 
    if (empty($post_id)) {
        return;
    }
 
    $post = get_post($post_id);
    if (!is_object($post)) { 
        return;
    }
 
    if ($post->post_type=='revision') {
       return;
    }
 
    $current_user = wp_get_current_user();    
    if (in_array('contributor', $current_user->roles) && $post->post_status=='publish') {
        $my_post = array(
            'ID' => $post_id,
            'page_status' => 'pending',
        );
 
        remove_action('save_post', 'user_edit_pending_reviews');
        wp_update_post($my_post);
        add_action('save_post', 'user_edit_pending_reviews');
    }
}