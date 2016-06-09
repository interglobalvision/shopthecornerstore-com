<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts" class="row">

<?php
if( have_posts() ) {
?>
    <div class="col col6">
      <ul>
<?php
  while( have_posts() ) {
    the_post();
?>

        <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

<?php
  }
?>

      </ul>
    </div>

    <div class="col col6">

<?php
  while( have_posts() ) {
    the_post();
?>

    <?php the_post_thumbnail(); ?>

<?php
  }
?>

    </div>
<?php
} else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>
    


  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>