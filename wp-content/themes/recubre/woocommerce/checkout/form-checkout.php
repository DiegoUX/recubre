<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );
?>
<div class="after_checkout_form">
	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
	<?php do_action( 'wd_after_checkout_form', $checkout ); ?>
</div>
<?php 
// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'wpdance' ) );
	return;
}

$_user_logged = is_user_logged_in();
$_counter = 1;

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<?php $id = 'multitabs_'.rand();?>
	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
		<div class='wd_tabs_checkout'  id='<?php echo $id; ?>'>
			<ul id="<?php echo $id; ?>_inside" class="wd-tabs nav nav-tabs">
				<?php if(!$_user_logged):?>
					<li class="<?php echo $id; ?> active"><a id="li_<?php echo $id;?>_inside0" href="#<?php echo $id; ?>_inside0"><?php _e("CHECKOUT METHOD",'wpdance'); ?></a></li>
				<?php endif;?>
				<li class="<?php echo $id; ?>"><a id="li_<?php echo $id;?>_inside1" href="#<?php echo $id;?>_inside1"><?php _e("BILLING ADDRESS",'wpdance'); ?></a></li>
				<li class="<?php echo $id; ?>"><a id="li_<?php echo $id;?>_inside2" href="#<?php echo $id;?>_inside2"><?php _e("SHIPPING ADDRESS",'wpdance'); ?></a></li>
				<li class="<?php echo $id; ?>"><a id="li_<?php echo $id;?>_inside3" href="#<?php echo $id;?>_inside3"><?php _e("YOUR ORDER",'wpdance'); ?></a></li>
			</ul>
			<div id="<?php echo $id; ?>_insideContent" class="wd_tab-content">
			<?php if(!$_user_logged):?>
				<div id="<?php echo $id; ?>_inside0" class="wd_checkout_method wd_tab-pane active">
					<div class="span12 register-form">
						<h4 class="heading-title"><?php _e('New Customer','wpdance');?></h4>
						<div class="">
						
						<?php if( $checkout->enable_guest_checkout ): ?>		
							<label><input type="radio" class="wd_checkout-method" name="checkout-method" checked="checked" value="guest"><?php _e('Check out a Guest','wpdance');?></label>
						<?php endif;?>		
						
						<?php if( $checkout->enable_signup ): ?>		
							<label><input type="radio" class="wd_checkout-method" name="checkout-method" <?php if( $checkout->enable_signup && !$checkout->enable_guest_checkout ){ echo "checked"; } ?> value="account"><?php _e('Register','wpdance');?></label>						
						<?php endif;?>
						
						</div>
						<div>
							<p><?php _e('Register with us for future convenience','wpdance');?>:</p>
							<p><span class="register_add_icon"></span><?php _e('Fast and easy checkout','wpdance');?></p>
							<p><span class="register_add_icon"></span><?php _e('Easy access to your order history and status','wpdance');?></p>
						</div>
						<input type="button" value="<?php _e( "Continue","wpdance" );?>" name="button_create_account_continue" class="button_create_account_continue button next_co_btn" rel="<?php echo $id;?>_inside1">
					</div>
					<div class="span12 login-form">	
						<h4 class="heading-title"><?php _e('Login','wpdance');?></h4>
						<?php woocommerce_checkout_login_form(); ?>
						
					</div>

				</div>
			<?php endif;?>				
				<form name="checkout" method="post" class="checkout checkout-resgister" action="<?php echo esc_url( $get_checkout_url ); ?>">
					
					<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>
						<div class="wd_create_account span12" style="display:none;">
							<h3 id="order_review_heading" class="heading-title checkout-title"><?php _e("Create an account",'wpdance'); ?></h3>
							<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>
									<?php if ( $checkout->enable_guest_checkout ) : ?>
										<p class="form-row form-row-wide create-account">
											<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'wpdance' ); ?></label>
										</p>
									<?php endif; ?>
									<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>
									<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>	
										<div class="create-account">
											<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>
												<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
											<?php endforeach; ?>
											<div class="clear"></div>
										</div>
									<?php endif; ?>	
									<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
							<?php endif; ?>	
							<?php $woocommerce->nonce_field('register', 'register') ?>
							<input type="button" value="<?php _e( "Continue","wpdance" );?>" name="button_billing_address_continue" class="button_billing_address_continue button next_co_btn" rel="<?php echo $id;?>_inside1">
						</div>
					<?php endif; ?>
					
					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
					<div id="<?php echo $id; ?>_inside1" class="wd_billing_address wd_tab-pane">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
						<input type="button" value="<?php _e( "Continue","wpdance" );?>" name="button_shipping_address_continue" class="button_shipping_address_continue button next_co_btn" rel="<?php echo $id;?>_inside2">
					</div>
					<div id="<?php echo $id; ?>_inside2" class="wd_shipping_address wd_tab-pane">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
						<input type="button" value="<?php _e( "Continue","wpdance" );?>" name="button_review_order_continue" class="button_review_order_continue button next_co_btn" rel="<?php echo $id;?>_inside3">
					</div>
					<div id="<?php echo $id; ?>_inside3" class="wd_order_review wd_tab-pane">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>
				</form>
			</div>
		
			</div>
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

