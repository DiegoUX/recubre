<?php
/**
 * @package WordPress
 * @subpackage Roedok
 * @since WD_Responsive
 */

//remove default hook
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'wd_list_template_loop_add_to_cart', 10 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
//add sale,featured and off save label
add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
//add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart', 10 );
//add sku to list first
add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
add_action ('woocommerce_after_shop_loop_item','add_short_content',5);
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 6 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
add_action ('woocommerce_after_shop_loop_item','close_div_style',10000);



remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );			
add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );	

//add_action( 'woocommerce_single_product_summary', 'wd_template_single_review', 7 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_summary', 'wd_template_single_mail', 15 );
//add_action( 'woocommerce_single_product_summary', 'wd_template_single_content', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 31 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );	
add_action( 'woocommerce_after_single_product_summary', 'wd_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'wd_after_single_product_summary', 'wd_output_related_products', 9 );

add_action( 'wd_single_product_summary_end', 'woocommerce_template_single_sharing', 11 );
add_action( 'wd_single_product_summary_end', 'wd_template_single_availability', 12 );
add_action( 'wd_single_product_summary_end', 'wd_template_single_sku', 13 );	
add_action( 'wd_single_product_summary_end', 'wd_template_single_rating', 14);
add_action( 'wd_single_product_summary_end', 'ppbv_display_product', 15);
add_action( 'wd_single_product_summary_end', 'button_add_to_card', 16);
add_action( 'wd_single_product_summary_end', 'get_product_categories', 17);
add_action( 'wd_single_product_summary_end', 'product_tags_template', 18);

//add_action( 'woocommerce_review_order_before_submit', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_after_checkout_form', 'wd_checkout_add_on_js', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'wd_after_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_before_checkout_registration_form', 'wd_checkout_fields_form', 10 );

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'wd_before_main_content', 'dimox_shop_breadcrumbs', 10, 0 );
add_action( 'woocommerce_product_thumbnails', 'wd_template_shipping_return', 30 );

add_filter( "single_add_to_cart_text", "update_add_to_cart_text", 10, 1 );
add_filter('loop_shop_columns', 'loop_columns');
//add new tab to prod page
add_filter( 'woocommerce_product_tabs', 'wd_addon_product_tabs',13 );
add_filter('woocommerce_widget_cart_product_title','add_sku_after_title',100000000000000000000000000000,2);
add_filter( 'woocommerce_product_tabs', 'wd_addon_custom_tabs',12 );

//custom hook
function wd_list_template_loop_add_to_cart(){
	echo "<div class='list_add_to_cart'>";
	woocommerce_template_loop_add_to_cart();
	echo "</div>";
}

function add_short_content(){
	global $product;
	$content =  strip_tags ( get_the_content($product) ) ;
	$rs = '';
	$rs .= '<div class="product_short_content">';
	$rs .= substr($content,0,60);
	$rs .= '</div>';
	echo $rs;
}
function get_product_categories(){
	global $product;
	$rs = '';
	$rs .= '<div class="wd_product_categories">';
	$product_categories = wp_get_post_terms(get_the_ID($product),'product_cat');
	$count = count($product_categories);
	if ( $count > 0 ){
		foreach ( $product_categories as $term ) {
		$rs.= '<a href="'.get_term_link($term->slug,$term->taxonomy).'">'.$term->name . "</a>, ";

		}
		$rs = substr($rs,0,-2);
	}
	$rs .= '</div>';
	echo $rs;
}




function wd_template_loop_product_thumbnail(){
	/*global $product,$post;
	$_prod_galleries = $product->get_gallery_attachment_ids( );
	echo "<div class='product-image-front'>";
	echo woocommerce_get_product_thumbnail();
	echo '</div>';
	if( is_array($_prod_galleries) && count($_prod_galleries) > 0 ){
		echo "<div class='product-image-back'>";
		echo wp_get_attachment_image( $_prod_galleries[0],'shop_catalog' );
		echo '</div>';
	}*/
	global $product,$post;
	$_prod_galleries = $product->get_gallery_attachment_ids( );
	
	$_front_classes = "product-image-front";
	if ( !has_post_thumbnail() ){
		$_front_classes = $_front_classes . " default-thumb";
	}	
	
	echo "<div class='{$_front_classes}'>";
	echo woocommerce_get_product_thumbnail();
	echo '</div>';
	if( is_array($_prod_galleries) && count($_prod_galleries) > 0 ){
		echo "<div class='product-image-back'>";
		echo wp_get_attachment_image( $_prod_galleries[0],'shop_catalog' );
		echo '</div>';
	}
}


