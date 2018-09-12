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

    $shopify_handle = get_post_meta($post->ID, '_igv_shopify_product_handle', true);
?>
    <article
      <?php post_class('col col-s col-s-12 col-sm col-sm-6 col-m col-m-6 col-ml col-ml-4 col-l col-l-3 shop-product'); ?>
      id="product-<?php the_ID(); ?>"
      <?php echo !empty($shopify_handle) ? 'data-shopify-handle="' . $shopify_handle . '"' : ''; ?>
      data-available="true"
    >
      <a href="<?php the_permalink() ?>">
        <div class="shop-product-title-holder">
          <h3 class="shop-product-title font-shop-title text-align-center">
            <?php the_title(); ?>
          </h3>
        </div>
        <span class="row align-center shop-product-sold">
          <img class="shop-product-sold-icon" src="<?php echo get_stylesheet_directory_uri() . '/img/dist/teardrop.svg'; ?>">
          <span class="shop-product-sold-text font-product-attr">&nbsp;SOLD</span>
        </span>
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
