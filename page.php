<?php
get_header();
?>

<!-- main content -->
<div id="main-content-holder">
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="page" class="row">
<?php
if( have_posts() ) {
  while( have_posts() ) {
?>
    <div class="col col-s-12">
<?php
    the_post();
    the_content();
?>
    </div>
<?
  }
} else {
?>
    <article class="col col-s-12 u-alert"><?php _e('Sorry, no page matched your criteria :{'); ?></article>
<?php
} ?>
  </section>
<!-- end main-content -->
</main>
</div>

<?php
get_footer();
?>
