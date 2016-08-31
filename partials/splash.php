<div class="splash-container">
<?php
$images = IGV_get_option('_igv_splash_images');
$color = IGV_get_option('_igv_splash_color');

if (!empty($images)) {
?>
  <div class="splash-swiper swiper-container">
    <div class="swiper-wrapper">
<?php
  foreach($images as $image) {
    $image_url = wp_get_attachment_image_src($image, 'splash');
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
  <header class="splash-header container" <?php echo !empty($color) ? 'style="color:' . $color . ';"' : ''; ?>>
    <div class="splash-logo" <?php echo !empty($color) ? 'style="fill:' . $color . ';"' : ''; ?>>
      <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/logo.svg'); ?>
    </div>

    <nav class="splash-nav u-flex-center text-align-center">
      <?php get_template_part('partials/nav'); ?>
    </nav>
  </header>
  <footer class="splash-footer container u-flex-center" <?php echo !empty($color) ? 'style="color:' . $color . ';"' : ''; ?>>
    &copy;<?php echo date("Y") ?> The Corner LLC. All Rights Reserved
  </footer>
</div>