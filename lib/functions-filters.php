<?php

// Custom filters (like pre_get_posts etc)

add_filter( 'woocommerce_get_availability', 'igv_outofstock_text', 1, 2);
function igv_outofstock_text( $availability, $_product ) {
   
  // Change Out of Stock Text
  if ( ! $_product->is_in_stock() ) {
    $availability['availability'] = __('Sold', 'woocommerce');
  }
  return $availability;
}