<?php

  // Output the options page
  function chatgen_options_page()
  {
    // Get options
    $options = get_option('chatgen_settings');
      
    // Check to see if chatgen is enabled
    $chatgen_activated = false;
    if (esc_attr($options['chatgen_enabled']) == "on") {
      $chatgen_activated = true;
      wp_cache_flush();
    }  
  ?>
  <div class="wrap">
    <form name="chatgen-form" action="options.php" method="post" enctype="multipart/form-data">
      <?php
        settings_fields('chatgen_settings_group');
      ?>

      <h1>Chatgen</h1>
      <h3>Basic Options</h3>
      <?php
        if (!$chatgen_activated) {
      ?>
        <div style="margin:10px auto; border:3px #f00 solid; background-color:#fdd; color:#000; padding:10px; text-align:center;">
          Chatgen is currently <strong>DISABLED</strong>.
        </div>
        <?php
          }
        ?>
        <?php
          do_settings_sections('chatgen_settings_group');
        ?>

      <table class="form-table" cellspacing="2" cellpadding="5" width="100%">
        <tr>
          <td width="20%" valign="top" style="padding-top: 10px;">
            Chatgen (Live Chat) is:
          </td>
          <td>
            <?php
              echo "<select name=\"chatgen_settings[chatgen_enabled]\"  id=\"chatgen_enabled\">\n";
    
              echo "<option value=\"on\"";
              if ($chatgen_activated) {
                echo " selected='selected'";
              }
              echo ">Enabled</option>\n";
    
              echo "<option value=\"off\"";
              if (!$chatgen_activated) {
                echo " selected='selected'";
              }
              echo ">Disabled</option>\n";
              echo "</select>\n";
            ?>
          </td>
        </tr>
        <tr>
          <td width="20%" valign="top" style="padding-top: 10px;">
              Chatgen JS code snippet:
          </td>
          <td>
            <textarea rows="15" cols="100" placeholder="<!-- Insert the chatgen tag here -->" name="chatgen_settings[chatgen_widget_code]">
              <?php
                echo esc_attr($options['chatgen_widget_code']);
              ?>
            </textarea>
            <p style="margin: 5px 10px;">Enter your Chatgen JS code snippet.  You can find your <a href="https://app.chatgen.ai/home/widget/install-chatgen" target="_blank">chatgen JS code snippet here</a>. A Chatgen account is required to use this plugin.</p>
          </td>
        </tr>
      </table>
      <p class="submit">
        <?php
          echo submit_button('Save Changes');
        ?>
      </p>
    </form>
  </div>

<?php
  }
?>