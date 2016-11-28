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

// POST META

  $post_meta = new_cmb2_box( array(
    'id'           => $prefix . 'post_metabox',
    'title'        => __( 'Post options', 'cmb2' ),
    'object_types' => array( 'post', ),
  ) );

  $post_meta->add_field( array(
    'name'       => __( 'Title', 'cmb2' ),
    'desc'       => __( 'public facing post title', 'cmb2' ),
    'id'         => $prefix . 'post_title',
    'type'       => 'text',
  ) );

  $post_image_group_id = $post_meta->add_field( array(
    'id'          => $prefix . 'post_images',
    'type'        => 'group',
    'description' => __( '', 'cmb2' ),
    'options'     => array(
      'group_title'   => __( 'Image {#}', 'cmb2' ), // {#} gets replaced by row number
      'add_button'    => __( 'Add Another Image', 'cmb2' ),
      'remove_button' => __( 'Remove Image', 'cmb2' ),
      'sortable'      => true, // beta
      // 'closed'     => true, // true to have the groups closed by default
    ),
  ) );

  $post_meta->add_group_field( $post_image_group_id, array(
    'name' => __( 'Image', 'cmb2' ),
    'id'   => 'image',
    'type' => 'file',
  ) );

// EDITORIAL META

  $editorial_group = new_cmb2_box( array(
    'id'           => $prefix . 'editorial',
    'title'        => __( 'Editorial slideshow', 'cmb2' ),
    'object_types' => array( 'editorial', ),
  ) );

  $editorial_group->add_field( array(
    'name'       => __( 'Credits', 'cmb2' ),
    'desc'       => __( '', 'cmb2' ),
    'id'         => $prefix . 'credits_text',
    'type'       => 'wysiwyg',
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
    'name' => __( 'Slide Image 1', 'cmb2' ),
    'id'   => 'image_1',
    'type' => 'file',
  ) );

  $editorial_group->add_group_field( $editorial_group_field_id, array(
    'name' => __( 'Slide Image 2', 'cmb2' ),
    'id'   => 'image_2',
    'type' => 'file',
  ) );

  if ( class_exists( 'WooCommerce' ) ) {
    $editorial_group->add_group_field( $editorial_group_field_id, array(
      'name'             => __( 'Slide Product 1', 'cmb2' ),
      'desc'             => __( '', 'cmb2' ),
      'id'               => 'product_1',
      'type'             => 'select',
      'show_option_none' => true,
      'options' => get_product_options(),
    ) );

    $editorial_group->add_group_field( $editorial_group_field_id, array(
      'name'             => __( 'Slide Product 2', 'cmb2' ),
      'desc'             => __( '', 'cmb2' ),
      'id'               => 'product_2',
      'type'             => 'select',
      'show_option_none' => true,
      'options' => get_product_options(),
    ) );
  }

// PRODUCT META

  $product_group = new_cmb2_box( array(
    'id'           => $prefix . 'product_slides',
    'title'        => __( 'Product slideshow', 'cmb2' ),
    'object_types' => array( 'product', ),
  ) );

  $product_group->add_field( array(
    'name'       => __( 'Credits', 'cmb2' ),
    'desc'       => __( '', 'cmb2' ),
    'id'         => $prefix . 'credits_text',
    'type'       => 'wysiwyg',
  ) );

  // $group_field_id is the field id string, so in this case: $prefix . 'demo'
  $product_group_field_id = $product_group->add_field( array(
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

  $product_group->add_group_field( $product_group_field_id, array(
    'name' => __( 'Slide Image 1', 'cmb2' ),
    'id'   => 'image_1',
    'type' => 'file',
  ) );

  $product_group->add_group_field( $product_group_field_id, array(
    'name' => __( 'Slide Image 2', 'cmb2' ),
    'id'   => 'image_2',
    'type' => 'file',
  ) );

  $shipping_meta = new_cmb2_box( array(
    'id'           => $prefix . 'shipping_metabox',
    'title'        => __( 'Shipping page extra content', 'cmb2' ),
    'object_types' => array( 'page', ),
    'show_on'      => array( 'key' => 'id', 'value' => get_id_by_slug('shipping') ),
  ) );

  $shipping_meta->add_field( array(
    'name'       => __( 'Extra Content Title', 'cmb2' ),
    'desc'       => __( '', 'cmb2' ),
    'id'         => $prefix . 'shipping_extra_title',
    'type'       => 'text',
  ) );

  $shipping_meta->add_field( array(
    'name'       => __( 'Extra Content Copy', 'cmb2' ),
    'desc'       => __( '', 'cmb2' ),
    'id'         => $prefix . 'shipping_extra_copy',
    'type'       => 'wysiwyg',
  ) );

}
?>
