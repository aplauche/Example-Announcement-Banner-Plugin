<?php 
function fsd_render_banner(){

$options = get_option( 'fsd_banner_options' );

if(!$options["enable_banner"]){
  // Bail out and do nothing if not enabled within options
  return;
}

// We escape our value from the database to be on the safe side
$content = esc_html( $options['banner_text'] );
$bg_color = esc_attr( $options['banner_background_color'] );
$text_color = esc_attr( $options['banner_text_color'] );

?>

<style>
  .fsd-banner {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background: <?php echo $bg_color; ?>;
    color: <?php echo $text_color; ?>;
  }
</style>

<div class="wp-site-blocks fsd-banner">
  <?php echo $content; ?>
</div> 

<?php
}