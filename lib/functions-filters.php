<?php

// Custom filters (like pre_get_posts etc)

add_filter( 'woocommerce_get_availability', 'igv_stock_text', 1, 2);
function igv_stock_text( $availability, $_product ) {

  // Change In Stock Text
  if ( $_product->is_in_stock() ) {
    $availability['availability'] = __('In stock', 'woocommerce');
  }
   
  // Change Out of Stock Text
  if ( ! $_product->is_in_stock() ) {
    $availability['availability'] = __('Sold', 'woocommerce');
  }
  return $availability;
}

// exclude most recent editorial fron archive
function exclude_recent_editorial( $query ) {
  if ( is_admin() || ! $query->is_main_query() )
    return;

  if ( $query->is_post_type_archive('editorial') ) {
    $args = array(
      'post_type' => 'editorial',
      'post_per_page' => 1,
    );
    $recent_editorial = get_posts($args);
    $recent_id = $recent_editorial[0]->ID;
    
    $query->set( 'post__not_in', array( $recent_id ) );
  }
}
add_action( 'pre_get_posts', 'exclude_recent_editorial', 1 );

function change_cart_text( $translated_text, $text, $domain ){
  if ($domain == 'woocommerce' && strpos($translated_text, 'Cart')) {
    $translated_text = str_replace('Cart', 'Basket', $translated_text);
  }
  if ($domain == 'woocommerce' && strpos($translated_text, 'cart')) {
    $translated_text = str_replace('cart', 'basket', $translated_text);
  }
  return $translated_text;
}
add_filter( 'gettext', 'change_cart_text', 10, 3 );