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
    <div class="journal-container">
<?php
  while( have_posts() ) {
    the_post();
?>

      <article <?php post_class('journal-post col col-s-12 col-m-6'); ?> id="post-<?php the_ID(); ?>">

        <?php the_content(); ?>

        <div class="post-date padding-bottom-tiny"><?php echo get_the_date(); ?></div>

      </article>

<?php
  }
?>
    </div>
<?php 
} else {
?>
    <article class="u-alert journal-post col col-s-12"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
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