//open a div to wrap all product meta
function open_div_style(){
	echo "<div class=\"product-meta-wrapper\">";
}
//close div product meta wrapper
function close_div_style(){
	echo "</div>";
}

function add_product_title(){
	global $post, $product,$product_datas;
	$_uri = esc_url(get_permalink($post->ID));
	echo "<h3 class=\"heading-title product-title\">";
	echo "<a href='{$_uri}'>". esc_attr(get_the_title()) ."</a>";
	echo "</h3>";
}


function add_label_to_product_list(){
	global $post, $product,$product_datas;
	echo '<div class="product_label">';
	if ($product->is_on_sale()){ 
		if( $product->regular_price > 0 ){
			$_off_percent = (1 - round($product->get_price() / $product->regular_price, 2))*100;
			$_off_price = round($product->regular_price - $product->get_price(), 0);
			$_price_symbol = get_woocommerce_currency_symbol();
			echo "<span class=\"onsale show_off product_label\">".__( 'Sale','wpdance' )."<span class=\"off_number\">{$_price_symbol}{$_off_price}</span></span>";	
		}else{
			echo "<span class=\"onsale product_label\">".__( 'Sale','wpdance' )."</span>";
		}
	}
	if ($product->is_featured()){
		echo "<span class=\"featured product_label\">".__( 'Featured','wpdance' )."</span>";
	}
	echo "</div>";
}

function add_sku_to_product_list(){
	global $product, $woocommerce_loop;
	echo "<span class=\"product_sku\">" . esc_attr($product->get_sku()) . "</span>";
}


function wd_template_loop_product_big_thumbnail(){
	global $product,$post;	
	?>
		<div class="product-image-big-layout">
			<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail('prod_midium_thumb_1',array('class' => 'big_layout')); 
				} 				
			?>
		</div>		
	<?php	
}


function custom_product_thumbnail(){
	global $product,$post;
	$thumb = get_post_thumbnail_id($post->ID);
	$_prod_galleries = $product->get_gallery_attachment_ids( );					
	?>
		<div class="product-image-front">			
			<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail('prod_midium_thumb_2',array('class' => 'big_layout') ); 
				} 				 
			?>
		</div>		
	<?php
		if( is_array($_prod_galleries) && count($_prod_galleries) > 0 ):
			$_image_src = wp_get_attachment_image_src( $_prod_galleries[0],'full' );
	?>	
			<div class="product-image-back">
				<?php 
					echo wp_get_attachment_image( $_prod_galleries[0], 'prod_midium_thumb_2', false, array('class' => 'big_layout') );
					//print_thumbnail($_image_src[0],true,get_the_title($post->ID), 366, 360,'big_layout');
				?>
			</div>
	<?php		
		endif;
	?>	
	<?php					
}
	


function add_sku_after_title($title,$product){
	$prod_uri = "<a href='".get_permalink( $product->id )."'>";
	$_sku_string = "</a>{$prod_uri}<span class=\"product_sku\">{$product->get_sku()}</span>";
	return $title.$_sku_string;
}




