<?php 

function fsd_admin_menu(){
  add_menu_page( 
    "Announcement Banner Settings", // Page Title
    "Banner", // Title in Sidebar
    'edit_theme_options', // Capability needed to access
    'fsd-banner', // slug - acts as ID of the menu page
    'fsd_banner_options_page', // function to render the page
    //plugins_url('letter-u.svg', fsd_PLUGIN_FILE) // Path to custom svg icon
  );
}


function fsd_banner_options_page(){

$options = get_option('fsd_banner_options');

?>

  <!-- .wrap adds padding -->
  <div class="wrap">
    
    <h1><?php esc_html_e('Banner Settings', 'fsd-b' ); ?></h1>

    <?php

      // Check if status is 1 which means a successful options save just happened
      if(isset($_GET['status']) && $_GET['status'] == 1): ?>
        
        <div class="notice notice-success inline">
          <p>Options Saved!</p>
        </div>

      <?php endif;

    ?>

    <form novalidate="novalidate" method="POST" action="admin-post.php">

      <!-- This hidden input is required to provide the name of the function to run -->
      <input type="hidden" name="action" value="fsd_save_options" />
      <!-- The nonce field is a security feature to avoid submissions from outside WP admin -->
      <?php wp_nonce_field( 'fsd_banner_options_verify'); ?>

      <table class="form-table">
        <tbody>
          <!-- Banner BG Color -->
          <tr>
            <th>
              <label for="fsd_banner_color">
                <?php esc_html_e('Banner Background Color', 'fsd-b'); ?>
              </label>
            </th>
            <td>
              <input type="text" value="<?php echo esc_attr($options["banner_background_color"]); ?>" id="fsd_banner_color" name="fsd_banner_color" class="fsd-color-field" />
            </td>
          </tr>
          <!-- Banner Text Color -->
          <tr>
            <th>
              <label for="fsd_banner_text_color">
                <?php esc_html_e('Banner Text Color', 'fsd-b'); ?>
              </label>
            </th>
            <td>
              <input type="text" value="<?php echo esc_attr($options["banner_text_color"]); ?>" id="fsd_banner_text_color" name="fsd_banner_text_color" class="fsd-color-field" />
            </td>
          </tr>
          <!-- Banner Text -->
          <tr>
            <th>
              <label for="fsd_banner_text">
                <?php esc_html_e('Banner Text', 'fsd-b'); ?>
              </label>
            </th>
            <td>
              <input name="fsd_banner_text" type="text" id="fsd_banner_text"
                class="regular-text" 
                value="<?php echo esc_attr($options["banner_text"]); ?>"  
              />
            </td>
          </tr>
          <!-- Enable Banner -->
          <tr>
            <th>
              <?php esc_html_e('Show Banner?', 'fsd-b'); ?>
            </th>
            <td>
            <label for="fsd_enable_banner"> 
              <input name="fsd_enable_banner" type="checkbox" id="fsd_enable_banner" 
                value="1" <?php checked( '1', $options["enable_banner"] ); ?> /> 
              <span>Enable</span>
            </label>
            </td>
          </tr>

        </tbody>
      </table>

      <?php submit_button(); ?>

    </form> 
  </div>

<?php
}
