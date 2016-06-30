<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts" class="container">

<?php
if( have_posts() ) { 
?>
    <div class="masonry-container">
<?php
  while( have_posts() ) {
    the_post();
?>

      <article <?php post_class('masonry-item'); ?> id="post-<?php the_ID(); ?>">

        <?php the_content(); ?>

        <div class="post-date"><?php echo get_the_date(); ?></div>

      </article>

<?php
  }
?>
    </div>
    <div class="text-align-center"><a class="button js-load-more">Load More</a></div>
<?php 
} else {
?>
    <article class="u-alert masonry-item"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
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