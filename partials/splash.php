<?php
$images = IGV_get_option('_igv_splash_images');

if ($images) {
?>
<div class="splash-container swiper-container">
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