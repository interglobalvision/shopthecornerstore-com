<?php

// Custom functions (like special queries, etc)

function IGV_get_product_data($product) {
  $attr_list = '';
  
  if ($product->get_attributes()) {
    $attributes = $product->get_attributes();
    foreach ($attributes as $attribute) {
      $attr_list .= '<li>' . $attribute['name'] . ' ' . $attribute['value'] . '</li>';
    }
  }

  $product_data = array(
    'title' => $product->get_title(),
    'id' => $product->id,
    'url' => $product->get_permalink(),
    'content' => apply_filters('the_content', $product->post->post_content),
    'attributes' => $attr_list,
    'price' => $product->get_price_html(),
    'stock' => $product->is_in_stock(),
    'availability' => $product->get_availability(),
    'button_text' => $product->single_add_to_cart_text(),
  );

  return $product_data;
}