<?php

// Register settings
function chatgen_register_settings()
{
  register_setting( 'chatgen_settings_group', 'chatgen_settings' );
}
add_action( 'admin_init', 'chatgen_register_settings' );

// Delete options on uninstall
function chatgen_uninstall()
{
  delete_option( 'chatgen_settings' );
}
register_uninstall_hook( __FILE__, 'chatgen_uninstall' );


?>
