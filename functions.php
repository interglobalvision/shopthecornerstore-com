<?php

// Enqueue

function scripts_and_styles_method() {

  $templateuri = get_template_directory_uri() . '/js/';

  // library.js is to bundle plugins. my.js is your scripts. enqueue more files as needed
  $jslib = $templateuri . 'library.js';
  wp_enqueue_script( 'jslib', $jslib,'','',true);

  $myscripts = $templateuri . 'main.min.js';
  wp_register_script( 'myscripts', $myscripts );

  $is_admin = current_user_can('administrator') ? 1 : 0;

  $mailchimp = IGV_get_option('_igv_mailchimp_url');

  $jsVars = array(
  	'siteUrl' => home_url(),
  	'themeUrl' => get_template_directory_uri(),
  	'isAdmin' => $is_admin,
    'mailchimp' => !empty($mailchimp) ? $mailchimp : null,
  );

  wp_localize_script( 'myscripts', 'WP', $jsVars );
  wp_enqueue_script( 'myscripts', $myscripts,'','',true);

  // enqueue stylesheet here. file does not exist until stylus file is processed
  wp_enqueue_style( 'site', get_stylesheet_directory_uri() . '/css/site.css' );

  // dashicons for admin
  if(is_admin()){
    wp_enqueue_style( 'dashicons' );
  }

}
add_action('wp_enqueue_scripts', 'scripts_and_styles_method');


// Declare thumbnail sizes

get_template_part( 'lib/thumbnail-sizes' );


// Register Nav Menus
/*
register_nav_menus( array(
	'menu_location' => 'Location Name',
) );
*/

get_template_part( 'lib/custom-gallery' );
get_template_part( 'lib/post-types' );
get_template_part( 'lib/meta-boxes' );
get_template_part( 'lib/theme-options' );


// Add third party PHP libs

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 11 );
function cmb_initialize_cmb_meta_boxes() {
  if (!class_exists( 'cmb2_bootstrap_202' ) ) {
    require_once 'lib/CMB2/init.php';
  }

  // Add CMB2 Gallery field
  if ( ! function_exists( 'pw_gallery_field' ) ) {
    define( 'PW_GALLERY_URL', get_stylesheet_directory_uri() . '/lib/cmb-field-gallery/' );
    require_once 'lib/cmb-field-gallery/cmb-field-gallery.php';
  }
}

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

add_action( 'wp_enqueue_scripts', 'mgt_dequeue_stylesandscripts', 100 );
function mgt_dequeue_stylesandscripts() {
    if ( class_exists( 'woocommerce' ) ) {
        wp_dequeue_style( 'select2' );
        wp_deregister_style( 'select2' );

        wp_dequeue_script( 'select2');
        wp_deregister_script('select2');

    }
}

// Add custom functions

get_template_part( 'lib/functions-misc' );
get_template_part( 'lib/functions-custom' );
get_template_part( 'lib/functions-filters' );
get_template_part( 'lib/functions-hooks' );
get_template_part( 'lib/functions-utility' );

?>
