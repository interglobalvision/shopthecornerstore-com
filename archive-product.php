<?php
get_header();
?>

<!-- main content -->
<div id="main-content-holder">
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="products" class="row margin-bottom-small">
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $product = new WC_Product($post->ID);
    $in_stock = $product->is_in_stock();
    $availability = $product->get_availability();

?>
    <article <?php post_class('col col-s col-s-12 col-m col-m-6 col-l col-l-3 shop-product'); ?> id="product-<?php the_ID(); ?>">
      <a href="<?php the_permalink() ?>">
        <div class="shop-product-title-holder">
          <h3 class="shop-product-title font-serif font-italic">
            <?php the_title(); ?>
          </h3>
        </div>
        <?php if (!$in_stock) { ?>
          <span class="row align-center shop-product-sold font-uppercase">
            <img class="shop-product-sold-icon" src="<?php echo get_stylesheet_directory_uri() . '/img/dist/teardrop.svg'; ?>">
            <span class="shop-product-sold-text">&nbsp;<?php echo $availability['availability']; ?></span>
          </span>
        <?php } ?>
        <?php the_post_thumbnail('col-m-6-portrait-crop'); ?>
      </a>
    </article>
<?php
  }
} else {
?>
    <article class="col col12 u-alert"><?php _e('Sorry, no products matched your criteria :{'); ?></article>
<?php
} ?>
  </section>
  <div class="row margin-bottom-basic">
    <div class="col col12 text-align-center">
      <?php get_template_part('partials/pagination'); ?>
    </div>
  </div>

<!-- end main-content -->

</main>
</div>

<?php
get_footer();
?>
