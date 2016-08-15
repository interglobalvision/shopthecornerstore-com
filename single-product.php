<?php
get_header();
?>

<!-- main content -->
<div id="main-content-holder">
<main id="main-content">

  <!-- main posts loop -->
  <section id="posts">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $product = new WC_Product($post->ID);
    $product_id = $product->id;
    $price = $product->get_price_html();
    $in_stock = $product->is_in_stock();
    $availability = $product->get_availability();
    $cart_text = $product->single_add_to_cart_text();
    $image_ids = $product->get_gallery_attachment_ids();
?>

    <article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">

      <div class="product-details col col3">
        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>

        <?php the_content(); ?>

        <?php echo '<span class="price">' . $price . '</span>'; ?>

      <?php if ($in_stock) { ?>

        <form class="cart" method="post" enctype='multipart/form-data'>
          <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>" />
          <button type="submit" class="add_to_cart"><?php echo esc_html( $cart_text ); ?></button>
        </form>

      <?php } else { ?>

        <span class="sold"><?php echo $availability['availability']; ?></span>

      <?php } ?>

      </div>

      <div class="product-images col col9">
        <?php
          if ($image_ids) {

            foreach($image_ids as $image_id) {
              echo wp_get_attachment_image($image_id, null, false, array( 'class' => '' ));
            }

          }
        ?>
      </div>

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

</main>
</div>

<?php
get_footer();
?>