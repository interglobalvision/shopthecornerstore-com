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
  <div class="gws-cart">
    <div id="cart-header" class="row font-nav margin-bottom-tiny">
    	<div class="col col-s-12 text-align-center padding-bottom-small">BASKET</div>
    </div>

    <div id="cart-body">
      <div id="cart-items" class="gws-cart-items">
        <div class="row gws-cart-item padding-bottom-tiny margin-bottom-tiny align-center">
          <div class="col text-align-center">
            <a class="gws-cart-remove u-pointer">&times;</a>
          </div>

          <div class="col"><div class="gws-cart-thumb"></div></div>

          <div class="col flex-grow gws-cart-title"></div>

          <div class="col text-align-right">$ <span class="gws-cart-item-subtotal"></span></div>
        </div>
      </div>

      <div id="cart-footer" class="row padding-top-tiny text-align-right">
        <div class="col col-s-12 padding-bottom-small">
          SUBTOTAL: $ <span id="gws-cart-subtotal"></span>
        </div>
        <div class="col col-s-12 padding-bottom-small">
          <a href="" class="button gws-checkout-link">Proceed to Checkout</a>
        </div>
      </div>
    </div>

    <div id="cart-empty" class="row padding-top-tiny justify-center">
      <div class="col text-align-center">
        <div class="margin-bottom-small">
          <span>Your basket is currently empty</span>
        </div>
        <a class="button" href="<?php echo home_url('shop'); ?>">Return To Shop </a>
      </div>
    </div>
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
