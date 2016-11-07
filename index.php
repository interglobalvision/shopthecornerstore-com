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

    $images = get_post_meta($post->ID, '_igv_post_images', true);
?>

      <article <?php post_class('journal-post col'); ?> id="post-<?php the_ID(); ?>">

<?php 
    if (!empty($images)) {

      foreach($images as $image) {
        echo wp_get_attachment_image($image['image_id'], 'col-s-12-nocrop', false, array('class'=>'post-image margin-bottom-tiny'));
      }

    }

    $title = get_the_title();
    if (!empty($title)) {
?>
        <h2 class="font-post-title margin-bottom-tiny"><?php echo $title; ?></h2>
<?php 
    } 
    
    $content = get_the_content();
    if (!empty($content)) {
?>
        <div class="font-post-content margin-bottom-tiny"><?php echo $content; ?></div>
<?php 
    } 
?>
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