<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="set-content-height">
  <div class="container">

  <!-- main posts loop -->
  <section id="posts">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $product = new WC_Product($post->ID);
    $product_id = $product->id;
    $slides = get_post_meta($post->ID, '_igv_slides');

?>

    <article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">

      <div class="col col-l-3 col-no-margin-bottom column justify-between">

        <div class="slider-product-details margin-top-small">

          <?php get_template_part( 'partials/product-details' ); ?>

        </div>
<?php 
    if (!empty($slides)) {
      if (count($slides[0] > 1)) {
?>
        <div class="slider-pagination-holder margin-top-small margin-bottom-basic row align-end">

          <?php get_template_part( 'partials/slider-pagination' ); ?>

        </div>
<?php 
      }
    }
?>
      </div>
<?php
  if (!empty($slides)) {
    //pr($slides); die;
?>
      <div class="col col-l-9 col-no-margin-bottom">
        <!-- Slider main container -->
        <div class="swiper-container set-swiper-height">
          <div class="swiper-wrapper align-center">
          <!-- Slides -->
<?php 
    foreach($slides[0] as $slide) {
?>
            <div class="swiper-slide text-align-center row justify-center align-center">
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
<?php
    }
?>
          <!-- End Slides -->
          </div>
        </div>
        <!-- End Slider main container -->
      </div>
<?php
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

  <!-- end posts -->
  </section>

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->
  </div>
</main>

<?php
get_footer();
?>