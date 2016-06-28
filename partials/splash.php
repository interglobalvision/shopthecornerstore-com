<div class="splash-container">
<?php
$images = IGV_get_option('_igv_splash_images');

if ($images) {
?>
  <div class="splash-swiper swiper-container">
    <div class="swiper-wrapper">
<?php
  foreach($images as $image) {
    $image_id = attachment_id_from_url($image);
    $image_url = wp_get_attachment_image_src($image_id, 'splash');
?>
      <div class="splash-slide swiper-slide" style="background-image: url(<?php echo $image_url[0]; ?>)"></div>
<?php
  } 
?>
    </div>
  </div>
<?php 
}
?>
  <header class="splash-header container">
    
<?php
  $logo_id = IGV_get_option('_igv_splash_logo_id');

  if ($logo_id) {
    $logo = wp_get_attachment_image_src($logo_id, 'splash');
?>
    <a href="<?php echo home_url(); ?>" class="splash-logo">
      <img src="<?php echo $logo[0]; ?>">
    </a>
<?php
  } else {
?>
    <h1 class="splash-logo"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
<?php } ?>
    <?php get_template_part('partials/nav'); ?>
  </header>
  <footer class="splash-footer container u-flex-center">
    &copy;<?php echo date("Y") ?> The Corner LLC. All Rights Reserved
  </footer>
</div>