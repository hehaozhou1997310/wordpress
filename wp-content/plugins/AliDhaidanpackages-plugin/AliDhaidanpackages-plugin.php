<?php
/**
* @package PackagesPlugin
*/
/*
Plugin Name: AliDhaidanpackages plugin
Plugin URI: http://AliDhaidanpackages.com
Description:This is my first attempt in writing a custom plugin.
Version: 1.0.0
Author: Ali Dhaidan
Author URI: http://AliDhaidanpackages.com
License: GPLv2 or later
Text Domain: AliDhaidanpackages-plugin

*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

defined('ABSPATH') or die( 'You do not have authorised access to this file!');

class AliDhaidanPackages
{
    // Public
    // can be accessed everywhere

    // Protected
    // can be access only within the class itself

    // Private
    

    function __construct() {
      add_action( 'init', array( $this,'custom_post_type') );
    }

    function register( ) {
      add_action('admin_enqueue_scripts', array( $this, 'enqueue'));
    }

    function activate() {
      // generate a CPT
      $this->custom_post_type();
      // flush rewrite rules
      flush_rewrite_rules();
    }

    function deactivate() {
      //flush rewrite rules
      flush_rewrite_rules();
    }


    function custom_post_type() {
      register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
    }

    function enqueue() {
      // enqueue all our scripts
      wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css',__FILE__));
      wp_enqueue_style('mypluginstyle', plugins_url('/assets/myscript.js ',__FILE__));

    }
}

if (class_exists( 'AliDhaidanPackages')) {
  $alidhaidanPackages = new AliDhaidanPackages();
  $alidhaidanPackages->register();
}

// activation
register_activation_hook( __FILE__, array( $alidhaidanPackages, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array( $alidhaidanPackages, 'deactivate' ) );
