<?php
/**
 * Plugin Name:       FSD Banner
 * Plugin URI:        https://fullstackdigital.io
 * Description:       A plugin for adding blocks to a theme.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Full Stack Digital
 * Author URI:        https://fullstackdigital.io
 * Text Domain:       fsd-b
 */

if(!function_exists('add_action')) {
  echo 'Seems like you stumbled here by accident. 😛';
  exit;
}

// Setup
define('FSD_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FSD_PLUGIN_FILE', __FILE__);

// Includes
$rootFiles = glob(FSD_PLUGIN_DIR . 'includes/*.php');
$subdirectoryFiles = glob(FSD_PLUGIN_DIR . 'includes/**/*.php');
$allFiles = array_merge($rootFiles, $subdirectoryFiles);

foreach($allFiles as $filename) {
  include_once($filename);
}



// Hooks
register_activation_hook( __FILE__, 'fsd_activate_plugin' );

 // Custom menu page
add_action('admin_menu', 'fsd_admin_menu');
add_action('admin_post_fsd_save_options', 'fsd_save_options');
add_action('wp_body_open', 'fsd_render_banner');


add_action( 'admin_enqueue_scripts', 'fsd_enqueue_color_picker' );

function fsd_enqueue_color_picker( $hook_suffix ) {

  // first check that $hook_suffix is appropriate for your admin page
  if($hook_suffix == "toplevel_page_fsd-banner"){
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'fsd-b-js', plugins_url( '/scripts/color.js', __FILE__ ), array( 'wp-color-picker' ),
    false, true );
  }

}
