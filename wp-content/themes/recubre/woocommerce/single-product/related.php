<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related();

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );
	

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<?php
	
		global $single_prod_datas;
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );	
		remove_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);		
		remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
		remove_action ('woocommerce_after_shop_loop_item','add_short_content',5);
	?>

	<div class="related products">

		<h2 class="heading-title"><?php echo $related_title = sprintf( __( '%s','wpdance' ), stripslashes(esc_html($single_prod_datas['related_title'])) ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>
					
			<?php endwhile; // end of the loop. ?>
		<?php woocommerce_product_loop_end(); ?>
		<div class="clearfix"></div>
		<?php if($products->post_count >= 3) : ?>
		<div class="wd_single_related_control">
			<a class="prev" id="wd_single_related_prev" href="#">&lt;</a>
			<a class="next" id="wd_single_related_next" href="#" >&gt;</a> 
		</div>
		<?php endif; ?>
	</div>

	<?php
	
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);			
		add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );	
		add_action ('woocommerce_after_shop_loop_item','add_short_content',5);
	?>
<script type="text/javascript" language="javascript">
	//<![CDATA[
	jQuery(document).ready(function() {

		_slider_datas = {				
			responsive: true
			,width	: 240
			,height	: 'auto'
			,scroll  : {
				items	: 1,
			}
			,debug	 : true
			,auto    : false
			,swipe	: { onMouse: true, onTouch: true }	
			,items   : { 
				width		: 240
				,height		: 'auto'					
			}	
			,prev    : '#wd_single_related_prev'
			,next    : '#wd_single_related_next'
		};
		//jQuery('div.related ul.products').carouFredSel(_slider_datas);
		
		if(jQuery('div.related ul.products li').length >= 3) {	
			jQuery("div.related ul.products").after('<ul id="fooX" class="products" />').next().html(jQuery("div.related ul.products").html());
			jQuery("div.related ul.products:first li:odd").remove();
			jQuery("#fooX li:even").remove();

			jQuery("div.related ul.products:first").carouFredSel({
				synchronise	: ['#fooX', true, true]
				,responsive: true
				,width	: 240
				,height	: 'auto'
				,auto		: false
				,scroll: {
					items: 1,
					auto : false,
					pauseOnHover: true
				}
				,debug		: true
				,swipe	: { onMouse: true, onTouch: true }	
				,items   : { 
					width		: 240
					,height		: 'auto'					
				}	
			});
			
			jQuery("#fooX.products").carouFredSel({
				responsive: true
				,width	: 240
				,height	: 'auto'
				,scroll: {
					items: 1,
					auto : false,
					pauseOnHover: true
				}
				,debug		: true
				,auto		: false
				,swipe	: { onMouse: true, onTouch: true }	
				,items   : { 
					width		: 240
					,height		: 'auto'					
				}	
				//,prev    : '#wd_single_related_prev'
				//,next    : '#wd_single_related_next'
			});
			
			jQuery("#wd_single_related_prev").click(function(event) {
				event.preventDefault();
				jQuery("div.related ul.products").trigger("prev", 1);
				jQuery("#fooX").trigger("prev", 1);
			});	
			jQuery("#wd_single_related_next").click(function(event) {
				event.preventDefault();
				jQuery("div.related ul.products").trigger("next", 1);
				jQuery("#fooX").trigger("next", 1);
			});
		}	
		/*
		jQuery('window').bind('resize',jQuery.debounce( 250, function(){	
			_slider_config = get_layout_config(jQuery('.upsells.products').width(),_visible_items);
				_upsell_item_width = jQuery(window).width() < 600 ? 300 : 183;
				_slider_datas.items.width = _upsell_item_width;
				jQuery('#_upsell_ul_001').trigger('configuration ',["items.width", 300, true]);
				jQuery('#_upsell_ul_001').trigger('destroy',true);
				jQuery('#_upsell_ul_001').carouFredSel(_slider_datas);
		}));				
		*/
	});	
	//]]>	
</script>	
<?php endif;

wp_reset_postdata();
