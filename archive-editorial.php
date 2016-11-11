<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="posts-archive-editorial" class="row">

<?php
if( have_posts() ) {
?>
    <div class="col col-s-12 col-m-6 u-flex align-center">
      <ul id="archive-editorial-titles">
  <?php
    while( have_posts() ) {
      the_post();
  ?>

          <li class="margin-bottom-micro"><a href="<?php the_permalink() ?>" class="archive-title font-post-title" data-id="<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>

  <?php
    }
  ?>

      </ul>
    </div>

    <div id="archive-editorial-images" class="col col-s-12 col-m-6 only-desktop u-flex justify-center align-center">
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

<?php
get_footer();
?>