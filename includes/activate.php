<?php

function fsd_activate_plugin() {
  // Check if current version is below 5.9
  if(version_compare(get_bloginfo( 'version' ), '5.9', '<')){
    wp_die( __('You must run WP version 5.9 or higher', 'fsb-b') );
  }

  // OPTIONS SETUP
  // first check if options are already there
  $options = get_option( 'fsd_banner_options' );

  // on first activation will return false
  if(!$options){
    add_option( 'fsd_banner_options', [
      "banner_text" => "Enter your banner text here...",
      "enable_banner" => 0,
      "banner_background_color" => "#f5f5f5",
      "banner_text_color" => "#222222"
    ]);
  }
}
