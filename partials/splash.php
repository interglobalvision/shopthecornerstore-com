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
  <header class="splash-header" <?php echo !empty($color) ? 'style="color:' . $color . ';"' : ''; ?>>
    <div class="container">
      <div class="row">
        <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" class="col col-s-12 col-m-8 offset-m-2 splash-logo" <?php echo !empty($color) ? 'style="fill:' . $color . ';"' : ''; ?>>
          <?php echo '<img src="' . get_bloginfo('stylesheet_directory') . '/img/dist/logo_white.svg">'; ?>
        </a>

        <nav class="col col-s-12 col-m-8 offset-m-2 splash-nav">
          <?php get_template_part('partials/nav'); ?>
        </nav>
      </div>
    </div>
  </header>
</div>