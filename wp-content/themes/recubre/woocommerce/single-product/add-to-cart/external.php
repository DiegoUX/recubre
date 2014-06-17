<?php
/**
 * External product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php do_action('woocommerce_before_add_to_cart_button'); ?>

<?php global $single_prod_datas;
		$_layout_config = explode("-",$single_prod_datas['layout']);
		$_left_sidebar = $_right_sidebar = '';
		if(isset($_layout_config[0])) {
			$_left_sidebar = (int)$_layout_config[0];
		}	
		if(isset($_layout_config[2])) {
			$_right_sidebar = (int)$_layout_config[2];
		}
		if($_left_sidebar || $_right_sidebar) {
			$temp_class= 'visible-phone';
		}
?>
<!--<p class="cart"><a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button alt visible-phone"><?php echo apply_filters('single_add_to_cart_text',$button_text, 'external'); ?></a></p>-->
<p class="cart"><a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button alt <?php echo $temp_class; ?>"><?php echo $button_text; ?></a></p>

<?php do_action('woocommerce_after_add_to_cart_button'); ?>