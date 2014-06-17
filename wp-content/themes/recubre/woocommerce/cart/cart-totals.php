<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

//$available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>
<div class="cart_totals <?php if ( $woocommerce->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
	<h2><?php _e( 'ORDER TOTAL', 'wpdance' ); ?></h2>

	<table cellspacing="0">
		<tbody>

			<tr class="cart-subtotal">
				<th><strong><?php _e( 'Subtotal', 'wpdance' ); ?></strong></th>
				<td><strong><?php echo $woocommerce->cart->get_cart_subtotal(); ?></strong></td>
			</tr>

			<?php foreach ( WC()->cart->get_coupons( 'cart' ) as $code => $coupon ) : ?>
				<tr class="discount">
					<th><?php _e( 'Cart Discount', 'wpdance' ); ?> <a href="<?php echo add_query_arg( 'remove_discounts', '1', $woocommerce->cart->get_cart_url() ) ?>"><?php _e( '[Remove]', 'wpdance' ); ?></a></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>
			
			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

				<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

			<?php endif; ?>
			
			<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<tr class="fee fee-<?php echo $fee->id ?>">
					<th><?php echo esc_html( $fee->name ); ?></th>
					<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
				</tr>
			<?php endforeach; ?>
			
			<?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
				<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
					<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
						<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
							<th><?php echo esc_html( $tax->label ); ?></th>
							<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr class="tax-total">
						<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
						<td><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
				<tr class="discount coupon-<?php echo esc_attr( $code ); ?>">
					<th><?php _e( 'Order Discount', 'wpdance' ); ?> <?php echo esc_html( $code ); ?></th>
					<td><?php if ( is_string( $coupon ) )
							$coupon = new WC_Coupon( $coupon );

						$value  = array();

						if ( ! empty( WC()->cart->coupon_discount_amounts[ $coupon->code ] ) ) {
							$discount_html = '<span class="wd_sub_sign">-</span>' . wc_price( WC()->cart->coupon_discount_amounts[ $coupon->code ] );
						} else {
							$discount_html = '';
						}

						$value[] = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_html, $coupon );

						if ( $coupon->enable_free_shipping() )
							$value[] = __( 'Free shipping coupon', 'wpdance' );

						$value = implode( ', ', $value ) . ' <a href="' . add_query_arg( 'remove_coupon', $coupon->code, WC()->cart->get_cart_url() ) . '" class="woocommerce-remove-coupon">' . __( '[Remove]', 'wpdance' ) . '</a>';

						echo apply_filters( 'woocommerce_cart_totals_coupon_html', $value, $coupon ); 
					?></td>
				</tr>
			<?php endforeach; ?>

			<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
			
			<tr class="order-total">
				<th><strong><?php _e( 'GrandTotal', 'wpdance' ); ?></strong></th>
				<td><?php wc_cart_totals_order_total_html(); ?></td>
			</tr>
			<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

		</tbody>
	</table>
	<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
		<input type="submit" class="checkout-button button alt" name="proceed" value="<?php _e( 'Proceed to Checkout', 'wpdance' ); ?>" />		
		<?php $woocommerce->nonce_field('cart') ?>
	</form>
	
	<?php if ( WC()->cart->get_cart_tax() ) : ?>
		<p><small><?php

			$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
				? sprintf( ' ' . __( ' (taxes estimated for %s)', 'wpdance' ), WC()->countries->estimated_for_prefix() . __( WC()->countries->countries[ WC()->countries->get_base_country() ], 'wpdance' ) )
				: '';

			printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'wpdance' ), $estimated_text );

		?></small></p>
	<?php endif; ?>
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>