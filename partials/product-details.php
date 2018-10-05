<h1 class="margin-bottom-tiny font-product-title">
  <a href="" class="js-product-title js-fix-widows"><?php the_title(); ?></a>
</h1>
<div class="price shop-product-price margin-bottom-small font-product-price">$<span class=" gws-product-price"></span></div>
<div class="sold shop-product-sold shopify-product-sold margin-bottom-small font-product-price">Sold</div>
<div class="product-content font-product-content js-product-content padding-top-small padding-bottom-small js-fix-widows"><?php the_content(); ?></div>

<form class="gws-product-form cart margin-top-small" method="post" enctype='multipart/form-data'>
  <input type="hidden" name="variant-id" class="gws-variant-id" value="" />
  <button type="submit" class="gws-product-add add-to-cart button js-product-button">Add to Basket</button>
</form>
