<?php 
if (is_singular('product')) {
  $product = new WC_Product($post->ID);
  $product_data = IGV_get_product_data($product);
}
?>

<h1 class="margin-bottom-small font-product-title">
  <a href="" class="js-product-title"><?php echo is_singular('product') ? $product_data['title'] : ''; ?></a>
</h1>
<div class="product-content font-product-content js-product-content"><?php echo is_singular('product') ? $product_data['content'] : ''; ?></div>
<ul class="attributes js-product-attributes margin-top-micro font-product-attr">
  <?php echo is_singular('product') ? $product_data['attributes'] : ''; ?>
</ul>

<div class="price js-product-price margin-top-small font-product-price <?php if (is_singular('product')) {
  echo $product_data['stock'] === true ? '' : 'u-hidden'; 
} ?>">
  <?php echo is_singular('product') ? $product_data['price'] : ''; ?>
</div>

<form class="cart margin-top-tiny <?php if (is_singular('product')) {
  echo $product_data['stock'] === true ? '' : 'u-hidden'; 
} ?>" method="post" enctype='multipart/form-data'>
  <input type="hidden" name="add-to-cart" class="js-product-id" value="" />
  <button type="submit" class="add-to-cart u-hidden js-product-button"><?php echo is_singular('product') ? $product_data['button_text'] : ''; ?></button>
</form>

<div class="sold js-product-sold margin-top-tiny font-product-price  <?php if (is_singular('product')) {
  echo $product_data['stock'] === true ? 'u-hidden' : ''; 
} ?>">
  <?php echo is_singular('product') ? $product_data['availability']['availability'] : ''; ?>
</div>