<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts" class="row">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $product = new WC_Product($post->ID);
    $in_stock = $product->is_in_stock();
    $availability = $product->get_availability();
?>

    <article <?php post_class('col col3'); ?> id="post-<?php the_ID(); ?>">

      <?php if (!$in_stock) { ?>
      <span class="sold"><?php echo $availability['availability']; ?></span>
      <?php } ?>

      <?php the_post_thumbnail(); ?>

      <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>

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