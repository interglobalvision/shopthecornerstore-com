<?php
get_header();
?>

<!-- main content -->
<main id="main-content">
  <div class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $slides = get_post_meta($post->ID, '_igv_slides');
?>

    <article <?php post_class('row slider-row'); ?> id="post-<?php the_ID(); ?>">

      <!-- Product details container -->
      <div class="col col-s-12 col-l-3 col-no-margin-bottom column justify-between">

        <div class="slider-product-1-details slider-product-details margin-top-basic margin-bottom-basic">

          <?php get_template_part( 'partials/product-details' ); ?>

        </div>

        <div class="slider-product-2-details slider-product-details margin-bottom-basic">

          <?php get_template_part( 'partials/product-details' ); ?>

        </div>

<?php
    if (!empty($slides)) {
      if (count($slides[0] > 1)) {
?>
        <div class="slider-pagination-holder margin-bottom-basic row align-end only-desktop">

          <div class="col col-s-4 col-no-margin-bottom col-no-gutter">
            <button class="slider-button slider-prev">
              <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/arrow_left.svg'); ?>
            </button>
          </div>
          <div class="col col-s-4 col-no-margin-bottom col-no-gutter">
            <button class="slider-button slider-next">
              <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/arrow_right.svg'); ?>
            </button>
          </div>

        </div>
<?php
      }
    }
?>

      </div>
      <!-- End Product details container -->

<?php
  if (!empty($slides)) {
    if (count($slides[0] > 1)) {
?>
          <div class="col col-s-1 col-no-gutter only-mobile row align-center justify-center">
            <button class="slider-button slider-prev">
              <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/arrow_left.svg'); ?>
            </button>
          </div>
<?php
      }
?>
        <div class="col col-s-10 col-l-9 col-no-margin-bottom">
          <!-- Slider main container -->
          <div class="swiper-container set-swiper-height">
            <div class="swiper-wrapper align-center">
            <!-- Slides -->
<?php
      foreach($slides[0] as $slide) {
        $has_product_1 = (!empty($slide['product_1']) ? true : false);
        $has_product_2 = (!empty($slide['product_2']) ? true : false);

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
      </div>
<?php
    if (count($slides[0] > 1)) {
?>
          <div class="col col-s-1 col-no-gutter only-mobile row align-center justify-center">
            <button class="slider-button slider-next">
              <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/arrow_right.svg'); ?>
            </button>
          </div>
<?php
    }
  }
?>

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