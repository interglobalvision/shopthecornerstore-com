<?php
if (is_singular('product')) {
  $product = new WC_Product($post->ID);
  $product_data = IGV_get_product_data($product);
}
?>

<h1 class="margin-bottom-tiny font-product-title">
  <a href="" class="js-product-title js-fix-widows"><?php echo is_singular('product') ? $product_data['title'] : ''; ?></a>
</h1>
<div class="price js-product-price margin-bottom-small font-product-price <?php if (is_singular('product')) {
  echo $product_data['stock'] === true ? '' : 'u-hidden';
} ?>">
  <?php echo is_singular('product') ? $product_data['price'] : ''; ?>
</div>
<div class="sold js-product-sold margin-bottom-small font-product-price  <?php if (is_singular('product')) {
  echo $product_data['stock'] === true ? 'u-hidden' : '';
} ?>">
  <?php echo is_singular('product') ? $product_data['availability']['availability'] : ''; ?>
</div>
<div class="product-content font-product-content js-product-content padding-top-small padding-bottom-small js-fix-widows">
  <?php echo is_singular('product') ? $product_data['content'] : ''; ?>
</div>

<form class="cart margin-top-small <?php if (is_singular('product')) {
  echo $product_data['stock'] === true ? '' : 'u-hidden';
} ?>" method="post" enctype='multipart/form-data'>
  <input type="hidden" name="add-to-cart" class="js-product-id" value="<?php echo is_singular('product') ? $product_data['id'] : ''; ?>" />
  <button type="submit" class="add-to-cart button-shop <?php echo is_singular('editorial') ? 'u-hidden' : ''; ?> js-product-button"><?php echo is_singular('product') ? $product_data['button_text'] : ''; ?></button>
</form>
