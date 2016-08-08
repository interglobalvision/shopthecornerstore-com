<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="products" class="container">
    <div class="row margin-bottom-small">
<?php
if( have_posts() ) {
  $i = 0;
  while( have_posts() ) {
    the_post();

    $product = new WC_Product($post->ID);
    $in_stock = $product->is_in_stock();
    $availability = $product->get_availability();

    if ($i % 4 === 0 && $i !== 0) {
      echo '</div>\n<div class="row margin-bottom-small">';
    }
?>
    <article <?php post_class('col col3 shop-product'); ?> id="product-<?php the_ID(); ?>">
      <a href="<?php the_permalink() ?>">
        <div class="shop-product-title-holder">
          <h3 class="shop-product-title font-serif font-italic">
            <?php the_title(); ?>
          </h3>
        </div>
        <?php if (!$in_stock) { ?>
          <span class="shop-product-sold font-uppercase"><?php echo $availability['availability']; ?></span>
        <?php } ?>
        <?php the_post_thumbnail('col3-portrait-crop'); ?>
      </a>
    </article>
<?php
    $i++;
  }
} else {
?>
    <article class="col col12 u-alert"><?php _e('Sorry, no products matched your criteria :{'); ?></article>
<?php
} ?>
    </div>
    <div class="row margin-bottom-basic">
      <div class="col col12 text-align-center">
        <?php get_template_part('partials/pagination'); ?>
      </div>
    </div>
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
