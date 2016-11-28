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

    $firstPost = false;
    $lastPost = false;
    $nextPost = false;
    $prevPost = false;

    $ordering  = WC()->query->get_catalog_ordering_args();

    $nextPosts = get_posts( array(
      'numberposts'   => -1,
      'order'           => 'ASC',
      'orderby'         => $ordering['orderby'],
      'post_type'       => 'product'
    ));

    if (count($nextPosts) > 1) {
      $firstPost = $nextPosts[0];

      $n = false;

      foreach ($nextPosts as $p) {
        $product = new WC_Product($p->ID);
        
        if ($product->is_visible()) {
          if ($n) {
            // assign this post as the next
            $nextPost = $p;
            break;
          } elseif ($p->ID === $post->ID) {
            // assign the next post
            $n = true;
          } else {
            // not there yet, keep going
            $n = false;
          }
        }
      }

      if ($nextPost) {
        $nextLink = get_permalink($nextPost->ID);
      } elseif ($firstPost) {
        $nextLink = get_permalink($firstPost->ID);
      } else {
        $nextLink = false;
      }

    } else {
      $nextLink = false;
    }

    $prevPosts = get_posts( array(
      'numberposts'   => -1,
      'order'           => 'DESC',
      'orderby'         => $ordering['orderby'],
      'post_type'       => 'product'
    ));

    if (count($prevPosts) > 1) {
      $lastPost = $prevPosts[0];

      $n = false;

      foreach ($prevPosts as $p) {
        $product = new WC_Product($p->ID);
        
        if ($product->is_visible()) {
          if ($n) {
            // assign this post as the previous
            $prevPost = $p;
            break;
          } elseif ($p->ID === $post->ID) {
            // assign the next post
            $n = true;
          } else {
            // not there yet, keep going
            $n = false;
          }
        }
      }

      if ($prevPost) {
        $prevLink = get_permalink($prevPost->ID);
      } elseif ($lastPost) {
        $prevLink = get_permalink($lastPost->ID);
      } else {
        $prevLink = false;
      }
    } else {
      $prevLink = false;
    }


    $product = new WC_Product($post->ID);
    $product_id = $product->id;
    $slides = get_post_meta($post->ID, '_igv_slides');
    $credits = get_post_meta($post->ID, '_igv_credits_text', true);
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

    if (!empty($credits)) {
?> 
            <div class="swiper-slide text-align-center row justify-center align-center">
              <div class="col col-s-12 col-no-margin-bottom slide-column justify-center">
                <?php echo apply_filters('the_content', $credits); ?>
              </div>
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