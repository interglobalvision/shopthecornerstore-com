<?php
get_header();

$args = array(
  'post_type' => 'editorial',
  'post_per_page' => 1,
);
$recent_editorial = get_posts($args);
$recent_id = $recent_editorial[0]->ID;
?>

<!-- main content -->

<main id="main-content" class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $slides = get_post_meta($post->ID, '_igv_slides');
    $is_recent = ($recent_id === $post->ID ? true : false);
?>

    <article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">

<?php
    if (!empty($slides)) {
      if ($is_recent) {
?>

      <!-- Product details container -->
      <div class="col col3">

        <div class="product-details">

          <a href="" class="js-product-title"></a>
          <div class="js-product-content"></div>
          <span class="price js-product-price"></span>

          <form class="cart" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="add-to-cart" class="js-product-id" value="" />
            <button type="submit" class="add-to-cart u-hidden js-product-button"></button>
          </form>

          <span class="sold js-product-sold"></span>

        </div>

      </div>
      <!-- End Product details container -->

      <div class="col col9">

<?php
      } else {
?>
      <div class="col col1"></div>
      <div class="col col10">

<?php } ?>

        <!-- Slider main container -->
        <div class="swiper-container">
          <div class="swiper-wrapper">
          <!-- Slides -->
<?php
      foreach($slides[0] as $slide) {
        $has_product = ($is_recent && !empty($slide['product']) ? true : false);

        if ($has_product) {
          $product = new WC_Product($slide['product']);
          $product_data = array(
            'title' => $product->get_title(),
            'id' => $product->id,
            'url' => $product->get_permalink(),
            'price' => $product->get_price_html(),
            'stock' => $product->is_in_stock(),
            'availability' => $product->get_availability(),
            'button_text' => $product->single_add_to_cart_text(),
          );
        }
?>
            <div class="swiper-slide" <?php if ($has_product) {
              echo 'data-product="' . htmlspecialchars(json_encode($product_data)) . '"';
            } ?> >
              <?php echo wp_get_attachment_image($slide['image_id'], 'col10-square-nocrop', false, array( 'class' => '' )); ?>
            </div>
<?php } // End foreach ?>

            <!-- End Slides -->
          </div>

          <div class="swiper-button-prev">prev</div>
          <div class="swiper-button-next">next</div>
        </div>
        <!-- End Slider main container -->
      </div>

<?php } ?>

    </article>

<?php
  }
} else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>