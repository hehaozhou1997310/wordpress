<?php

// Add the chatgen Javascript
add_action('wp_head', 'add_chatgen');

// The guts of the chatgen script
function add_chatgen()
{
  // Ignore admin, feed, robots or trackbacks
  if ( is_feed() || is_robots() || is_trackback() )
  {
    return;
  }

  $options = get_option('chatgen_settings');

  // If options is empty then exit
  if( empty( $options ) )
  {
    return;
  }

  // Check to see if chatgen is enabled
  if ( esc_attr( $options['chatgen_enabled'] ) == "on" )
  {
    $chatgen_tag = $options['chatgen_widget_code'];

    // Insert tracker code
    if ( '' != $chatgen_tag )
    {
      echo "<!-- Start Chatgen By WP-Plugin: Chatgen -->\n";
      echo $chatgen_tag;
      echo"<!-- end: Chatgen Code. -->\n";
    }
  }
}
?>