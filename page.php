<?php
get_header();
?>

<!-- main content -->
<div id="main-content-holder">
<main id="main-content" class="container">

  <!-- main posts loop -->
<?php
if( have_posts() ) {
  while( have_posts() ) {

    the_post();
    the_content();

  }
} else {
?>
  <section id="page" class="row">

    <article class="col col-s-12 u-alert"><?php _e('Sorry, no page matched your criteria :{'); ?></article>

  </section>
<?php
} ?>

<!-- end main-content -->
</main>
</div>

<?php
get_footer();
?>
