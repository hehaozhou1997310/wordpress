<?php

// Create a option page for settings
add_action('admin_menu', 'add_chatgen_option_page');

// Add top-level admin bar link
add_action('admin_bar_menu', 'add_chatgen_link_to_admin_bar', 999);

// Adds chatgen link to top-level admin bar
function add_chatgen_link_to_admin_bar()
{
  global $wp_version;
  global $wp_admin_bar;

  $chatgen_icon = '<img src="' . chatgen_4f050d29b8BB9_PATH . '/assets/chatgen-icon-16x16-white.png' . '">';

  $args = array(
    'id' => 'chatgen-admin-menu',
    'title' => '<span class="ab-icon" ' . ($wp_version < 3.8 && !is_plugin_active('mp6/mp6.php') ? ' style="margin-top: 3px;"' : '') . '>' . $chatgen_icon . '</span><span class="ab-label">Chatgen</span>', // alter the title of existing node
    'parent' => FALSE,   // set parent to false to make it a top level (parent) node
    'href' => get_bloginfo('wpurl') . '/wp-admin/admin.php?page=menus.php',
    'meta' => array('title' => 'Chatgen')
  );

  $wp_admin_bar->add_node($args);
}

// Hook in the options page functionå
function add_chatgen_option_page()
{
  add_options_page('Chatgen Options', 'Chatgen', 'activate_plugins', basename(__FILE__), 'chatgen_options_page');
}

?>