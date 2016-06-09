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

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $slides = get_post_meta($post->ID, '_igv_slides');
    $is_recent = ($recent_id === $post->ID ? true : false);
?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<?php 
    if ($slides) {
?>

      <div class="product-details col col3">
      
        <a href="" class="js-product-title"></a>

        <div class="js-product-content">

        <span class="price js-product-price"></span>

        <a href="" class="add-to-cart js-product-cart"></a>

        <span class="sold js-sold"></span>

      </div>

      <!-- Slider main container -->
      <div class="col col9 swiper-container">
        <div class="swiper-wrapper">
          <!-- Slides -->
<?php 
      foreach($slides[0] as $slide) {
        $has_product = ($is_recent && $slide['product'] ? true : false);

        if ($has_product) {
          $product = new WC_Product($slide['product']);
          $title = $product->get_title();
          $price = $product->get_price_html();
          $in_stock = $product->check_stock_status();
          $availability = $product->get_availability();
          $cart_url = $product->add_to_cart_url();
          $cart_text = $product->single_add_to_cart_text();
        }
?>
          <div class="swiper-slide" <?php if ($has_product) {
            echo 'data-product="true"';
            echo 'data-title="' . $title . '"';
            echo 'data-price="' . htmlspecialchars($price) . '"';
            echo 'data-stock="' . $in_stock . '"';
            echo 'data-availability="' . $availability['availability'] . '"';
            echo 'data-cart-url="' . $cart_url . '"';
            echo 'data-cart_text="' . $cart_text . '"';
          } else {
            echo 'data-product="false"';
          } ?> >
            <?php echo $slide['image']?>
          </div>
<?php } ?>
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
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

  <!-- end posts -->
  </section>

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>