function wd_addon_product_tabs( $tabs = array() ){
		global $product, $post,$single_prod_datas;
		// Description tab - shows product content
		if ( $post->post_excerpt )
			$tabs['description'] = array(
				'title'    => __( 'Description', 'wpdance' ),
				'priority' => 10,
				'callback' => 'woocommerce_product_description_tab'
			);

		
		// Reviews tab - shows comments
		if ( comments_open() && $single_prod_datas['show_review'] )
			$tabs['reviews'] = array(
				'title'    => sprintf( __( 'Reviews (%d)', 'wpdance' ), get_comments_number( $post->ID ) ),
				'priority' => 90,
				'callback' => 'comments_template'
			);

		$tabs['tags'] = array(
				'title'    => sprintf( __( 'Product Tags', 'wpdance' ) ),
				'priority' => 80,
				'callback' => 'product_tags_template'
		);			
		if ( $product->has_attributes() || ( get_option( 'woocommerce_enable_dimension_product_attributes' ) == 'yes' && ( $product->has_dimensions() || $product->has_weight() ) ) )
			$tabs['additional_information'] = array(
				'title'    => __( 'Additional Information', 'wpdance' ),
				'priority' => 20,
				'callback' => 'woocommerce_product_additional_information_tab'
			);	
		return $tabs;
}

function wd_addon_custom_tabs ( $tabs = array() ){
	global $single_prod_datas;
	if($single_prod_datas['show_custom_tab']) {
		$tabs['wd_custom'] = array(
			'title'    =>  sprintf( __( '%s','wpdance' ), stripslashes(esc_html($single_prod_datas['custom_tab_title'])) )
			,'priority' => 200
			,'callback' => "print_custom_tabs"
		);
		return $tabs; 
	}
}

function print_custom_tabs(){
	global $single_prod_datas;
	echo stripslashes(htmlspecialchars_decode($single_prod_datas['custom_tab_content']));
}


function product_tags_template(){
	global $product, $post;
	$_terms = wp_get_post_terms( $product->id, 'product_tag');
	
	echo '<div class="tagcloud">';
	
	$_include_tags = '';
	if( count($_terms) > 0 ){
		echo '<span class="tag_heading">Tags:</span>';
		foreach( $_terms as $index => $_term ){
			$_include_tags .= ( $index == 0 ? "{$_term->term_id}" : ",{$_term->term_id}" ) ;
		}
		wp_tag_cloud( array('taxonomy' => 'product_tag', 'include' => $_include_tags ) );
	}
	
	echo "</div>\n";	
	
}

/// end new tabs




function wd_template_single_review(){
	global $product;

	if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
		return;		
		
	if ( $rating_html = $product->get_rating_html() ) {
		echo "<div class=\"review_wrapper\">";
		echo $rating_html; 
		echo '<span class="review_count">'.$product->get_rating_count()," ";
		_e("Review(s)",'wpdance');
		echo "</span>";
		echo '<span class="add_new_review"><a href="#review_form" class="inline show_review_form" title="Review for '. esc_attr($product->get_title()) .' ">' . __( 'Add Your Review', 'wpdance' ) . '</a></span>';
		echo "</div>";
	}else{
		echo '<p><span class="add_new_review"><a href="#review_form" class="inline show_review_form" title="Review for '. esc_attr($product->get_title()) .' ">' . __( 'Be the first to review this product', 'wpdance' ) . '</a></span></p>';

	}

	
}

function wd_template_single_mail() {
	echo '<a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site '.site_url().'" title="Share by Email">
				'.__('Email to a Friend','wpdance').'
			</a>';
}
function wd_template_single_content() {
	global $product;
	echo '<div class="wd_product_content">';
	echo get_the_content($product->ID);
	echo '</div>';
}



function wd_template_shipping_return(){
	global $single_prod_datas;
?>
	<div class="return-shipping">
        <div class="title-quick">
            <h6 class="title-quickshop">
				<?php 
					echo $title = sprintf( __( '%s','wpdance' ), stripslashes(esc_attr($single_prod_datas['ship_return_title'])) );
				?>
			</h6>
        </div>
        <div class="content-quick">
            <?php echo stripslashes(htmlspecialchars_decode($single_prod_datas['ship_return_content']));?>
        </div>
	</div>
<?php
}



	function wd_output_related_products() {
		woocommerce_related_products( 5, 5 );
	}



