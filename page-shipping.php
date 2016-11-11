<?php
get_header();
?>

<!-- main content -->
<div id="main-content-holder">
<main id="main-content" class="container">
  <!-- main posts loop -->
<?php
if( have_posts() ) {
  $extra_title = get_post_meta($post->ID, '_igv_shipping_extra_title', true);
  $extra_copy = get_post_meta($post->ID, '_igv_shipping_extra_copy', true);
?>
  <section id="page" class="u-flex align-center set-content-height">
    <div class="row">
      <div class="col col-s-12 col-m-6">
        <h1 class="font-product-price margin-bottom-micro"><?php the_title(); ?>:</h1>
        <?php the_content(); ?>
      </div>
      <div class="col col-s-12 col-m-6">
        <h2 class="font-product-price margin-bottom-micro"><?php if (!empty($extra_title)) {echo $extra_title;} ?>:</h2>
        <?php if (!empty($extra_copy)) {echo apply_filters('the_content', $extra_copy);} ?>
      </div>
    </div>
  </section>
<?
} else {
?>
  <div class="row">
    <article class="col col-s-12 u-alert"><?php _e('Sorry, no page matched your criteria'); ?></article>
  </div>
<?php
} ?>
<!-- end main-content -->
</main>
</div>

<?php
get_footer();
?>
