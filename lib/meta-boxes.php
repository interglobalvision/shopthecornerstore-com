<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */

  $editorial_group = new_cmb2_box( array(
    'id'           => $prefix . 'editorial',
    'title'        => __( 'Editorial slideshow', 'cmb2' ),
    'object_types' => array( 'editorial', ),
  ) );

  // $group_field_id is the field id string, so in this case: $prefix . 'demo'
  $editorial_group_field_id = $editorial_group->add_field( array(
    'id'          => $prefix . 'slides',
    'type'        => 'group',
    'description' => __( '', 'cmb2' ),
    'options'     => array(
      'group_title'   => __( 'Slide {#}', 'cmb2' ), // {#} gets replaced by row number
      'add_button'    => __( 'Add Another Slide', 'cmb2' ),
      'remove_button' => __( 'Remove Slide', 'cmb2' ),
      'sortable'      => true, // beta
      // 'closed'     => true, // true to have the groups closed by default
    ),
  ) );

  $editorial_group->add_group_field( $editorial_group_field_id, array(
    'name' => __( 'Slide Image', 'cmb2' ),
    'id'   => 'image',
    'type' => 'file',
  ) );

  if ( class_exists( 'WooCommerce' ) ) {
    $editorial_group->add_group_field( $editorial_group_field_id, array(
      'name'             => __( 'Slide Product', 'cmb2' ),
      'desc'             => __( '', 'cmb2' ),
      'id'               => 'product',
      'type'             => 'select',
      'show_option_none' => true,
      'options' => get_product_options(),
    ) );
  }

}
?>