function wd_template_single_availability(){
	global $product;
	$_product_stock = get_product_availability($product);
?>	
	<p class="availability stock <?php echo esc_attr($_product_stock['class']);?>"><?php _e('Availability','wpdance');?>: <span><?php echo esc_attr($_product_stock['availability']);?></span></p>	
<?php	
	
}	


function wd_template_single_sku(){
	global $product, $post;
	echo "<p class='wd_product_sku'>SKU: <span class=\"product_sku\">" . esc_attr($product->get_sku()) . "</span></p>";
}

function wd_template_single_rating(){
	global $product, $post;
	echo $product->get_rating_html();
}



function button_add_to_card(){
	global $single_prod_datas,$product,$post;
	
	$_layout_config = explode("-",$single_prod_datas['layout']);
	$_left_sidebar = (int)$_layout_config[0];
	$_right_sidebar = (int)$_layout_config[2];
	$temp_class = '';
	if($product->product_type !== 'grouped' ){
		if($_left_sidebar || $_right_sidebar) {
			if($product->product_type == 'variable') { 
				$temp_class= ' variable_hidden';
			}
			if($product->product_type == 'external') { ?>
				<!--<p class="cart"><a href="<?php echo esc_url($product->get_product_url()); ?>" rel="nofollow" class="single_add_to_cart_button button alt hidden-phone"><?php echo apply_filters('single_add_to_cart_text',$product->get_button_text(), 'external'); ?></a></p>-->
				<p class="cart"><a href="<?php echo esc_url($product->get_product_url()); ?>" rel="nofollow" class="single_add_to_cart_button button alt hidden-phone"><?php echo $product->get_button_text(); ?></a></p>
			<?php  } else {
				echo '<button type="button" class="virtual single_add_to_cart_button button alt hidden-phone'.$temp_class.'">';
				echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'wpdance' ), $product->product_type); 
				echo '</button>';
			}
		}	
	} else {
		$wd_quantities = false;
		$grouped_products = $product->get_children();
		if(!$grouped_products || count($grouped_products) <= 0)
			return;
		foreach ( $grouped_products as $product_id ) :
			$product = get_product( $product_id );
			$post    = $product->post;
			setup_postdata( $post );
			if ( !$product->is_sold_individually() && $product->is_purchasable() ) {
				$wd_quantities = true;
				wp_reset_postdata();
				$product = get_product( $post->ID );
				break;
			}
		endforeach;	
		wp_reset_postdata();
		$product = get_product( $post->ID );
		if($wd_quantities):
			if($_left_sidebar || $_right_sidebar) {
				if($product->product_type == 'variable') { 
					$temp_class= ' variable_hidden';
				}
				if($product->product_type == 'external') { ?>
					<!--<p class="cart"><a href="<?php echo esc_url($product->get_product_url()); ?>" rel="nofollow" class="single_add_to_cart_button button alt hidden-phone"><?php echo apply_filters('single_add_to_cart_text',$product->get_button_text(), 'external'); ?></a></p>-->
					<p class="cart"><a href="<?php echo esc_url($product->get_product_url()); ?>" rel="nofollow" class="single_add_to_cart_button button alt hidden-phone"><?php echo $product->get_button_text(); ?></a></p>
				<?php  } else {
					echo '<button type="button" class="virtual single_add_to_cart_button button alt hidden-phone'.$temp_class.'">';
					echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'wpdance' ), $product->product_type); 
					echo '</button>';
				}
			}	
		endif;
	}
}



function wd_upsell_display( $posts_per_page = '-1', $columns = 5, $orderby = 'rand' ){
	woocommerce_get_template( 'single-product/up-sells.php', array(
				'posts_per_page'  => 15,
				'orderby'    => 'rand',
				'columns'    => 15
		) );
}







if ( ! function_exists( 'dimox_shop_breadcrumbs' ) ) {

	/**
	 * Output the WooCommerce Breadcrumb
	 *
	 * @access public
	 * @return void
	 */
	function dimox_shop_breadcrumbs( $args = array() ) {

		$defaults = apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => '<span class="brn_arrow">&#47;</span>',
			'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'wpdance' ),
		) );

		$args = wp_parse_args( $args, $defaults );

		woocommerce_get_template( 'global/breadcrumb.php', $args );
	}
}




