<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">

  <!-- main posts loop -->
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>
  <div id="cart" class="row gws-cart">
  	<div class="col col-s-1 col-m-1 product-remove">&nbsp;</div>
  	<div class="col col-s-2 col-m-2 product-thumbnail">&nbsp;</div>
  	<div class="col col-s-4 col-m-6 product-name"><?php _e( 'Product', 'woocommerce' ); ?></div>
  	<div class="col col-s-2 col-m-1 product-price"><?php _e( 'Price', 'woocommerce' ); ?></div>
  	<div class="col col-s-1 col-m-1 product-quantity"><span class="only-desktop"><?php _e( 'Quantity', 'woocommerce' ); ?></span></div>
  	<div class="col col-s-2 col-m-1 product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></div>
  </div>
  <div class="row gws-cart-product">
    <div class="col col-s-1 col-m-1 row justify-center align-center">
      <div class="col col-no-gutter col-no-margin-bottom">
        <a class="gws-cart-remove">&times;</a>
      </div>
    </div>

    <div class="col col-s-2 col-m-2 gws-cart-thumb"></div>

    <div class="col col-s-4 col-m-6 gws-cart-name"></div>

    <div class="col col-s-2 col-m-1 gws-cart-price"></div>

    <div class="col col-s-1 col-m-1 gws-cart-quantity"></div>

    <div class="col col-s-2 col-m-1 gws-cart-subtotal"></div>
  </div>
<?php
  }
}
?>

<!-- end main-content -->
</main>

<?php
get_footer();
?>
