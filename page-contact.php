<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">
  <!-- main posts loop -->
<?php
if( have_posts() ) {
?>
  <section id="page">
    <div class="row">
      <div class="col col-s-12 col-m-6">
        <h1 class="font-product-price margin-bottom-micro"><?php the_title(); ?>:</h1>
        <?php the_content(); ?>
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

<?php
get_footer();
?>
