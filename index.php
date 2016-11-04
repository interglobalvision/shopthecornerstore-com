<?php
get_header();
?>

<!-- main content -->
<div id="main-content-holder">
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="posts">

<?php
if( have_posts() ) {
?>
    <div id="journal-container">
<?php
  while( have_posts() ) {
    the_post();
?>

      <article <?php post_class('journal-post col col-s-12 col-m-6'); ?> id="post-<?php the_ID(); ?>">

        <h2 class="font-post-title"><?php the_content(); ?></h2>

        <div class="font-post-content margin-bottom-tiny"><?php the_content(); ?></div>

        <div class="post-date padding-bottom-micro font-post-meta"><?php echo get_the_date('m/d/Y'); ?></div>

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
</div>

<?php
get_footer();
?>