<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="products" class="row margin-bottom-tiny">
<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args_shop_query = array(
	'post_type' => array('product'),
	'post_status' => array('published'),
	'order' => 'DESC',
  'paged' => $paged,
	'tax_query' => array(
		array(
			'taxonomy' => 'line',
			'field' => 'slug',
			'terms' => array('stacey-nishimoto'),
			'operator' => 'NOT IN',
		),
	),
);

$shop_query = new WP_Query( $args_shop_query );

if ( $shop_query->have_posts() ) {
	while ( $shop_query->have_posts() ) {
		$shop_query->the_post();

    $shopify_handle = get_post_meta($post->ID, '_gws_product_handle', true);
?>
    <article
      <?php post_class('col col-s col-s-12 col-sm col-sm-6 col-m col-m-6 col-ml col-ml-4 col-l col-l-3 shop-product gws-product margin-bottom-small'); ?>
      id="product-<?php the_ID(); ?>"
      <?php echo !empty($shopify_handle) ? 'data-gws-product-handle="' . $shopify_handle . '"' : ''; ?>
      data-gws-available="true"
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
}
?>
  </section>

<?php include( locate_template( 'partials/pagination.php', false, false ) ); ?>

<?php wp_reset_postdata(); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
