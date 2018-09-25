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

    <div id="cart-items" class="gws-cart-items">
      <div class="row gws-cart-item padding-bottom-tiny margin-bottom-tiny">
        <div class="col col-s-1 col-m-1 row justify-center align-center">
          <div class="col col-no-gutter col-no-margin-bottom">
            <a class="gws-cart-remove u-pointer">&times;</a>
          </div>
        </div>

        <div class="col col-s-2 col-m-2 gws-cart-thumb"></div>

        <div class="col col-s-4 col-m-6 gws-cart-title"></div>

        <div class="col col-s-2 col-m-1 gws-cart-subtotal"></div>
      </div>
    </div>

    <div id="cart-empty" class="row">
      <div class="col">
        <div class="margin-bottom-small"><span>Your basket is currently empty</span><div>
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
