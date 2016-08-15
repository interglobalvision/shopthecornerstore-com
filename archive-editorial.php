<?php
get_header();
?>

<!-- main content -->
<div id="main-content-holder">
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="posts-archive-editorial" class="row justify-center align-center">

<?php
if( have_posts() ) {
?>
    <div class="col col-s-12 col-m-6">
      <ul id="archive-editorial-titles">
<?php
  while( have_posts() ) {
    the_post();
?>

        <li><a href="<?php the_permalink() ?>" class="archive-title" data-id="<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>

<?php
  }
?>

      </ul>
    </div>

    <div class="col col-s-12 col-m-6 text-align-center">

<?php
  while( have_posts() ) {
    the_post();
?>

    <?php the_post_thumbnail( 'col6-square-nocrop', array('data-id' => $post->ID, 'class' => 'archive-editorial-image') ); ?>

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
</div>

<?php
get_footer();
?>