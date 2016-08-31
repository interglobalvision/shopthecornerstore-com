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
<div id="main-content-holder">
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
      <div class="col col-s-12 col-m-3 column justify-between">

        <div class="slider-product-details u-invisible">

          <h1 class="margin-bottom-basic"><a href="" class="js-product-title font-serif font-italic font-transform-none"></a></h1>
          <div class="js-product-content"></div>
          <div class="price font-bold font-size-h2 js-product-price"></div>

          <form class="cart" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="add-to-cart" class="js-product-id" value="" />
            <button type="submit" class="add-to-cart u-hidden js-product-button"></button>
          </form>

          <div class="sold js-product-sold"></div>

        </div>

        <div class="slider-pagination u-flex">

          <div class="button-prev u-pointer">
            <img src="<?php bloginfo('stylesheet_directory'); ?>/img/dist/prev.svg">
          </div>
          <div class="button-next u-pointer">
            <img src="<?php bloginfo('stylesheet_directory'); ?>/img/dist/next.svg">
          </div>

        </div>

      </div>
      <!-- End Product details container -->

      <div class="col col-s-12 col-m-9  set-content-height">

<?php
      } else {
?>
      <div class="col col-s-0 col-m-1 "></div>
      <div class="col col-s-12 col-m-10 ">

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
          //pr($product); die;
          $product_data = array(
            'title' => $product->get_title(),
            'id' => $product->id,
            'url' => $product->get_permalink(),
            'content' => apply_filters('the_content', $product->post->post_content),
            'price' => $product->get_price_html(),
            'stock' => $product->is_in_stock(),
            'availability' => $product->get_availability(),
            'button_text' => $product->single_add_to_cart_text(),
          );
        }
?>
            <div class="swiper-slide text-align-center u-flex align-center justify-center" <?php if ($has_product) {
              echo 'data-product="' . htmlspecialchars(json_encode($product_data)) . '"';
            } ?> >
              <?php echo wp_get_attachment_image($slide['image_id'], 'col10-square-nocrop', false, array( 'class' => '' )); ?>
            </div>
<?php } // End foreach ?>

            <!-- End Slides -->
          </div>

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
</div>

<?php
get_footer();
?>