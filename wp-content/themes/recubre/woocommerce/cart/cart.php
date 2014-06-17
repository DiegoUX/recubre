<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages();
?>

<?php do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-thumbnail first"><?php _e( 'Items', 'wpdance' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'wpdance' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'wpdance' ); ?></th>
			<th class="product-subtotal last"><?php _e( 'Total', 'wpdance' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
					<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">

						<!-- The thumbnail -->
						<td class="product-thumbnail product-name">
							<?php
								$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );
								echo '<div class="wd_product_item">';
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo $thumbnail;
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							//Remove from cart link
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'wpdance' ) ), $cart_item_key );
								echo '</div>';
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

								// Meta data
								echo $woocommerce->cart->get_item_data( $values );

                   				// Backorder notification
                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
                   					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'wpdance' ) . '</p>';
							
								echo '<p class="wd_product_number">'.apply_filters( 'woocommerce_checkout_item_quantity', '<strong class="product-quantity">&times; ' . $values['quantity'] . '</strong>', $values, $cart_item_key ).'</p>';
								echo '<p class="wd_product_excerpt">'.substr($_product->post->post_excerpt,0,60).'</p>';
							?>
						

						<!-- Product Name -->
								
						</td>

						<!-- Product price -->
						<td class="product-price">
							<?php
								$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

								echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
							?>
						</td>

						<!-- Quantity inputs -->
						<td class="product-quantity">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {

									$step	= apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
									$min 	= apply_filters( 'woocommerce_quantity_input_min', '', $_product );
									$max 	= apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );

									$product_quantity = sprintf( '<div class="quantity"><input type="number" name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" size="4" title="' . _x( 'Qty', 'Product quantity input tooltip', 'wpdance' ) . '" class="input-text qty text" maxlength="12" /></div>', $cart_item_key, $step, $min, $max, esc_attr( $values['quantity'] ) );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
						</td>

						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
							?>
						</td>
						
										
						
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">

			<input type="submit" class="button" name="update_cart" value="<?php _e( 'Update Cart', 'wpdance' ); ?>" /> 
			
			<p><a class="button" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e( '&larr; Return To Shop', 'wpdance' ) ?></a></p>
			<!--<input type="submit" class="checkout-button button alt" name="proceed" value="<?php //_e( 'Proceed to Checkout', 'wpdance' ); ?>" /> -->
			<?php do_action('woocommerce_proceed_to_checkout'); ?>

			<?php $woocommerce->nonce_field('cart') ?>	
			
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">

	<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">	
		<div class="coupon_wrapper">
		
				<?php if ( $woocommerce->cart->coupons_enabled() ) { ?>
					<div class="coupon">

						<label for="coupon_code"><?php _e( 'Coupon', 'wpdance' ); ?>:</label> 
						<p><?php _e( 'Enter your coupon code if your have one', 'wpdance' ); ?></p>
						<input name="coupon_code" class="input-text" id="coupon_code" value="" /> 
						<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'wpdance' ); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>

		</div>
	</form>
	
	<?php woocommerce_shipping_calculator(); ?>	
	
	<?php woocommerce_cart_totals(); ?>

	<?php do_action('woocommerce_cart_collaterals'); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>