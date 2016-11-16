<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) { ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

  <div id="customer_details">
    <div class="row table-row">
      <div class="col col-s-12">
      <?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) { ?>
        <h3><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>
      <?php } else { ?>
        <h3><?php _e( 'Billing Details', 'woocommerce' ); ?></h3>
      <?php }; ?>
      </div>
    </div>

    <div class="row table-row">
      <div class="col col-s-12 offset-s-6 margin-top-tiny"> 
        <h3 id="ship-to-different-address">
          <label for="ship-to-different-address-checkbox" class="checkbox"><?php _e( 'Ship to a different address?', 'woocommerce' ); ?></label>
          <input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
        </h3>
      </div>

      <div class="col col-s-12 col-m-6">
        <?php do_action( 'woocommerce_checkout_billing' ); ?>
      </div>

      <div class="col col-s-12 col-m-6">
        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
      </div>
    </div>

      <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

    <?php } ?>
  </div>

  <div class="row">
    <div class="col col-s-12 col-m-6 col-no-gutter col-no-margin-bottom">
      <div id="order_review_heading" class="row table-row">
        <div class="col col-s-12">
          <h3><?php _e( 'Your order', 'woocommerce' ); ?></h3>
        </div>
      </div>

      <div class="row table-row">
        <div class="col col-s-12 col-m-6">
          <h3><?php _e( 'Product', 'woocommerce' ); ?></h3>
        </div>
        <div class="col col-s-12 col-m-6">
          <h3><?php _e( 'Total', 'woocommerce' ); ?></h3>
        </div>
      </div>

    	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

    	<div id="order_review" class="woocommerce-checkout-review-order">
    		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
    	</div>

    	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
    </div>
  </div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