function update_add_to_cart_text( $button_text ){
	return $button_text = __('Add to Card','wpdance');
}
function update_single_product_wrapper_class( $_wrapper_class ){
	return $_wrapper_class = "without_related";
}



if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}


if ( ! function_exists( 'wd_checkout_fields_form' ) ) {
	function wd_checkout_fields_form($checkout){
		$checkout->checkout_fields['account']    = array(
			'account_username' => array(
				'type' => 'text',
				'label' => __('Account username', 'woocommerce'),
				'placeholder' => _x('Username', 'placeholder', 'woocommerce')
				),
			'account_password' => array(
				'type' => 'password',
				'label' => __('Account password', 'woocommerce'),
				'placeholder' => _x('Password', 'placeholder', 'woocommerce'),
				'class' => array('form-row-first')
				),
			'account_password-2' => array(
				'type' => 'password',
				'label' => __('Account password', 'woocommerce'),
				'placeholder' => _x('Comfirm Password', 'placeholder', 'woocommerce'),
				'class' => array('form-row-last'),
				'label_class' => array('hidden')
				)
		);
	}
}

if ( ! function_exists( 'wd_checkout_add_on_js' ) ) {
	function wd_checkout_add_on_js(){
?>
	<script type='text/javascript'>
		jQuery(document).ready(function() {
			if(jQuery("ul.wd-tabs li").find(".active").length < 1){
				var first_li = jQuery("ul.wd-tabs li:first");
				first_li.addClass("active");
				var sel = jQuery(first_li).children("a").attr('href');
				jQuery(".wd_tab-pane" + sel).addClass("active").show(400);
			}
			//tab check out
			jQuery(".wd_tab-pane:not(.active)").css("display","none");
			jQuery("ul.wd-tabs > li > a").click(function(e){
				e.preventDefault();
				jQuery(".wd_create_account").hide();
				var sel = jQuery(this).attr('href');
				
				if(jQuery(".wd_tab-pane" + sel).find("input.wd_checkout-method:checked").val() == 'account'){
					jQuery(".wd_create_account").children().andSelf().show();
					jQuery(".wd_create_account #createaccount").prop('checked', true);
					jQuery(".button_billing_address_continue").show();
					jQuery(".button_create_account_continue").hide();
				}
				
				if(jQuery(this).parent('li').hasClass("active")){
					return false;
				}
				
				jQuery("ul.wd-tabs > li").removeClass("active");
				jQuery(this).parent("li").addClass("active");
				jQuery(".wd_tab-pane").css("display","none");
				jQuery(".wd_tab-pane" + sel).show(400);
			});
			
			jQuery(".wd_checkout-method").click(function(){
				if(jQuery(this).val() == 'account'){
					jQuery(".wd_create_account").children().andSelf().slideDown();
					jQuery(".wd_create_account #createaccount").prop('checked', true);
					//jQuery(".wd_create_account .create-account").show();
					jQuery(".button_billing_address_continue").show();
					jQuery(".button_create_account_continue").hide();
				} else {
					jQuery(".wd_create_account").slideUp();
					jQuery(".button_create_account_continue").show();
					jQuery(".button_billing_address_continue").hide();
				}
				
			});
			//jQuery('input.checkout-method').trigger('change');
			
			jQuery('.next_co_btn').on('click',function(){
				jQuery(".wd_create_account").hide();
				var _next_id = jQuery(this).attr('rel');
				jQuery("ul.wd-tabs > li").removeClass("active");
				jQuery("a#li_"+_next_id).parent("li").addClass("active");
				jQuery(".wd_tab-pane").css("display","none");
				jQuery(".wd_tab-content div#" +_next_id).show(400);
				
			});
			

			//jQuery("ul#shipping_method").on('change','input:radio[name=shipping_method]',function(){
			//	console.log(jQuery("input[name=shipping_method]:checked").val());
				//$('body').trigger('update_checkout');
			//});    
		
		});
	</script>
<?php	
	}
}
?>