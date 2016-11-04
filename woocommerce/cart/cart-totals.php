<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
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
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

		<div class="row table-row cart-subtotal">
			<div class="col col-s-6"><?php _e( 'Subtotal', 'woocommerce' ); ?></div>
			<div class="col col-s-6" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></div>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="row table-row cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<div class="col col-s-6"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
				<div class="col col-s-6" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
			</div>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<div class="row table-row shipping">
				<div class="col col-s-6"><?php _e( 'Shipping', 'woocommerce' ); ?></div>
				<div class="col col-s-6" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></div>
			</div>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="row table-row fee">
				<div class="col col-s-6"><?php echo esc_html( $fee->name ); ?></div>
				<div class="col col-s-6" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></div>
			</div>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) :
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' <small>(' . __( 'estimated for %s', 'woocommerce' ) . ')</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
					: '';

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<div class="row table-row tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<div class="col col-s-6"><?php echo esc_html( $tax->label ) . $estimated_text; ?></div>
						<div class="col col-s-6" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="row table-row tax-total">
					<div class="col col-s-6"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></div>
					<div class="col col-s-6" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<div class="row table-row order-total">
			<div class="col col-s-6"><?php _e( 'Total', 'woocommerce' ); ?></div>
			<div class="col col-s-6" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
		</div>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	<div class="row wc-proceed-to-checkout">
		<div class="col col-s-12">
			<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
		</div>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>
