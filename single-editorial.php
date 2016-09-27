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
<main id="main-content" class="set-content-height">
  <div class="container">

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
      <div class="col col-l-3 col-no-margin-bottom column justify-between">

        <div class="slider-product-1-details slider-product-details margin-top-small">

          <?php get_template_part( 'partials/product-details' ); ?>

        </div>

        <div class="slider-product-2-details slider-product-details margin-top-small">

          <?php get_template_part( 'partials/product-details' ); ?>

        </div>

        <div class="slider-pagination-holder margin-top-small margin-bottom-basic row align-end">

          <?php get_template_part( 'partials/slider-pagination' ); ?>

        </div>

      </div>
      <!-- End Product details container -->

<?php
      }
?>
      <div class="col col-l-9 col-no-margin-bottom">

          <!-- Slider main container -->
          <div class="swiper-container set-swiper-height">
            <div class="swiper-wrapper align-center">
            <!-- Slides -->
<?php
      foreach($slides[0] as $slide) {
        $has_product_1 = ($is_recent && !empty($slide['product_1']) ? true : false);
        $has_product_2 = ($is_recent && !empty($slide['product_2']) ? true : false);

        if ($has_product_1) {
          $product = new WC_Product($slide['product_1']);
          $product_1_data = IGV_get_product_data($product);
        }

        if ($has_product_2) {
          $product = new WC_Product($slide['product_2']);
          $product_2_data = IGV_get_product_data($product);
        }
?>
              <div class="swiper-slide text-align-center row justify-center align-center" <?php if ($has_product_1) {
                echo 'data-product-1="' . htmlspecialchars(json_encode($product_1_data)) . '"'; } if ($has_product_2) {
                echo 'data-product-2="' . htmlspecialchars(json_encode($product_2_data)) . '"';
              } ?>>
                <?php 
                  if (!empty($slide['image_1_id'])) {
                ?>
                <div class="col <?php echo !empty($slide['image_2_id']) ? 'col-s-6' : 'col-s-12'; ?> col-no-margin-bottom slide-column justify-center align-center">
                  <?php echo wp_get_attachment_image($slide['image_1_id'], 'col10-square-nocrop', false, array( 'class' => '' )); ?>
                </div>
                <?php 
                  }
                  if (!empty($slide['image_2_id'])) {
                ?>
                <div class="col <?php echo !empty($slide['image_1_id']) ? 'col-s-6' : 'col-s-12'; ?> col-no-margin-bottom slide-column justify-center align-center">
                  <?php echo wp_get_attachment_image($slide['image_2_id'], 'col10-square-nocrop', false, array( 'class' => '' )); ?>
                </div>
                <?php 
                  }
                ?>
              </div>
<?php } // End foreach ?>

              <!-- End Slides -->
            </div>
          </div>
          <!-- End Slider main container -->
<?php } ?>

      </div>

    </article>

<?php
  }
} else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>

<!-- end main-content -->
  </div>
</main>

<?php
get_footer();
?>