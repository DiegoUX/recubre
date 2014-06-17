<?php 


	/**
	*	Combine a input array with defaut array
	*
	**/
	if(!function_exists ('wd_valid_color')){
		function wd_valid_color( $color = '' ) {
			if( strlen(trim($color)) > 0 ) {
				$named = array('aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgreen', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'greenyellow', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta', 'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'purple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'snow', 'springgreen', 'steelblue', 'tan', 'teal', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen');
				if (in_array(strtolower($color), $named)) {
					return true;
				}else{
					return preg_match('/^#[a-f0-9]{6}$/i', $color);			
				}
			}
			return false;
		}
	}

	/**
	*	Combine a input array with defaut array
	*
	**/
	if(!function_exists ('wd_array_atts')){
		function wd_array_atts($pairs, $atts) {
			$atts = (array)$atts;
			$out = array();
		   foreach($pairs as $name => $default) {
				if ( array_key_exists($name, $atts) ){
					if( strlen(trim($atts[$name])) > 0 ){
						$out[$name] = $atts[$name];
					}else{
						$out[$name] = $default;
					}
				}
				else{
					$out[$name] = $default;
				}	
			}
			return $out;
		}
	}
	
	if(!function_exists ('wd_array_atts_str')){
		function wd_array_atts_str($pairs, $atts) {
			$atts = (array)$atts;
			$out = array();
		   foreach($pairs as $name => $default) {
				if ( array_key_exists($name, $atts) ){
					if( strlen(trim($atts[$name])) > 0 ){
						$out[$name] = $atts[$name];
					}else{
						$out[$name] = $default;
					}
				}
				else{
					$out[$name] = $default;
				}	
			}
			return $out;
		}
	}	
	
	if(!function_exists ('wd_get_all_post_list')){
		function wd_get_all_post_list( $_post_type = "post" ){
			wp_reset_query();
			$args = array(
				'post_type'=> $_post_type
				,'posts_per_page'  => -1
			);
			$_post_lists = get_posts( $args );
			
			if( $_post_lists ){
				foreach ( $_post_lists as $post ) {
					setup_postdata($post);
					$ret_array[] = array(
						$post->ID
						,get_the_title($post->ID)
					);
				}
			}else{
				$ret_array = array();
			}
			wp_reset_query();	
			return $ret_array ;
			
		}
	}	
	
	if(!function_exists ('show_page_slider')){
		function show_page_slider(){
			global $page_datas;
			$revolution_exists = ( class_exists('RevSlider') && class_exists('UniteFunctionsRev') );
			switch ($page_datas['page_slider']) {
				case 'revolution':
					if( $revolution_exists )
						RevSliderOutput::putSlider($page_datas['page_revolution'],"");
					break;
				case 'flex':
					show_flex_slider($page_datas['page_flex']);
					break;	
				case 'nivo':
					show_nivo_slider($page_datas['page_nivo']);
					break;	
				case 'product' :
					show_prod_slider($page_datas['product_tag']);
					break;							
				case 'none' :
					break;							
				default:
				   break;
			}	
		}
	}
	add_action( 'wd_header_init', 'wd_print_header_head', 10 );
	if(!function_exists ('wd_print_header_head')){
		function wd_print_header_head(){
	?>	
	
			<div class="header-top">
				<?php 
					if( strlen(trim(get_option(THEME_SLUG.'facebok_link'))) > 0 || 
						strlen(trim(get_option(THEME_SLUG.'twitter_link'))) > 0 ||
						strlen(trim(get_option(THEME_SLUG.'rss_link'))) > 0 ||
						strlen(trim(get_option(THEME_SLUG.'pinterest_link'))) > 0 || 
						strlen(trim(get_option(THEME_SLUG.'google_link'))) > 0 
					):			
				?>
				<div class="header-top-content left-header-top-content">
					<ul class="social-share first">
						<?php if(strlen(trim(get_option(THEME_SLUG.'facebok_link'))) > 0): ?>
						<li class="facebook first">
							<a target="_blank"  data-placement="right" title="<?php _e("Find us on facebook","wpdance");?>" data-original-title="<?php _e("Find us on facebook","wpdance");?>" href="<?php echo get_option(THEME_SLUG.'facebok_link') ; ?>">
								<span class="facebook-icon"></span>
							</a>
						</li>
						<?php endif;?>
						<?php if(strlen(trim(get_option(THEME_SLUG.'twitter_link'))) > 0): ?>
						<li class="twitter">
							<a target="_blank"  data-placement="right" title="<?php _e("Follow us on twitter","wpdance");?>" data-original-title="<?php _e("Follow us on twitter","wpdance");?>" href="<?php echo get_option(THEME_SLUG.'twitter_link') ; ?>">
								<span class="twitter-icon"></span>
							</a>
						</li>
						<?php endif;?>
						<?php if(strlen(trim(get_option(THEME_SLUG.'rss_link'))) > 0): ?>
						<li class="rss">
							<a target="_blank"  data-placement="right" title="<?php _e("Rss feed","wpdance");?>" data-original-title="<?php _e("Rss feed","wpdance");?>" href="<?php echo get_option(THEME_SLUG.'rss_link') ; ?>">
								<span class="rss-icon"></span>
							</a>
						</li>
						<?php endif;?>
						<?php if(strlen(trim(get_option(THEME_SLUG.'pinterest_link'))) > 0): ?>
						<li class="pinterest">
							<a target="_blank"  data-placement="right" title="<?php _e("Our pinterest","wpdance");?>" data-original-title="<?php _e("Our pinterest","wpdance");?>" href="<?php echo get_option(THEME_SLUG.'pinterest_link') ; ?>">
								<span class="pinterest-icon"></span>
							</a>
						</li>
						<?php endif;?>
						<?php if(strlen(trim(get_option(THEME_SLUG.'google_link'))) > 0): ?>
						<li class="google">
							<a target="_blank"  data-placement="right" title="<?php _e("Find us on Google+","wpdance");?>" data-original-title="<?php _e("Our pinterest","wpdance");?>" href="<?php echo get_option(THEME_SLUG.'google_link') ; ?>">
								<span class="pinterest-icon"></span>
							</a>
						</li>
						<?php endif;?>
					</ul>
				</div>
				<?php endif; ?>
				<div class="header-top-content right-header-top-content">
					<div class="shopping-cart shopping-cart-wrapper">
						<?php echo wd_tini_cart();?>
					</div>
					<div class="header-bottom-wishlist">
						<?php echo wd_tini_account();//TODO : account form goes here?>
					</div>
					<div class="phone_quick_menu_1 visible-phone">
						<div class="mobile_my_account">
							<?php if ( is_user_logged_in() ) { ?>
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','wpdance'); ?>"><?php _e('My Account','wpdance'); ?></a>
							<?php }
							else { ?>
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','wpdance'); ?>"><?php _e('Login / Register','wpdance'); ?></a>
							<?php } ?>
						</div>
					</div>
					<div class="mobile_cart_container visible-phone">
						<div class="mobile_cart">
						<?php
							global $woocommerce;
							if( isset($woocommerce) && isset($woocommerce->cart) ){
								$cart_url = $woocommerce->cart->get_cart_url();
								echo "<a href='{$cart_url}' title='View Cart'>View Cart</a>";
							}

						?>
						</div>
						<div class="mobile_cart_number">0</div>
					</div>
				</div>
			</div><!-- end header top -->
			
		<?php	
		}	
	}
	
	add_action( 'wd_header_init', 'wd_print_header_body', 20 );
	if(!function_exists ('wd_print_header_body')){
		function wd_print_header_body(){
	?>	
			<div class="header-middle">
				<div class="header-middle-content">
					<?php theme_logo();?>
					<div class="header_search"><?php get_search_form(); ?></div>
					<div class="nav">
						<?php 
							if ( has_nav_menu( 'primary' ) ) {
								wp_nav_menu( array( 'container_class' => 'main-menu pc-menu wd-mega-menu-wrapper','theme_location' => 'primary','walker' => new WD_Walker_Nav_Menu() ) );
							}else{
								wp_nav_menu( array( 'container_class' => 'main-menu pc-menu wd-mega-menu-wrapper','theme_location' => 'primary' ) );
							}
						?>
					</div>
				</div>
			</div><!-- end .header-middle -->	
			<?php wp_reset_query();?>			
		
	<?php	
		}	
	}

	add_action( 'wd_header_init', 'wd_print_header_footer', 30 );
	if(!function_exists ('wd_print_header_footer')){
		function wd_print_header_footer(){
	?>	
			
		<?php 
			global $page_datas;
				wp_reset_query();
				if(isset($page_datas) && $page_datas['hide_new_product'] == 0) : ?>
			<div class="header-bottom">
				<div class="header-bottom-content container">
					<div class="new_product container">
						<?php $new_product=new wp_query(array('post_type'=>'product','ignore_sticky_posts'=> 1,'posts_per_page' => 1 , 'orderby' => 'DESC', 'meta_value' => 1));?>
						<?php if($new_product->have_posts()){?>
						<div class="new_product_content">
							<?php while($new_product->have_posts ()){$new_product->the_post();global $post;?>	
										<div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
										<div class="readmore"><a href="<?php the_permalink(); ?>"><?php _e('View Detail','wpdance'); ?></a></div>
							<?php }?>
						</div>
						<?php }?>
						<?php wp_reset_query(); ?>
					</div>
				</div>
			</div><!-- end .header-bottom -->
			<script type="text/javascript">
				var header_bottom_height = jQuery(".header-bottom").outerHeight();
				jQuery(".header-bottom").css("bottom","-"+header_bottom_height+"px");
				//jQuery(".main-slideshow").attr('style','min-height:' + header_bottom_height + ';other-styles');
				//jQuery(".main-slideshow").css("min-height",header_bottom_height + "px");
			</script>
		<?php endif; ?>	
	<?php		
		}	
	}	
	
	
	add_action( 'wd_bofore_main_container', 'wd_print_inline_script', 10 );
	if(!function_exists ('wd_print_inline_script')){
		function wd_print_inline_script(){
	?>	
		<script type="text/javascript">
			_ajax_uri = '<?php echo admin_url('admin-ajax.php');?>';
			_on_phone = <?php echo WD_IS_MOBILE === true ? 1 : 0 ;?>;
			_on_tablet = <?php echo WD_IS_TABLET === true ? 1 : 0 ;?>;
			//if(navigator.userAgent.indexOf(\"Mac OS X\") != -1)
			//	console.log(navigator.userAgent);
			//jQuery("html").niceScroll({cursorcolor:"#000"});
			jQuery('.menu li').each(function(){
				if(jQuery(this).children('.sub-menu').length > 0) jQuery(this).addClass('parent');
			});
		</script>
	<?php
		}
	}	
	//add_action( 'wd_bofore_main_container', 'wd_print_ads_block', 20 );
	if(!function_exists ('wd_print_ads_block')){
		function wd_print_ads_block(){
			global $page_datas;
	?>	
			<div class="header_ads_wrapper">
				<?php 
					if( !is_home() && !is_front_page() ){
						if( !is_page() ){
							printHeaderAds();
						}else{
							if( isset($page_datas['hide_ads']) && absint($page_datas['hide_ads']) == 0 )
								printHeaderAds();
						}
						
					}
						
				?>
			</div>
	<?php
		}
	}	


	add_action( 'wd_before_body_end', 'wd_before_body_end_widget_area', 10 );
	if(!function_exists ('wd_before_body_end_widget_area')){
		function wd_before_body_end_widget_area(){
	?>	
	
		<div class="container">
				<div class="body-end-widget-area">
					<?php
						if ( is_active_sidebar( 'body-end-widget-area' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'body-end-widget-area' ); ?>
							</ul>
						<?php endif; ?>						
				</div><!-- end #footer-first-area -->
		</div>	
		<?php wp_reset_query();?>
	
	<?php
		}
	}	

	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_1', 10 );
	if(!function_exists ('wd_footer_init_widget_area_1')){
		function wd_footer_init_widget_area_1(){
	?>	
	
		<?php if( !wp_is_mobile() ): ?>
			<div class="first-footer-widget-area">
				<div class="container">
					<div class="first-footer-widget-area-1 span6 hidden-phone">
						<div class="container">
							<?php if ( is_active_sidebar( 'first-footer-widget-area-1' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'first-footer-widget-area-1' ); ?>
								</ul>
							<?php endif; ?>
						</div>
					</div><!-- end #footer-first-area -->
					<div class="first-footer-widget-area-2 span6 hidden-phone">
						<div class="container">
							<?php if ( is_active_sidebar( 'first-footer-widget-area-2' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'first-footer-widget-area-2' ); ?>
								</ul>
							<?php endif; ?>
						</div>
					</div><!-- end #footer-first-area -->
					<div class="first-footer-widget-area-3 span6 hidden-phone">
						<div class="container">
							<?php if ( is_active_sidebar( 'first-footer-widget-area-3' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'first-footer-widget-area-3' ); ?>
								</ul>
							<?php endif; ?>
						</div>
					</div><!-- end #footer-first-area -->
					<div class="first-footer-widget-area-4 span6 hidden-phone">
						<div class="container">
							<?php if ( is_active_sidebar( 'first-footer-widget-area-4' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'first-footer-widget-area-4' ); ?>
								</ul>
							<?php endif; ?>
						</div>
					</div><!-- end #footer-first-area -->
				</div>
			</div>
			<?php wp_reset_query();?>
		<?php endif; ?>	
		
	<?php
		}
	}

	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_2', 20 );
	if(!function_exists ('wd_footer_init_widget_area_2')){
		function wd_footer_init_widget_area_2(){
	?>	
	
		<?php //if( !wp_is_mobile() ): ?>
			<div class="second-footer-widget-area">
				<div class="container">
					<div class="second-footer-widget-area-1 span8 hidden-phone">
						<div class="second-footer-widget-1-area alpha omega">
							<?php
								if ( is_active_sidebar( 'second-footer-widget-area-1' ) ) : ?>
									<ul class="xoxo">
										<?php dynamic_sidebar( 'second-footer-widget-area-1' ); ?>
									</ul>
							<?php endif; ?>								
						</div>
					</div><!-- end #footer-second-area-1 -->	
					<div class="second-footer-widget-area-2 span8 hidden-phone">
						<div class="second-footer-widget-2-area alpha omega">
							<?php
								if ( is_active_sidebar( 'second-footer-widget-area-2' ) ) : ?>
									<ul class="xoxo">
										<?php dynamic_sidebar( 'second-footer-widget-area-2' ); ?>
									</ul>
							<?php endif; ?>								
						</div>
					</div><!-- end #footer-second-area-2 -->
					<div class="second-footer-widget-area-3 span8 hidden-phone">
						<div class="second-footer-widget-3-area alpha omega">
							<?php
								if ( is_active_sidebar( 'second-footer-widget-area-3' ) ) : ?>
									<ul class="xoxo">
										<?php dynamic_sidebar( 'second-footer-widget-area-3' ); ?>
									</ul>
							<?php endif; ?>								
						</div>
					</div><!-- end #footer-second-area-3 -->
				</div>
			</div>
			<?php wp_reset_query();?>
		<?php //endif; ?>	
		
	<?php
		}
	}


	//add_action( 'wd_footer_init', 'wd_footer_init_widget_area_3', 30 );
	if(!function_exists ('wd_footer_init_widget_area_3')){
		function wd_footer_init_widget_area_3(){
	?>	
	
				<div id="footer-thrid-area">
					<div class="container">
						<div class="footer_wrapper_1 span6">
							<div class="thrid-footer-widget-area-1">
								<?php
									if ( is_active_sidebar( 'thrid-footer-widget-area-1' ) ) : ?>
										<ul class="xoxo omega">
											<?php dynamic_sidebar( 'thrid-footer-widget-area-1' ); ?>
										</ul>
								<?php endif; ?>								
							</div>
						</div>
						<div class="footer_wrapper_2 span18">
							<div class="container">
								<div class="thrid-footer-widget-area-2 span6">
									<?php
										if ( is_active_sidebar( 'thrid-footer-widget-area-2' ) ) : ?>
											<ul class="xoxo alpha">
												<?php dynamic_sidebar( 'thrid-footer-widget-area-2' ); ?>
											</ul>
									<?php endif; ?>								
								</div>
								<div class="thrid-footer-widget-area-3 span6">
									<?php
										if ( is_active_sidebar( 'thrid-footer-widget-area-3' ) ) : ?>
											<ul class="xoxo alpha">
												<?php dynamic_sidebar( 'thrid-footer-widget-area-3' ); ?>
											</ul>
									<?php endif; ?>								
								</div>
								<div class="thrid-footer-widget-area-4 span6">
									<?php
										if ( is_active_sidebar( 'thrid-footer-widget-area-4' ) ) : ?>
											<ul class="xoxo alpha">
												<?php dynamic_sidebar( 'thrid-footer-widget-area-4' ); ?>
											</ul>
									<?php endif; ?>								
								</div>
								<div class="thrid-footer-widget-area-5 span6">
									<?php
										if ( is_active_sidebar( 'thrid-footer-widget-area-5' ) ) : ?>
											<ul class="xoxo alpha">
												<?php dynamic_sidebar( 'thrid-footer-widget-area-5' ); ?>
											</ul>
									<?php endif; ?>								
								</div>
							</div>
						</div>
					</div>
				</div><!-- end #footer-thrid-area -->
			<?php wp_reset_query();?>
	
	<?php
		}
	}


	//add_action( 'wd_footer_init', 'wd_footer_init_widget_area_4', 40 );
	if(!function_exists ('wd_footer_init_widget_area_4')){
		function wd_footer_init_widget_area_4(){
	?>	
	
				<div class="four-footer-widget-area">
					<div class="container"> 
						<?php
							if ( is_active_sidebar( 'four-footer-widget-area' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'four-footer-widget-area' ); ?>
								</ul>
						<?php endif; ?>							
					</div>
				</div><!-- end #footer-fourth-area -->
				<?php wp_reset_query();?>
	
	<?php
		}
	}	


	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_5', 50 );
	if(!function_exists ('wd_footer_init_widget_area_5')){
		function wd_footer_init_widget_area_5(){
	?>	
			<div class="wd_footer_end">
				<div class="container">
					<div id="copy-right" class="copy-right span18">
						<div class="copyright">
							<?php echo stripslashes(get_option(THEME_SLUG.'copyright_text')); ?>
							<!--<p><?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?>  seconds.</p>-->
						</div>
					</div><!-- end #copyright -->
					<div class="payment span6">
						<a href="<?php if(get_option(THEME_SLUG.'visa_link')) { echo get_option(THEME_SLUG.'visa_link'); } else { echo '#'; }?>"><img alt="visa" title ="visa" src="<?php echo get_option(THEME_SLUG.'visa_image'); ?>" /></a>
						<a href="<?php if(get_option(THEME_SLUG.'mastercard_link')) { echo get_option(THEME_SLUG.'mastercard_link'); } else { echo '#'; }?>"><img alt="master card" title="master card" src="<?php echo get_option(THEME_SLUG.'mastercard_image'); ?>" /></a>
						<a href="<?php if(get_option(THEME_SLUG.'americanexpress_link')) { echo get_option(THEME_SLUG.'americanexpress_link'); } else { echo '#'; }?>"><img alt="express" title="express" src="<?php echo get_option(THEME_SLUG.'americanexpress_image'); ?>" /></a>
						<a href="<?php if(get_option(THEME_SLUG.'paypal_link')) { echo get_option(THEME_SLUG.'paypal_link'); } else { echo '#'; }?>"><img alt="paypal" title ="paypal" src="<?php echo get_option(THEME_SLUG.'paypal_image'); ?>" /></a>
						<!--<a href="#"><img alt="dhl" title="dhl" src="http://demo.wpdance.com/imgs/woocommerce/payment_dhl.png" /></a>
						<a href="#"><img alt="fedex" title="fedex" src="http://demo.wpdance.com/imgs/woocommerce/payment_fedex.png" /></a>-->
					</div>
				</div>
			</div>	
				<?php wp_reset_query();?>
	
	<?php
		}
	}

	add_action( 'wd_before_footer_end', 'wd_before_body_end_content', 10 );
	if(!function_exists ('wd_before_body_end_content')){
		function wd_before_body_end_content(){
	?>	
		<?php $_content = stripslashes(htmlspecialchars_decode(get_option(THEME_SLUG.'contact_content',''))); ?>
		<?php if( strlen($_content) > 0 ):?>
			<div id="feedback" class="hidden-phone">
				<a class="feedback-button wd-prettyPhoto" href="#<?php if (strlen($_content) > 0) {  ?>wd_contact_content<?php } ?>" ></a>
			</div>
			<div class="contact_form hidden-phone hidden" >
				<div class="contact_form_inner" style="overflow:hidden;" id="wd_contact_content"><?php echo do_shortcode($_content);?></div>
			</div>
		<?php endif;?>
		
		<?php if(!wp_is_mobile()): ?>
		<div id="to-top" class="scroll-button">
			<a class="scroll-button" href="javascript:void(0)" title="<?php _e('Back to Top','wpdance');?>"></a>
		</div>
		<?php endif; ?>
		
		<!--<div class="loading-mark-up">
			<span class="loading-image"></span>
		</div>
		<span class="loading-text"></span>-->
	
	<?php
		}
	}
	
?>