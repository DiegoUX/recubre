<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);


$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<?php global $single_prod_datas; ?>

	<div class="upsells products">

		<h2 class="heading-title"><?php echo $_upsell_title = sprintf( __( '%s','wpdance' ), stripslashes(esc_attr($single_prod_datas['upsell_title'])) ); ?></h2>

		<div class="upsell_wrapper">
		
			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<div class="upsell_control">
				<a id="product_upsell_prev" class="prev" href="#">&lt;</a>
				<a id="product_upsell_next" class="next" href="#">&gt;</a>
			</div>				
			
		</div>
		
		<?php
			$_post_count = count($products->posts);
			$_post_count = $_post_count > 4 ? 4 : $_post_count;
		
		?>
		
		<script type="text/javascript" language="javascript">
		//<![CDATA[
			function get_layout_config( container_width, number_item){
				ret_value = new Array(183,'100%');
				//alert(container_width);
				//ret_value[0] = container_width / number_item;
				//return ret_value;
				if( container_width >= 1000 ){
					//var _num_show = Math.max(number_item,5);
					ret_value[1] = "100%";
					return ret_value;
				}
				if( container_width >= 900 ){
					var _num_show = Math.min(number_item,5);
					ret_value[1] = _num_show*20 + "%";
					return ret_value;
				}
				if( container_width > 600 && container_width < 900 ){
					var _num_show = Math.min(number_item,4);
					ret_value[0] = 230;
					ret_value[1] = _num_show*25 + "%";
					return ret_value;
				}
				if( container_width <= 500 && container_width > 400 ){
					ret_value[0] = 300;
					var _num_show = Math.min(number_item,2);
					ret_value[1] = _num_show*50 + "%";
					return ret_value;
				}
				ret_value[0] = 300;
				return ret_value;
			}
			
			jQuery(document).ready(function() {
				var _visible_items = <?php echo $_post_count; ?>;
				var _slider_config = get_layout_config(jQuery('.upsells.products').width(),_visible_items);
				_upsell_item_width = _slider_config[0];
				_container_width = _slider_config[1];

				_slider_datas = {				
					responsive: true
					,width	: '100%'//_container_width
					,height	: 'auto'
					,scroll	: 1
					,swipe	: { onMouse: true, onTouch: true }	
					,items	: {
						width		: _upsell_item_width
						,height		: 'auto'	//	optionally resize item-height
						,visible	: {
							min		: 1
							,max	: 5
						}
					}
					,auto	: false
					,prev	: '#product_upsell_prev'
					,next	: '#product_upsell_next'								
				};
				jQuery('.upsell_wrapper > ul > li.first').removeClass('first');
				jQuery('.upsell_wrapper > ul > li.last').removeClass('last');
				jQuery('.upsell_wrapper > ul').eq(0).attr('id','_upsell_ul_001');
				jQuery('#_upsell_ul_001').carouFredSel(_slider_datas);	
				
				jQuery('window').bind('resize',jQuery.debounce( 250, function(){	
					_slider_config = get_layout_config(jQuery('.upsells.products').width(),_visible_items);
						_upsell_item_width = jQuery(window).width() < 600 ? 300 : 183;
						_slider_datas.items.width = _upsell_item_width;
						jQuery('#_upsell_ul_001').trigger('configuration ',["items.width", 300, true]);
						jQuery('#_upsell_ul_001').trigger('destroy',true);
						jQuery('#_upsell_ul_001').carouFredSel(_slider_datas);
				}));				
				
			});	
		//]]>	
		</script>		
		
	</div>

<?php endif;
wp_reset_postdata();
