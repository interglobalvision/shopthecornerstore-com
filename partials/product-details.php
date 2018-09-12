<h1 class="margin-bottom-tiny font-product-title">
  <a href="" class="js-product-title js-fix-widows"><?php the_title(); ?></a>
</h1>
<div class="price shopify-product-price margin-bottom-small font-product-price"></div>
<div class="sold shopify-product-sold margin-bottom-small font-product-price"></div>
<div class="product-content font-product-content js-product-content padding-top-small padding-bottom-small js-fix-widows"><?php the_content(); ?></div>

<form class="cart margin-top-small" method="post" enctype='multipart/form-data'>
  <input type="hidden" name="add-to-cart" class="shopify-product-id" value="" />
  <button type="submit" class="add-to-cart button-shop js-product-button">Add to Basket</button>
</form>
