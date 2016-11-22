<?php
get_header();
?>

<!-- main content -->
<main id="main-content">
  <div class="container">

  <!-- main posts loop -->
  <section id="posts">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $nextPost = get_adjacent_post(null, null, true);
    $prevPost = get_adjacent_post(null, null, false);

    $nextLink = $nextPost ? get_permalink($nextPost->ID) : false;
    $prevLink = $prevPost ? get_permalink($prevPost->ID) : false;

    $product = new WC_Product($post->ID);
    $product_id = $product->id;
    $slides = get_post_meta($post->ID, '_igv_slides');
?>

    <article <?php post_class('row slider-row'); ?> id="post-<?php the_ID(); ?>">

      <div class="col col-s-12 col-l-3 col-no-margin-bottom column justify-between">

        <div class="slider-product-details margin-top-basic margin-bottom-basic">

          <?php get_template_part( 'partials/product-details' ); ?>

        </div>
<?php 
    if (!empty($slides)) {
      if (count($slides[0] > 1)) {
?>
        <div class="slider-pagination-holder margin-bottom-basic row align-end only-desktop">

          <div class="col col-s-4 col-no-margin-bottom col-no-gutter">
            <a class="slider-button slider-prev" <?php echo $prevLink ? 'href="' . $prevLink . '"' : ''; ?>>
              <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/arrow_left.svg'); ?>
            </a>
          </div>
          <div class="col col-s-4 col-no-margin-bottom col-no-gutter">
            <a class="slider-button slider-next" <?php echo $nextLink ? 'href="' . $nextLink . '"' : ''; ?>>
              <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/arrow_right.svg'); ?>
            </a>
          </div>

        </div>
<?php 
      }
    }
?>
      </div>
<?php
  if (!empty($slides)) {
    if (count($slides[0] > 1)) {
?>
          <div class="col col-s-1 col-no-gutter only-mobile row align-center justify-center">
            <a class="slider-button slider-prev" <?php echo $prevLink ? 'href="' . $prevLink . '"' : ''; ?>>
              <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/arrow_left.svg'); ?>
            </a>
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
    if (count($slides[0] > 1)) {
?>
          <div class="col col-s-1 col-no-gutter only-mobile row align-center justify-center">
            <a class="slider-button slider-next" <?php echo $nextLink ? 'href="' . $nextLink . '"' : ''; ?>>
              <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/arrow_right.svg'); ?>
            </a>
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

  <!-- end posts -->
  </section>

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->
  </div>
</main>

<?php
get_footer();
?>