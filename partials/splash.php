<div class="splash-container">
<?php
$splash = IGV_get_option('_igv_splash_option');
$mp4 = IGV_get_option('_igv_splash_video_mp4');
$webm = IGV_get_option('_igv_splash_video_webm');
$images = IGV_get_option('_igv_splash_images');
$color = IGV_get_option('_igv_splash_color');

if ($splash === 'video' && !empty($mp4) && !empty($webm)) {
?>
  <video muted autoplay loop id="splash-video">
    <source src="<?php echo $mp4 ?>" type="video/mp4">
    <source src="<?php echo $webm ?>" type="video/webm">
  </video>
<?php
} else if ($splash === 'images' && !empty($images)) {
?>
  <div class="splash-swiper swiper-container">
    <div class="swiper-wrapper">
<?php
  foreach($images as $id => $url) {
    $image_url = wp_get_attachment_image_src($id, 'splash');
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
        <div class="col col-s-12 col-m-8 offset-m-2 splash-logo margin-bottom-small" <?php echo !empty($color) ? 'style="fill:' . $color . ';"' : ''; ?>>
          <?php get_template_part('partials/logo'); ?>
        </div>

        <nav class="col col-s-12 col-m-8 offset-m-2 splash-nav">
          <?php get_template_part('partials/nav'); ?>
        </nav>
      </div>
    </div>
  </header>
</div>
