<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $product = new WC_Product($post->ID);
    $price = $product->get_price_html();
    $in_stock = $product->is_in_stock();
    $availability = $product->get_availability();
    $cart_url = $product->add_to_cart_url();
    $cart_text = $product->single_add_to_cart_text();
    $images = $product->get_gallery_attachment_ids();
?>

    <article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">

      <div class="col col3">
        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>

        <?php the_content(); ?>

        <?php echo $price; ?>

        <?php if ($in_stock) { ?>

        <a href="<?php echo $cart_url; ?>"><?php echo $cart_text; ?></a>

        <?php } else { ?>

        <span class="sold"><?php echo $availability['availability']; ?></span>

        <?php } ?>

      </div>

      <div class="col col9">
        <?php 
          if ($images) {

            foreach($images as $image) {
              echo $image;
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

<?php
get_footer();
?>