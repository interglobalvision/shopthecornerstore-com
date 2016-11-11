<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="products" class="row margin-bottom-tiny">
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
          <h3 class="shop-product-title font-shop-title text-align-center">
            <?php the_title(); ?>
          </h3>
        </div>
        <?php if (!$in_stock) { ?>
          <span class="row align-center shop-product-sold">
            <img class="shop-product-sold-icon" src="<?php echo get_stylesheet_directory_uri() . '/img/dist/teardrop.svg'; ?>">
            <span class="shop-product-sold-text font-product-attr">&nbsp;<?php echo $availability['availability']; ?></span>
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

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
