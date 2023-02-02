<?php



function fsd_save_options(){

  // Make sure user actually has the capability to edit the options
  if(!current_user_can( 'edit_theme_options' )){
    wp_die("You do not have permission to view this page.");
  }

  // pass in the nonce ID from our form's nonce field - if the nonce fails this will kill script
  check_admin_referer( 'fsd_banner_options_verify');

  // Get the current options from DB
  $options = get_option('fsd_banner_options');

  // Update with submitted options
  // sanitization is optional, options API will do this too, but never bad idea to manually sanitize before DB anyway
  $options['banner_text'] = sanitize_text_field( $_POST['fsd_banner_text'] );
  $options['enable_banner'] = absint( $_POST['fsd_enable_banner'] );

  // Grab the color field values
  $color = sanitize_text_field( $_POST['fsd_banner_color'] );
  $text_color = sanitize_text_field( $_POST['fsd_banner_text_color'] );

  // If they are valid go ahead and update
  if(check_color($color)){
    $options['banner_background_color'] = $color;
  }

  if(check_color($text_color)){
    $options['banner_text_color'] = $text_color;
  }

  // actually trigger the update of options
  update_option(
    'fsd_banner_options',
    $options
  );

  // redirect to the admin page of our menu and add status=1 if success to display notice in the admin
  wp_redirect( admin_url( 'admin.php?page=fsd-banner&status=1' ) );
}

// Quick and dirty check for hex values - not perfect, but does the job
function check_color( $value ) { 
	if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) { // if user insert a HEX color with # 
		return true;
	}
	return false;
}