<?php
get_header();
?>

<!-- main content -->
<div id="main-content-holder">
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="page">
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
    the_content();
  }
} else {
?>
    <article class="col col12 u-alert"><?php _e('Sorry, no page matched your criteria :{'); ?></article>
<?php
} ?>
  </section>
<!-- end main-content -->
</main>
</div>

<?php
get_footer();
?>
