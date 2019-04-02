<?php
/* Template Name: Stacey Nishimoto Catalog */

get_header();
?>

<!-- main content -->
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="products-stacey-nishimoto" class="margin-bottom-tiny row slider-row justify-center">
<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args_shop_query = array(
	'post_type' => array('product'),
	'post_status' => array('publish'),
	'order' => 'DESC',
	'tax_query' => array(
		array(
			'taxonomy' => 'line',
			'field' => 'slug',
			'terms' => array('stacey-nishimoto'),
			'operator' => 'IN',
		),
	),
);

$shop_query = new WP_Query( $args_shop_query );

if ( $shop_query->have_posts() ) {
?>
    <div class="col col-s-1 col-no-gutter row align-center justify-center">
      <a class="slider-button swiper-prev u-pointer">
        <?php echo '<img src="'. get_bloginfo('stylesheet_directory') . '/img/dist/catalog_arrow_left.svg">'; ?>
      </a>
    </div>
    <div class="col col-s-10 col-l-9 col-no-margin-bottom">
      <!-- Slider main container -->
      <div class="swiper-container set-swiper-height">
        <div class="swiper-wrapper align-center">
<?php
	while ( $shop_query->have_posts() ) {
		$shop_query->the_post();

    $slide_url = get_post_meta($post->ID, '_igv_product_sn_slide_image', true);

    if (!empty($slide_url) && attachment_url_to_postid($slide_url)) {

      $slide_image = wp_get_attachment_image(attachment_url_to_postid($slide_url), 'col10-square-nocrop', false, array( 'class' => '' ));

    } else {

      $slide_image = get_the_post_thumbnail($post->ID, 'col10-square-nocrop');

    }
?>
          <article
            <?php post_class('swiper-slide text-align-center row justify-center align-center'); ?>
            id="product-<?php the_ID(); ?>"
          >
            <a href="<?php the_permalink() ?>" class="col col-s-12 col-no-margin-bottom slide-column justify-center align-center">
              <?php echo $slide_image; ?>
            </a>
          </article>
<?php
  }
?>
        </div>
      </div>
    </div>
    <div class="col col-s-1 col-no-gutter row align-center justify-center">
      <a class="slider-button swiper-next u-pointer">
        <?php echo '<img src="'. get_bloginfo('stylesheet_directory') . '/img/dist/catalog_arrow_right.svg">'; ?>
      </a>
    </div>
<?php
}
?>
  </section>

<?php wp_reset_postdata(); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
