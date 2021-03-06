<?php
	function toRGB($Hex){
		if (substr($Hex,0,1) == "#")
			$Hex = substr($Hex,1);
			
			

		$R = substr($Hex,0,2);
		$G = substr($Hex,2,2);
		$B = substr($Hex,4,2);

		$R = hexdec($R);
		$G = hexdec($G);
		$B = hexdec($B);

		$RGB['R'] = $R;
		$RGB['G'] = $G;
		$RGB['B'] = $B;

		return $RGB;
	}


	add_action('wp_enqueue_scripts', 'custom_style_inline_script');
	function save_custom_style( $save_datas = array() ){
		//wrong input type
		if( !is_array($save_datas) ){
			return -1;
		}
		$cache_file = THEME_CACHE.'custom.less';
		$enable_custom_font = $save_datas['enable_custom_font'];
		$enable_custom_color = $save_datas['enable_custom_color'];
		
		if( strlen($save_datas['body_font_name']) <= 0 || (int)$save_datas['body_font_name'] == -1 )
			$save_datas['body_font_name'] = "Roboto";
		if( strlen($save_datas['heading_font_name']) <= 0 || (int)$save_datas['heading_font_name'] == -1 )
			$save_datas['heading_font_name'] = "Share";
		if( strlen($save_datas['menu_font_name']) <= 0 || (int)$save_datas['menu_font_name'] == -1 )
			$save_datas['menu_font_name'] = "Share";			
		if( strlen($save_datas['sub_menu_font_name']) <= 0 || (int)$save_datas['sub_menu_font_name'] == -1 )
			$save_datas['sub_menu_font_name'] = "Roboto";
			
		try{			
			ob_start();
			?>
			
			<?php 
				// $custom_style_config = get_option(THEME_SLUG.'custom_style_config','');
				// $custom_style_config_arr = unserialize($custom_style_config);			
				// var_dump($custom_style_config_arr);
				//print_r($save_datas);
			?>
			
			// Font
			@font_body:<?php echo $save_datas['body_font_name'];?>;
			@font_body_fontweight:<?php echo $save_datas['body_font_weight'];?>;
			@font_body_fontstyle:<?php echo $save_datas['body_font_style'];?>;

			@font_menu:<?php echo $save_datas['menu_font_name'];?>;
			@font_menu_fontweight:<?php echo $save_datas['menu_font_weight'];?>;
			@font_menu_fontstyle:<?php echo $save_datas['menu_font_style'];?>;


			@font_sub_menu:<?php echo $save_datas['sub_menu_font_name'];?>;
			@font_sub_menu_fontweight:<?php echo $save_datas['sub_menu_font_weight'];?>;
			@font_sub_menu_fontstyle:<?php echo $save_datas['sub_menu_font_style'];?>;
			
			@font_heading:<?php echo $save_datas['heading_font_name'];?>;
			@font_heading_fontweight:<?php echo $save_datas['heading_font_weight'];?>;
			@font_heading_fontstyle:<?php echo $save_datas['heading_font_style'];?>;
			
			// Primary
			@primary_color:<?php echo $save_datas['primary_color'];?>;
			@secondary_color:<?php echo $save_datas['secondary_color'];?>;

			// Header
			@header_top_background:<?php echo $save_datas['header_top_background'];?>;
			@header_top_text_color:<?php echo $save_datas['header_top_text_color'];?>;
			@header_top_link_color:<?php echo $save_datas['header_top_link_color'] = strlen($save_datas['header_top_link_color']) > 0 ? $save_datas['header_top_link_color'] : "null";?>;
			@header_top_social_background_hover:<?php echo $save_datas['header_top_social_background_hover'] = strlen($save_datas['header_top_social_background_hover']) > 0 ? $save_datas['header_top_social_background_hover'] : "null";?>;;
			@header_menu_text_color:<?php echo $save_datas['header_menu_text_color'];?>;
			@header_menu_active_text_color:<?php echo $save_datas['header_menu_active_text_color'];?>;
			@header_submenu_text_color:<?php echo $save_datas['header_submenu_text_color'];?>;
			@header_submenu_link_color:<?php echo $save_datas['header_submenu_link_color'] = strlen($save_datas['header_submenu_link_color']) > 0 ? $save_datas['header_submenu_link_color'] : "null";?>;
			@header_submenu_border_top_color:<?php echo $save_datas['header_submenu_border_top_color'] = strlen($save_datas['header_submenu_border_top_color']) > 0 ? $save_datas['header_submenu_border_top_color'] : "null";?>;;
			@header_submenu_border_color:<?php echo $save_datas['header_submenu_border_color'];?>;
			@header_submenu_hover_item_color:<?php echo $save_datas['header_submenu_hover_item_color'];?>;
			
			// Footer
			@footer_first_area_background_color:<?php echo $save_datas['footer_first_area_background_color'];?>;
			@footer_first_area_text_color:<?php echo $save_datas['footer_first_area_text_color'];?>;
			@footer_first_area_link_color:<?php echo $save_datas['footer_first_area_link_color'];?>;
			@footer_first_area_link_color_hover:<?php echo $save_datas['footer_first_area_link_color_hover'];?>;
			@footer_first_area_heading_color:<?php echo $save_datas['footer_first_area_heading_color'];?>;
			@footer_first_area_border_color:<?php echo $save_datas['footer_first_area_border_color'];?>;
			@footer_second_area_background_color:<?php echo $save_datas['footer_second_area_background_color'];?>;
			@footer_second_area_text_color:<?php echo $save_datas['footer_second_area_text_color'];?>;
			@footer_second_area_link_color:<?php echo $save_datas['footer_second_area_link_color'];?>;
			@footer_second_area_link_color_hover:<?php echo $save_datas['footer_second_area_link_color_hover'];?>;
			@footer_second_area_heading_color:<?php echo $save_datas['footer_second_area_heading_color'];?>;
			@footer_second_area_border_color:<?php echo $save_datas['footer_second_area_border_color'];?>;
			@footer_thrid_area_background_color:<?php echo $save_datas['footer_thrid_area_background_color'];?>;
			@footer_thrid_area_text_color:<?php echo $save_datas['footer_thrid_area_text_color'];?>;
			@footer_thrid_area_link_color:<?php echo $save_datas['footer_thrid_area_link_color'];?>;
			@footer_thrid_area_link_color_hover:<?php echo $save_datas['footer_thrid_area_link_color_hover'];?>;
			@footer_thrid_area_border_color:<?php echo $save_datas['footer_thrid_area_border_color'];?>;

			// Sidebar
			@sidebar_text_color: <?php echo $save_datas['sidebar_text_color'];?>;
			@sidebar_link_color:<?php echo $save_datas['sidebar_link_color'];?>;
			@sidebar_link_color_hover:<?php echo $save_datas['sidebar_link_color_hover'];?>;
			@sidebar_heading_color: <?php echo $save_datas['sidebar_heading_color'];?>;
			@sidebar_border_color:<?php echo $save_datas['sidebar_border_color'];?>;
			
			// Especial
			@primary_text_color:<?php echo $save_datas['primary_text_color'];?>;
			@primary_link_color:<?php echo $save_datas['primary_link_color'];?>;
			@primary_link_color_hover:<?php echo $save_datas['primary_link_color_hover'];?>;
			@primary_heading_color:<?php echo $save_datas['primary_heading_color'];?>;
			@primary_button_background_color:<?php echo $save_datas['primary_button_background_color'];?>;
			@primary_button_border_color:<?php echo $save_datas['primary_button_border_color'];?>;
			@primary_button_text_color:<?php echo $save_datas['primary_button_text_color'];?>;
			@primary_button_background_color_hover:<?php echo $save_datas['primary_button_background_color_hover'];?>; 
			
			@primary_button_border_color_hover:<?php echo $save_datas['primary_button_border_color_hover'];?>;
			@primary_button_text_color_hover:<?php echo $save_datas['primary_button_text_color_hover'];?>;
			@secondary_button_background_color:<?php echo $save_datas['secondary_button_background_color'];?>;
			@secondary_button_border_color:<?php echo $save_datas['secondary_button_border_color'];?>;
			@secondary_button_text_color:<?php echo $save_datas['secondary_button_text_color'];?>;
			@secondary_button_background_color_hover:<?php echo $save_datas['secondary_button_background_color_hover'];?>;
			@secondary_button_border_color_hover:<?php echo $save_datas['secondary_button_border_color_hover'];?>;
			@secondary_button_text_color_hover:<?php echo $save_datas['secondary_button_text_color_hover'];?>;
			
			@primary_border_color:<?php echo $save_datas['primary_border_color'];?>;
			@primary_border_color_hover:<?php echo $save_datas['primary_border_color_hover'];?>;
			@secondary_border_color:<?php echo $save_datas['secondary_border_color'];?>; 
			@secondary_border_color_hover:<?php echo $save_datas['secondary_border_color_hover'];?>;
			@primary_tab_background_color:<?php echo $save_datas['primary_tab_background_color'];?>;
			@primary_tab_border_color:<?php echo $save_datas['primary_tab_border_color'];?>;
			@primary_tab_text_color:<?php echo $save_datas['primary_tab_text_color'];?>;
			@primary_tab_active_text_color:<?php echo $save_datas['primary_tab_active_text_color'];?>;
			
			@cart_icon_color:<?php echo $save_datas['cart_icon_color'];?>;
			@cart_background_color:<?php echo $save_datas['cart_background_color'];?>;
			@cart_background_color_hover:<?php echo $save_datas['cart_background_color_hover'];?>;
			@feedback_background:<?php echo $save_datas['feedback_background'];?>;
			@feedback_background_hover:<?php echo $save_datas['feedback_background_hover'];?>;
			
			@totop_background:<?php echo $save_datas['totop_background'];?>;
			@totop_background_hover:<?php echo $save_datas['totop_background_hover'];?>;
			@scollbar:<?php echo $save_datas['scollbar'];?>;
			@rating_color:<?php echo $save_datas['rating_color'];?>;
			@quickshop_text_color:<?php echo $save_datas['quickshop_text_color'];?>;
			@quickshop_background_color:<?php echo $save_datas['quickshop_background_color'];?>;
			@quickshop_background_color_hover:<?php echo $save_datas['quickshop_background_color_hover'];?>;
			
			// Functions
			.gradient(@start, @end) {
				background: mix(@start, @end, 50%);
				filter: ~"progid:DXImageTransform.Microsoft.gradient(startColorStr="@start~", EndColorStr="@end~")";
				background: -webkit-gradient(linear, left top, left bottom, from(@start), to(@end));
				background: -webkit-linear-gradient(@start, @end);
				background: -moz-linear-gradient(top, @start, @end);
				background: -ms-linear-gradient(@start, @end);
				background: -o-linear-gradient(@start, @end);
				background: linear-gradient(@start, @end);
				zoom: 1;
			}


			/*==============================================================*/
			/*                        PRIMARY                               */
			/*==============================================================*/

	
	/* TEXT */
	
	body, .portfolio_sc h2, .woocommerce-page .wd_checkout_method form.login .lost_password
		{
			font-family:@font_body;
			color:@primary_text_color;
			font-weight:@font_body_fontweight;
			font-style:@font_body_fontstyle;
		}
	body code,
	#entry-author-info #author-description .view-all-author-posts a,
	html .woocommerce .woocommerce-breadcrumb a, #crumbs a,
	html .woocommerce .woocommerce-breadcrumb .brn_arrow:after, #crumbs .brn_arrow:after,
	.single_product_summary_end .single_views,
	html .woocommerce #customer_login.col2-set .col-1 form.login .lost_password, 
	html .woocommerce-page #customer_login.col2-set .col-1 form.login .lost_password,
	html .woocommerce .related  ul.products li.product .price del, 
	html .woocommerce-page .related  ul.products li.product .price del,
	html .woocommerce .related  div.product span.price del, 
	html .woocommerce .related  div.product p.price del,
	ul.list-posts li.testimonial.type-testimonial .post-info-thumbnail .post-info-meta .time .entry-date,
	ul.list-posts li.testimonial.type-testimonial .post-info-thumbnail .post-info-meta .views-count span,
	ul.list-posts li.testimonial.type-testimonial .post-info-thumbnail .post-info-meta .comments-count,
	ul.list-posts li.feature.type-feature .post-info-thumbnail .post-info-meta .time .entry-date,
	ul.list-posts li.feature.type-feature .post-info-thumbnail .post-info-meta .views-count span,
	ul.list-posts li.feature.type-feature .post-info-thumbnail .post-info-meta .comments-count
		{
			color:@primary_text_color;
		}

	ul.products li.product .wd_product_categories a,
	html .woocommerce ul.products li.product .wd_product_categories a,
	ul.products li.product .price del,
	html .woocommerce ul.products li.product .price del, 
	html .woocommerce-page ul.products li.product .price del,
	div.product span.price del,
	html .woocommerce div.product span.price del, 
	html .woocommerce div.product p.price del, 
	html .woocommerce #content div.product span.price del, 
	html .woocommerce #content div.product p.price del, 
	html .woocommerce-page div.product span.price del, 
	html .woocommerce-page div.product p.price del, 
	html .woocommerce-page #content div.product span.price del, 
	html .woocommerce-page #content div.product p.price del,
	html .home #content div.product p.price del,
	ul.products li.product .price .from,
	html .woocommerce ul.products li.product .price .from, 
	html .woocommerce-page ul.products li.product .price .from,
	ul.products li.product .price .to,
	html .woocommerce ul.products li.product .price .to, 
	html .woocommerce-page ul.products li.product .price .to,
	html .home ul.products li.product .price .from ,
	html .home ul.products li.product .price .to,
	ul.list-posts li .post-info-content .cat-links a,
	.single-content .post .post-info-content .cat-links a,
	blockquote, .tags_social .tags .tag-links a,
	#comments .commentlist li .divcomment .divcomment-inner .reply a:after,
	#comments .commentlist li .divcomment .divcomment-inner .comment-meta a,
	html input, html select, html textarea, #comments #comments-title span,
	.single_product_summary_end .wd_product_categories a,
	.single_product_summary_end .tagcloud a,
	.wd_tini_account_wrapper .form_wrapper_body > a ,
	.wd_tini_account_wrapper .form_wrapper_footer span,
	.wd_tini_account_wrapper .form_wrapper_header > span,
	.shopping-cart .cart_dropdown ul.cart_list li a[rel^=tag],
	.cart_dropdown .total strong, .cart_dropdown .total span,
	.cart_dropdown ul.cart_list li .cart_item_wrapper
		{
			color:(@primary_text_color + #333);
		}
	#comments .commentlist li .divcomment .divcomment-inner .reply,
	.single_product_summary_end .tagcloud a
		{
			border-color:(@primary_text_color + #333);
		}
	
	.summary.entry-summary a[title^="Share by Email"] 
		{
			color:@primary_text_color;
		}
	
	/* LINK COLOR */
	a,
	ul.products li.product .price,
	html .woocommerce ul.products li.product .price, 
	html .woocommerce-page ul.products li.product .price,
	div.product span.price,
	html .woocommerce div.product span.price, 
	html .woocommerce div.product p.price, 
	html .woocommerce #content div.product span.price, 
	html .woocommerce #content div.product p.price, 
	html .woocommerce-page div.product span.price, 
	div.product p.price,
	html .woocommerce-page div.product p.price, 
	html .woocommerce-page #content div.product span.price, 
	html .woocommerce-page #content div.product p.price,
	html .pp_woocommerce .price ins,
	html .home ul.products li.product .price,
	div.product p.stock,
	html .woocommerce div.product p.stock, 
	html .woocommerce #content div.product p.stock, 
	html .woocommerce-page div.product p.stock, 
	html .woocommerce-page #content div.product p.stock,
	html .home div.product p.stock,
	.tags_social .share-list .social-label,
	.tags_social .tags .tag-title ,
	#comments .commentlist li .divcomment .divcomment-inner .comment-author cite a,
	#respond #commentform .label, 
	html .woocommerce .woocommerce-breadcrumb, #crumbs,
	html .woocommerce .woocommerce-breadcrumb a:hover, #crumbs a:hover,
	#comments .commentlist li .divcomment .divcomment-inner .reply:hover a:after,
	.single_product_summary_end .availability,
	.single_product_summary_end .wd_product_sku,
	.single_product_summary_end .tagcloud .tag_heading,
	.single_product_summary_end .tagcloud a:hover,
	.wd_tini_account_wrapper .form_wrapper_body label,
	.cart_dropdown ul.cart_list li .cart_item_wrapper .quantity,
	.woocommerce form.checkout-resgister .wd_billing_address label, 
	.woocommerce-page form.checkout-resgister .wd_billing_address label,
	div.product .entry-summary span.price,
	html .woocommerce div.product .entry-summary span.price, 
	div.product .entry-summary p.price,
	html .woocommerce div.product .entry-summary p.price, 
	html .woocommerce #content div.product .entry-summary span.price, 
	html .woocommerce #content div.product .entry-summary p.price, 
	html .woocommerce-page div.product .entry-summary span.price, 
	html .woocommerce-page div.product .entry-summary p.price, 
	html .woocommerce-page #content div.product .entry-summary span.price, 
	html .woocommerce-page #content div.product .entry-summary p.price, 
	html .home div.product .entry-summary span.price,
	div.product form.cart .group_table td.price,
	html .woocommerce div.product form.cart .group_table td.price, 
	html .woocommerce #content div.product form.cart .group_table td.price, 
	html .woocommerce-page div.product form.cart .group_table td.price, 
	html .woocommerce-page #content div.product form.cart .group_table td.price,
	html .home div.product form.cart .group_table td.price,
	#tab-additional_information table.shop_attributes th,
	.home #tab-additional_information table.shop_attributes th
	.woocommerce #tab-additional_information table.shop_attributes th, 
	.woocommerce-page #tab-additional_information table.shop_attributes th,
	.after_checkout_form form.checkout_coupon .question_coupon,
	html .woocommerce .after_checkout_form form.checkout_coupon .question_coupon, 
	html .woocommerce-page .after_checkout_form form.checkout_coupon .question_coupon,
	.wd_tabs_checkout .wd_tab-content .wd_shipping_address label,
	form.checkout-resgister .wd_shipping_address #order_comments_field label,
	.woocommerce form.checkout-resgister .wd_shipping_address #order_comments_field label,
	.woocommerce-page form.checkout-resgister .wd_shipping_address #order_comments_field label,
	.pp_content_container  #commentform label, 
	.woocommerce-page .pp_content_container #commentform label,
	.myaccount_user strong,
	.woocommerce #content table.my_account_orders td.order-actions a.button, 
	.woocommerce-page #content table.my_account_orders td.order-actions a.button,
	html .woocommerce form .form-row .required, html .woocommerce-page form .form-row .required,
	.woocommerce #content .cart-collaterals .shipping_calculator p,
	.woocommerce-page #content .cart-collaterals .shipping_calculator p,
	.woocommerce #content .cart-collaterals .cart_totals > table th strong,
	.woocommerce-page #content .cart-collaterals .cart_totals > table th strong,
	.woocommerce #content .cart-collaterals .cart_totals > table td strong,
	.woocommerce-page #content .cart-collaterals .cart_totals > table td strong,
	.woocommerce #content .cart-collaterals .shipping_calculator abbr:after, 
	.woocommerce-page #content .cart-collaterals .shipping_calculator abbr:after,
	.woocommerce #content .cart-collaterals .cart_totals > table th, 
	.woocommerce-page #content .cart-collaterals .cart_totals > table th
		{
			color:@primary_link_color;
		}
	#comments .commentlist li .divcomment .divcomment-inner .reply:hover,
	.single_product_summary_end .tagcloud a:hover
		{
			border-color:@primary_link_color;
		}
	a:hover,
	html .woocommerce ul.products li.product .heading-title a:hover,
	html .woocommerce ul.products li.product .wd_product_categories a:hover,
	ul.list-posts li .post-info-content .cat-links a:hover,
	.single-content .post .post-info-content .cat-links a:hover,
	#comments .commentlist li .divcomment .divcomment-inner .comment-author cite a:hover,
	.single_product_summary_end .wd_product_categories a:hover:hover,
	.shopping-cart .cart_dropdown ul.cart_list li a[rel^=tag]:hover,
	html .woocommerce #customer_login.col2-set .col-1 form.login .lost_password:hover, 
	html .woocommerce-page #customer_login.col2-set .col-1 form.login .lost_password:hover,
	body.woocommerce nav.woocommerce-pagination ul li a.prev:hover, 
	body.woocommerce-page nav.woocommerce-pagination ul li a.prev:hover, 
	body.woocommerce #content nav.woocommerce-pagination ul li a.prev:hover,
	body.woocommerce nav.woocommerce-pagination ul li a.next:hover, 
	body.woocommerce-page nav.woocommerce-pagination ul li a.next:hover, 
	body.woocommerce #content nav.woocommerce-pagination ul li a.next:hover,
	.page_navi .wp-pagenavi a.nextpostslink:hover:before,
	.page_navi .wp-pagenavi a.nextpostslink:hover:after,
	.page_navi .wp-pagenavi a.previouspostslink:hover:before,
	.page_navi .wp-pagenavi a.previouspostslink:hover:after,
	.woocommerce-page .wd_checkout_method form.login .lost_password:hover,
	ul.archive-product-subcategories > li.product a:hover h3
		{
			color:@primary_link_color_hover;
		}
	
	/* HEADING */
	
	h1, h2, h3, h4, h5, h6,
	#comments #comments-title,
	.single-content .post .post-title .heading-title,
	.related-project > .title,
	.related-project > .title,
	div.product > .tabbable.tabs-left > .tab-content .tagcloud .tag_heading,
	html .woocommerce #customer_login.col2-set .col-2 label, 
	html .woocommerce-page #customer_login.col2-set .col-2 label,
	#collapse-tags .tag_heading,
	.single-content .post .post-info-thumbnail .post-info-meta .author a
		{
			font-family:@font_heading;
			font-weight:@font_heading_fontweight;
			font-style:@font_heading_fontstyle;
			color:@primary_heading_color;
		}

	.myaccount_user strong, 
	html .woocommerce .woocommerce-breadcrumb, #crumbs
	html .woocommerce .single_add_to_cart_button.button, 
	html .woocommerce .single_add_to_cart_button.button, 
	html .woocommerce .single_add_to_cart_button.button.alt, 
	html .woocommerce .single_add_to_cart_button.button.alt,
	html .home .single_add_to_cart_button.button ,
	.wd_tini_account_wrapper .wd_tini_account_control > a ,
	.shopping-cart .wd_tini_cart_control span,
	.single_product_summary_end .tagcloud .tag_heading,
	.single_product_summary_end .tagcloud a,
	html .woocommerce .woocommerce-breadcrumb, #crumbs,
	button.button, 
	a.button, 
	input[type^="submit"], 
	html .woocommerce a.button, 
	html .woocommerce button.button, 
	html .woocommerce input.button, 
	html .woocommerce #respond input#submit, 
	.woocommerce #content input.button, 
	html .woocommerce-page a.button, 
	html .woocommerce-page button.button, 
	.woocommerce-page input.button, 
	html .woocommerce-page #respond input#submit, 
	html .woocommerce-page #content input.button, 
	html .woocommerce-page #content input.button, 
	html .woocommerce #content table.cart input.button, 
	html input.button,
	.portfolio-filter li a,
	.woocommerce #content .cart-collaterals .cart_totals > table th strong,
	.woocommerce-page #content .cart-collaterals .cart_totals > table th strong,
	.woocommerce #content .cart-collaterals .cart_totals > table th, 
	.woocommerce-page #content .cart-collaterals .cart_totals > table th
		{
			font-family:@font_heading;
		}
	.single-content .post .post-info-thumbnail .post-info-meta .author a
		{
			font-family:@primary_heading_color;
		}
		
	#comments  #comments-title, .related-project > .title,
	.related > .heading-title
		{
			border-color:@primary_heading_color;
		}
	.left-sidebar-content .related .heading-title a, 
	.right-sidebar-content .related .heading-title a,
	.related > .heading-title,
	.woocommerce #content .cart-collaterals .shipping_calculator h2 a, 
	.woocommerce-page #content .cart-collaterals .shipping_calculator h2 a,
	.woocommerce #content .cart-collaterals .coupon_wrapper label, 
	.woocommerce-page #content .cart-collaterals .coupon_wrapper label,
	.woocommerce #content .cart-collaterals .cart_totals h2,
	.woocommerce-page #content .cart-collaterals .cart_totals h2
		{
			color:@primary_heading_color;
		}
		
	/* BUTTON */
	
	button.button, a.button,input[type^=submit],
	html .woocommerce a.button,html .woocommerce button.button,
	html .woocommerce input.button,html .woocommerce #respond input#submit, 
	.woocommerce #content input.button,html .woocommerce-page a.button,
	html .woocommerce-page button.button, .woocommerce-page input.button,
	html .woocommerce-page #respond input#submit, html .woocommerce-page #content input.button,
	html .woocommerce-page #content input.button, html .woocommerce #content table.cart input.button,html input.button,
	html .woocommerce .single_add_to_cart_button.button:after, 
	html .woocommerce .single_add_to_cart_button.button:after, 
	html .woocommerce .single_add_to_cart_button.button.alt:after, 
	html .woocommerce .single_add_to_cart_button.button.alt:after,
	.single_add_to_cart_button.button:after,
	html .home .single_add_to_cart_button.button:after,
	html .page .single_add_to_cart_button.button:after,
	html .woocommerce a.single_add_to_cart_button.button, 
	html .woocommerce a.single_add_to_cart_button.button, 
	html .woocommerce a.single_add_to_cart_button.button.alt, 
	html .woocommerce a.single_add_to_cart_button.button.alt,
	html .page  a.single_add_to_cart_button.button, 
	body .wd_logout.btn,
	html .woocommerce #content #payment input#place_order.button,
	html .woocommerce-page #content #payment input#place_order.button
		{
			background-color:@primary_button_background_color;
			border-color:@primary_button_border_color;
			color:@primary_button_text_color;
		}
	html .woocommerce button.single_add_to_cart_button.button:after, 
	html .woocommerce button.single_add_to_cart_button.button:after, 
	html .woocommerce button.single_add_to_cart_button.button.alt:after, 
	html .woocommerce button.single_add_to_cart_button.button.alt:after,
	html .page  button.single_add_to_cart_button.button:after
		{
			border-color:@primary_button_border_color!important
		}
	
	a.single_add_to_cart_button.button,
	html .woocommerce a.single_add_to_cart_button.button, 
	html .woocommerce a.single_add_to_cart_button.button, 
	html .woocommerce a.single_add_to_cart_button.button.alt, 
	html .woocommerce a.single_add_to_cart_button.button.alt,
	html .page  a.single_add_to_cart_button.button 
		{
			color:primary_button_text_color;
		}
	
	a.single_add_to_cart_button.button,
	html .woocommerce a.single_add_to_cart_button.button:hover, 
	html .woocommerce a.single_add_to_cart_button.button:hover, 
	html .woocommerce a.single_add_to_cart_button.button.alt:hover, 
	html .woocommerce a.single_add_to_cart_button.button.alt:hover,
	html .page  a.single_add_to_cart_button.button:hover 
		{
			color:primary_button_text_color_hover;
		}
	
	html .woocommerce button.single_add_to_cart_button.button:hover:after, 
	html .woocommerce button.single_add_to_cart_button.button:hover:after, 
	html .woocommerce button.single_add_to_cart_button.button.alt:hover:after, 
	html .woocommerce button.single_add_to_cart_button.button.alt:hover:after,
	html .page  button.single_add_to_cart_button.button:hover:after
		{
			border-color:@primary_button_border_color_hover!important;
		}
	
	button.button:hover, a.button:hover,input[type^=submit]:hover,
	html .woocommerce a.button:hover,html .woocommerce button.button:hover,
	html .woocommerce input.button:hover,html .woocommerce #respond input#submit:hover, 
	.woocommerce #content input.button:hover,html .woocommerce-page a.button:hover,
	html .woocommerce-page button.button:hover, .woocommerce-page input.button:hover,
	html .woocommerce-page #respond input#submit:hover, html .woocommerce-page #content input.button:hover,
	html .woocommerce-page #content input.button:hover, html .woocommerce #content table.cart input.button:hover,html input.button:hover,
	html .woocommerce .single_add_to_cart_button.button:hover:after, 
	html .woocommerce .single_add_to_cart_button.button:hover:after, 
	html .woocommerce .single_add_to_cart_button.button.alt:hover:after, 
	html .woocommerce .single_add_to_cart_button.button.alt:hover:after,
	html .home .single_add_to_cart_button.button:hover:after,
	html .page .single_add_to_cart_button.button:hover:after,
	.single_add_to_cart_button.button:hover:after,
	.cart_dropdown .buttons .checkout:hover,
	body .wd_logout.btn:hover,
	.woocommerce #content table.shop_table.cart tbody td.actions > p a.button:hover,
	.woocommerce-page #content table.shop_table.cart tbody td.actions > p a.button:hover,
	html .woocommerce #content .after_checkout_form form.checkout_coupon input.button:hover, 
	html .woocommerce-page #content .after_checkout_form form.checkout_coupon input.button:hover,
	html .woocommerce #content #payment input#place_order.button:hover,
	html .woocommerce-page #content #payment input#place_order.button:hover,
	html .woocommerce a.single_add_to_cart_button.button:hover, 
	html .woocommerce a.single_add_to_cart_button.button:hover, 
	html .woocommerce a.single_add_to_cart_button.button.alt:hover, 
	html .woocommerce a.single_add_to_cart_button.button.alt:hover,
	html .page  a.single_add_to_cart_button.button:hover 
		{
			background-color:@primary_button_background_color_hover;
			border-color:@primary_button_border_color_hover;
			color:@primary_button_text_color_hover;
		}
	
	

	
	ul.list-posts li .post-info-content .read-more:hover span span:before
		{
			color:@primary_button_background_color_hover;
		}
	html ul.list-posts li .post-info-content .read-more:hover span span
		{
			border-color:@primary_button_background_color_hover;
		}
	ul.list-posts li .post-info-content .read-more span span:before,
	html .woocommerce #content input.button.button_shipping_address_continue, 
	html .woocommerce-page #content input.button.button_shipping_address_continue,
	html .woocommerce #content input.button.button_review_order_continue, 
	html .woocommerce-page #content input.button.button_review_order_continue,
	html .woocommerce #customer_login.col2-set .col-2 input.button, 
	html .woocommerce-page #customer_login.col2-set .col-2 input.button,
	ul.list-posts li .post-info-content .read-more span span:before
		{
			color:@primary_button_background_color;
		}	
	ul.list-posts li .post-info-content .read-more:hover span span,
	html .woocommerce #content input.button.button_shipping_address_continue, 
	html .woocommerce-page #content input.button.button_shipping_address_continue,
	html .woocommerce #content input.button.button_review_order_continue, 
	html .woocommerce-page #content input.button.button_review_order_continue,
	html .woocommerce #customer_login.col2-set .col-2 input.button, 
	html .woocommerce-page #customer_login.col2-set .col-2 input.button,
	ul.list-posts li .post-info-content .read-more span span
		{
			border-color:@primary_button_background_color;
		}
	.archive-portfolio .end_content:before
		{
			background:@primary_button_background_color;
		}
	html .woocommerce #content input.button.button_shipping_address_continue, 
	html .woocommerce-page #content input.button.button_shipping_address_continue,
	html .woocommerce #content input.button.button_review_order_continue, 
	html .woocommerce-page #content input.button.button_review_order_continue,
	html .woocommerce #customer_login.col2-set .col-2 input.button, 
	html .woocommerce-page #customer_login.col2-set .col-2 input.button,
	.woocommerce #content table.shop_table.cart tbody td.actions input.button,
	.woocommerce-page #content table.shop_table.cart tbody td.actions input.button,
	.woocommerce #content .cart-collaterals .cart_totals .checkout-button,
	.woocommerce-page #content .cart-collaterals .cart_totals .checkout-button,
	html .woocommerce #content .wd_tabs_checkout .wd_tab-content .button_create_account_continue, 
	html .woocommerce-page #content .wd_tabs_checkout .wd_tab-content .button_create_account_continue,
	html .woocommerce #content form.checkout-resgister .button_billing_address_continue, 
	html .woocommerce-page #content form.checkout-resgister .button_billing_address_continue
		{
			background-color:@secondary_button_background_color;
			border-color:@secondary_button_border_color;
			color:@secondary_button_text_color;
		}
	html .woocommerce #content input.button.button_shipping_address_continue:hover, 
	html .woocommerce-page #content input.button.button_shipping_address_continue:hover,
	html .woocommerce #content input.button.button_review_order_continue:hover, 
	html .woocommerce-page #content input.button.button_review_order_continue:hover,
	html .woocommerce #customer_login.col2-set .col-2 input.button:hover, 
	html .woocommerce-page #customer_login.col2-set .col-2 input.button:hover,
	.woocommerce #content table.shop_table.cart tbody td.actions input.button:hover,
	.woocommerce-page #content table.shop_table.cart tbody td.actions input.button:hover,
	.woocommerce #content .cart-collaterals .cart_totals .checkout-button:hover,
	.woocommerce-page #content .cart-collaterals .cart_totals .checkout-button:hover,
	html .woocommerce #content .wd_tabs_checkout .wd_tab-content .button_create_account_continue:hover, 
	html .woocommerce-page #content .wd_tabs_checkout .wd_tab-content .button_create_account_continue:hover,
	html .woocommerce #content form.checkout-resgister .button_billing_address_continue:hover, 
	html .woocommerce-page #content form.checkout-resgister .button_billing_address_continue:hover
		{
			background-color:@secondary_button_background_color_hover;
			border-color:@secondary_button_border_color_hover;
			color:@secondary_button_text_color_hover;
		}

	
	/* BORDER COLOR */
	
	blockquote,.tags_social, #entry-author-info .author-inner,
	html .woocommerce ul.products li.product .product_thumbnail_wrapper:hover, 
	html .woocommerce-page ul.products li.product .product_thumbnail_wrapper:hover,
	body.woocommerce .upsells.products,
	.quote-style,
	.woocommerce #content .addresses header h3,
	.woocommerce-page #content .addresses header h3,
	html .woocommerce .after_checkout_form form.checkout_coupon #coupon_code, 
	html .woocommerce-page .after_checkout_form form.checkout_coupon #coupon_code,
	html .woocommerce .after_checkout_form form.checkout_coupon, 
	html .woocommerce-page .after_checkout_form form.checkout_coupon,
	.woocommerce #content .span12 table.shop_table.cart tbody tr.cart_table_item td .minus, 
	.woocommerce-page #content .span12 table.shop_table.cart tbody tr.cart_table_item td .minus,
	.woocommerce #content .span12 table.shop_table.cart tbody tr.cart_table_item td .plus, 
	.woocommerce-page #content .span12 table.shop_table.cart tbody tr.cart_table_item td .plus 
		{
			border-color:@primary_border_color;
		}
	@media 
		only screen and (max-width-device-width: 1024px),
		only screen and (max-width: 1024px) 
		{
			html .woocommerce ul.products li.product .product_thumbnail_wrapper, 
			html .woocommerce-page ul.products li.product .product_thumbnail_wrapper
				{
					border-color:@primary_border_color;
				}
		}
	#comments .commentlist li .divcomment .divcomment-inner .detail:after,
	body .accordion-heading a.accordion-toggle
		{
			background:@primary_color;
		}
	
	html input, textarea, html select,
	div.list_carousel div.caroufredsel_wrapper ul.product_thumbnails li a,
	div.list_carousel div.caroufredsel_wrapper ul.qs-thumbnails li a,
	.cart_dropdown ul.cart_list li a img.wp-post-image,
	.shopping-cart .cart_dropdown:before,
	html .woocommerce .related ul.products li.product .product_thumbnail_wrapper, 
	html .woocommerce-page .related ul.products li.product .product_thumbnail_wrapper .product_thumbnail_wrapper,
	html #header .woocommerce ul.products li.product .product_thumbnail_wrapper:after, 
	html #header .woocommerce-page ul.products li.product .product_thumbnail_wrapper:after
		{
			border-color:@secondary_border_color;
		}
	html input:hover, textarea:hover, 
	.tags_social .tags .tag-links a:hover,
	div.list_carousel div.caroufredsel_wrapper ul.product_thumbnails li a:hover,
	div.list_carousel div.caroufredsel_wrapper ul.qs-thumbnails li a:hover,
	body.woocommerce div.product div.images a.woocommerce-main-image:hover, 
	body.woocommerce-page div.product div.images a.woocommerce-main-image:hover, 
	body.woocommerce #content div.product div.images a.woocommerce-main-image:hover, 
	body.woocommerce-page #content div.product div.images a.woocommerce-main-image:hover,
	body.home div.product div.images a.woocommerce-main-image:hover,
	.cart_dropdown ul.cart_list li a img.wp-post-image:hover,
	div.list_carousel div.caroufredsel_wrapper ul.product_thumbnails li a:hover,
	div.list_carousel div.caroufredsel_wrapper ul.qs-thumbnails li a:hover,
	html .woocommerce .related ul.products li.product .product_thumbnail_wrapper:hover, 
	html .woocommerce-page .related ul.products li.product .product_thumbnail_wrapper .product_thumbnail_wrapper:hover,
	#header .bg_search:hover #s,
	html #header .woocommerce ul.products li.product .product_thumbnail_wrapper:hover:after, 
	html #header .woocommerce-page ul.products li.product .product_thumbnail_wrapper:hover:after
		{
			border-color:@secondary_border_color_hover;
		}
	.tags_social .tags .tag-links a:hover
		{
			color:@secondary_border_color_hover;
		}
	.tags_social .tags .tag-links a,
	body.woocommerce div.product div.images a.woocommerce-main-image, 
	body.woocommerce-page div.product div.images a.woocommerce-main-image, 
	body.woocommerce #content div.product div.images a.woocommerce-main-image, 
	body.woocommerce-page #content div.product div.images a.woocommerce-main-image,
	body.home div.product div.images a.woocommerce-main-image 
		{
			border-color:(@secondary_border_color - #0d0d0d);
		}

	/* TAB */
	
	.tabbable.tabs-left, .tabbable.tabs-right, .tabs-default[id^="multitabs"],
	div.product > .tabbable.tabs-left > .nav-tabs > li > a
		{
			border-color:@primary_tab_border_color;
		}
	div.product > .tabbable.tabs-left > .nav-tabs > li > a
		{
			color:@primary_tab_border_color;
		}
	.tabbable.tabs-left .nav-tabs li a, .tabbable.tabs-left .nav-tabs:after,
	.tabbable.tabs-right .nav-tabs li a , .tabbable.tabs-right .nav-tabs:after,
	.tabs-default[id^="multitabs"] > ul, 
	[id^=multitabs].tabs-default .nav-tabs li.active a,[id^=multitabs].tabs-default .nav-tabs li a:hover,
	div.product > .tabbable.tabs-left > .nav-tabs > li > a:hover, 
	div.product .tabbable.tabs-left .nav-tabs > li.active > a
		{
			background:@primary_tab_background_color;
		}
	.tabbable.tabs-left .nav-tabs li a, .tabbable.tabs-right .nav-tabs li a,
	.tabs-default[id^="multitabs"] .nav-tabs li a
		{
			color:@primary_tab_text_color;
		}
	.tabbable.tabs-left .nav-tabs li.active a, .tabbable.tabs-left .nav-tabs li a:hover,
	.tabbable.tabs-right .nav-tabs li.active a, .tabbable.tabs-right .nav-tabs li a:hover,
	[id^=multitabs].tabs-default .nav-tabs li.active a,[id^=multitabs].tabs-default .nav-tabs li a:hover,
	div.product > .tabbable.tabs-left > .nav-tabs > li > a:hover, 
	div.product .tabbable.tabs-left .nav-tabs > li.active > a
		{
			color:@primary_tab_active_text_color;
		}

/*==============================================================*/
/*                   ESPECIAL ELEMENT                           */
/*==============================================================*/

	/* FEEDBACK */
	
	.feedback-button
		{
			background-color:@feedback_background;
		}
	.feedback-button:hover
		{
			background-color:@feedback_background_hover;
		}

	/* BACK TO TOP */
	
	#to-top a
		{
			background-color:@totop_background;
		}
	#to-top a:hover
		{
			background-color:@totop_background_hover;
		}
		
	.star-rating, .woocommerce .star-rating:before, .woocommerce-page .star-rating:before
		{
			color:@rating_color;
		}

	/* SCROLL BAR */
		
	.nicescroll-rails > div 
		{
			background:@scollbar!important;
		}
	
	/* RATING */
	
	html .star-rating, html .woocommerce .star-rating:before, html .woocommerce-page .star-rating:before
		{
			color:@rating_color;
		}
	
	/* BUTTON CART */
	
	.woocommerce ul.products li.product .product_thumbnail_wrapper .list_add_to_cart a:after,
	.woocommerce-page ul.products li.product .product_thumbnail_wrapper .list_add_to_cart a:after
		{
			color:@cart_icon_color
		}
	.woocommerce ul.products li.product .product_thumbnail_wrapper .list_add_to_cart a:after, 
	.woocommerce-page ul.products li.product .product_thumbnail_wrapper .list_add_to_cart a:after
		{
			background-color:@cart_background_color;
		}
	.woocommerce ul.products li.product .product_thumbnail_wrapper .list_add_to_cart a:hover:after, 
	.woocommerce-page ul.products li.product .product_thumbnail_wrapper .list_add_to_cart a:hover:after
		{
			background-color:@cart_background_color_hover;
		}
	
	/* QUICK SHOP */
	
	#em_quickshop_handler
		{
			color:@quickshop_text_color;
			background-color:@quickshop_background_color;
		}
	#em_quickshop_handler:hover
		{
			background-color:@quickshop_background_color_hover;
		}
	
/*==============================================================*/
/*                     HEADER CUSTOM                            */
/*==============================================================*/

	/* HEADER TOP */

	#header .header-top,
	.shopping-cart .cart_dropdown:after,
	.wd_tini_account_wrapper .form_drop_down:after
		{
			background:@header_top_background;
		}

	.wd_tini_account_wrapper #loginform-custom, .cart_dropdown ul.cart_list
		{
			border-color:@header_top_background;
		}
		
	.shopping-cart
		{
			border-color:(@header_top_background + #404040);
		}
	.wd_tini_account_wrapper .form_wrapper_body > a:hover
		{
			color:@header_top_background;
		}

	.wd_tini_account_wrapper .wd_tini_account_control > a, 
	.shopping-cart .wd_tini_cart_control .cart_size a span
		{
			color:@header_top_link_color;
		}
	
	.wd_tini_account_wrapper .wd_tini_account_control > a:hover,
	.shopping-cart .wd_tini_cart_control .cart_size a:hover span 
		{
			color:@header_top_text_color;
		}
	
	.shopping-cart .wd_tini_cart_control span
		{
			color:@header_top_text_color;
		}
		
	ul.social-share li a span:hover 
		{
			background-color:@header_top_social_background_hover;
		}

	/* MENU */
	/* Menu level 01 */
	#header .nav > .main-menu > ul.menu > li > a > span
		{
			font-family:@font_menu;
			font-weight:@font_menu_fontweight;
			font-style:@font_menu_fontstyle;
		}

	/* Menu level n */
	.nav,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li a,
	html #header .woocommerce ul.products li.product .heading-title,
	html #header .nav .woocommerce .featured_product_slider_wrapper .featured_product_slider_wrapper_meta h3
		{
			font-family:@font_sub_menu;
			font-weight:@font_sub_menu_fontweight;
			font-style:@font_sub_menu_fontstyle;
		}

	/* Menu Text Color */
	#header .nav > .main-menu > ul.menu > li > a > span
		{
			color:@header_menu_text_color;
		}
	@media 
		only screen and (max-width-device-width: 480px),
		only screen and (max-width: 480px) 
		{
			#header .nav > .main-menu > ul.menu > li:hover > a > span.menu-label-level-0 {color:@header_menu_text_color!important;}
		}
		
	#header .nav > .main-menu > ul.menu > li:hover > a > span.menu-label-level-0,
	#header .nav > .main-menu > ul.menu > li.current-menu-item > a > span.menu-label-level-0,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li.li_active > a ,
		#header .nav > .main-menu > ul.menu > li.wd-fly-menu li.current_page_item > a 
		{
			color:@header_menu_active_text_color;
		}
		
	@media 
		only screen and (max-width-device-width: 480px),
		only screen and (max-width: 480px) 
		{	
			#header .nav > .main-menu > ul.menu > li.current-menu-item > a > span.menu-label-level-0 {color:@header_menu_active_text_color!important;}
		}
	@media 
	only screen and (max-width-device-width: 767px),
	only screen and (max-width: 767px) 
		{
			#header .nav > .main-menu > ul.menu > li:hover > a > span.menu-label-level-0, 
			#header .nav > .main-menu > ul.menu > li.current-menu-item > a > span.menu-label-level-0 
				{
					color:@header_submenu_link_color;
				}
		}

	/* Sub Menu Border Color */
	#header .nav > .main-menu > ul.menu > li > ul:before ,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu ul.sub-menu:before
		{
			background:@header_submenu_border_top_color;
		}
	
	#header .nav > .main-menu > ul.menu > li > ul,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu ul.sub-menu:after
		{
			border-color:@header_submenu_border_color;
		}
	@media 
	only screen and (max-width-device-width: 767px),
	only screen and (max-width: 767px)
		{
			#header #menu-main-menu {border-color:@header_submenu_border_color}
		}
		
	/* Submenu Link color */
	.nav a,
	#header .nav > .main-menu > ul.menu > li .menu > li .textwidget a, #header .nav ins .amount
		{
			color:@header_submenu_link_color;
		}
		
	/* Submenu Text color */
	.nav,
	html .nav .woocommerce ul.products li.product .price .from, 
	html .woocommerce-page .nav ul.products li.product .price .from, 
	html .nav .woocommerce ul.products li.product .price .to, 
	html .woocommerce-page .nav ul.products li.product .price .to, 
	html .home .nav ul.products li.product .price .from, 
	html .home .nav ul.products li.product .price .to,
	.nav .woocommerce .product_sku, 
	.woocommerce-page .nav .product_sku,
	html .nav .woocommerce ul.products li.product .wd_product_categories a,
	html .nav .woocommerce ul.products li.product .price, 
	html .woocommerce-page .nav ul.products li.product .price, 
	html .nav .woocommerce div.product span.price, 
	html .nav .woocommerce div.product p.price, 
	html .woocommerce-page .nav div.product span.price, 
	html .woocommerce-page .nav div.product p.price, 
	html .home .nav ul.products li.product .price,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li a,
	#header .nav > .main-menu > ul.menu > li .textwidget ul.menu a
		{
			color:@header_submenu_text_color;
		}		
	/* Sub Menu hover item Color */
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li:hover > a:before,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li.current-menu-item > a:before,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li.current_page_item > a:before
		{
			/*background-color:@header_submenu_hover_item_color;*/
		}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li:hover > a > span,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li.current-menu-item > a > span,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li.current_page_item > a > span,
	#header .nav > .main-menu > ul.menu > li .textwidget ul.menu li.current-menu-item a
		{
			color:@header_submenu_hover_item_color;
		}
	.nav a:hover,
	#header .nav > .main-menu > ul.menu > li .menu > li a:hover,
	html #header .woocommerce ul.products li.product .heading-title a:hover,
	html .nav .woocommerce ul.products li.product a:hover, 
	html .woocommerce-page .nav ul.products li.product a:hover,
	#header .nav > .main-menu > ul.menu li.wd-mega-menu li:hover > a,
	#header .nav > .main-menu > ul.menu > li li.current-menu-item > a,
	#header .nav > .main-menu > ul.menu > li li.current-page-item > a
		{
			color:@header_submenu_hover_item_color;
		}

/*==============================================================*/
/*                     FOOTER CUSTOM                            */
/*==============================================================*/		

	/* Fisrt Footer Widget Area */		
	#footer .first-footer-widget-area
		{
			background-color:@footer_first_area_background_color;
		}
	
	.first-footer-widget-area,
	.second-footer-widget-area .estimonial-item .twitter_follow a.second,
	.first-footer-widget-area .widget_tag_cloud .tagcloud a,
	.first-footer-widget-area .widget_product_tag_cloud .tagcloud a,
	html .first-footer-widget-area input
		{
			color:@footer_first_area_text_color;
		}
	.first-footer-widget-area .widget_tag_cloud .tagcloud a,
	.first-footer-widget-area .widget_product_tag_cloud .tagcloud a
		{
			border-color:@footer_first_area_text_color;
		}
	
	.first-footer-widget-area a,
	html .first-footer-widget-area .woocommerce ul.cart_list li span.amount, 
	html .first-footer-widget-area .woocommerce ul.product_list_widget li span.amount, 
	html .woocommerce-page .first-footer-widget-area ul.cart_list li span.amount, 
	html .woocommerce-page .first-footer-widget-area ul.product_list_widget li span.amount,
	.estimonial-item .twitter_follow a.second:hover,
	.first-footer-widget-area .wpcf7
		{
			color:@footer_first_area_link_color;
		}
	.first-footer-widget-area a:hover,
	.first-footer-widget-area .widget_tag_cloud .tagcloud a:hover,
	.first-footer-widget-area .widget_product_tag_cloud .tagcloud a:hover
		{
			color:@footer_first_area_link_color_hover;
		}
	.first-footer-widget-area .widget_tag_cloud .tagcloud a:hover,
	.first-footer-widget-area .widget_product_tag_cloud .tagcloud a:hover
		{
			border-color:@footer_first_area_link_color_hover;
		}
		
	.first-footer-widget-area h3.widget-title
		{
			color:@footer_first_area_heading_color;
		}
	.first-footer-widget-area h3.widget-title
		{
			border-color:(@footer_first_area_heading_color + #959795);
		}
	html #footer .first-footer-widget-area .woocommerce ul.cart_list li img, 
	html #footer .first-footer-widget-area .woocommerce ul.product_list_widget li img, 
	html .woocommerce-page #footer .first-footer-widget-area ul.cart_list li img, 
	html .woocommerce-page #footer .first-footer-widget-area ul.product_list_widget li img,
	.first-footer-widget-area .widget_flickr div.flickr_badge_image a img,
	html #footer .woocommerce ul.product_list_widget li img, 
	html #footer .widget_hot_product ul.popular-post-list img
		{
			border-color:@footer_first_area_border_color;
		}
	.first-footer-widget-area .widget_customrecent ul li .entry-meta .entry-date-day,
	.first-footer-widget-area .widget_flickr div.flickr_badge_image a img:hover
		{
			border-color:(@footer_first_area_border_color - #292d2d);
		}
	
	/* Second Footer Widget Area */
	#footer .second-footer-widget-area
		{
			background-color:@footer_second_area_background_color;
		}
	.second-footer-widget-area,
	.second-footer-widget-area .estimonial-item .detail h3 .job,
	.about-us h3 span,
	.estimonial-item .twitter_follow a.second,
	.second-footer-widget-area .widget_tag_cloud .tagcloud a,
	.second-footer-widget-area .widget_product_tag_cloud .tagcloud a,
	html .second-footer-widget-area input
		{
			color:@footer_second_area_text_color;
		}
	.second-footer-widget-area .widget_tag_cloud .tagcloud a,
	.second-footer-widget-area .widget_product_tag_cloud .tagcloud a
		{
			border-color:@footer_second_area_text_color;
		}
	
	.about-us .address .add-1
		{
			color:(@footer_second_area_text_color + #1d1d1d);
		}
	.second-footer-widget-area a,
	html .second-footer-widget-area .woocommerce ul.cart_list li span.amount, 
	html .second-footer-widget-area .woocommerce ul.product_list_widget li span.amount, 
	html .woocommerce-page .second-footer-widget-area ul.cart_list li span.amount, 
	html .woocommerce-page .second-footer-widget-area ul.product_list_widget li span.amount,
	.second-footer-widget-area .estimonial-item .twitter_follow a.first:hover:before,
	.second-footer-widget-area .estimonial-item .twitter_follow a.first:hover,
	.second-footer-widget-area .estimonial-item .twitter_follow a.second:hover,
	.second-footer-widget-area .wpcf7
		{
			color:@footer_second_area_link_color;
		}
	.second-footer-widget-area .estimonial-item .twitter_follow a.first:hover
		{
			border-color:@footer_second_area_link_color;
		}
	.second-footer-widget-area a:hover,
	.second-footer-widget-area .widget_tag_cloud .tagcloud a:hover,
	.second-footer-widget-area .widget_product_tag_cloud .tagcloud a:hover
		{
			color:@footer_second_area_link_color_hover;
		}
	.second-footer-widget-area .widget_tag_cloud .tagcloud a:hover,
	.second-footer-widget-area .widget_product_tag_cloud .tagcloud a:hover
		{
			border-color:@footer_second_area_link_color_hover;
		}
		
	.second-footer-widget-area h3.widget-title,
	#footer .second-footer-widget-area h3
		{
			color:@footer_second_area_heading_color;
		}
	.second-footer-widget-area h3.widget-title,
	.second-footer-widget-area .estimonial-item .twitter_follow a.first
		{
			border-color:(@footer_second_area_heading_color - #959795);
		}
	.second-footer-widget-area .estimonial-item .twitter_follow a.first:before
		{
			color:@footer_second_area_text_color;
		}
	html #footer .second-footer-widget-area .woocommerce ul.cart_list li img, 
	html #footer .second-footer-widget-area .woocommerce ul.product_list_widget li img, 
	html .woocommerce-page #footer .second-footer-widget-area ul.cart_list li img, 
	html .woocommerce-page #footer .second-footer-widget-area ul.product_list_widget li img,
	.second-footer-widget-area .widget_flickr div.flickr_badge_image a img 
		{
			border-color:@footer_second_area_border_color;
		}
	.second-footer-widget-area .widget_customrecent ul li .entry-meta .entry-date-day
		{
			border-color:(@footer_second_area_border_color - #292d2d);
		}
	
		
	/* Thrid Footer Widget Area */
	#footer .wd_footer_end 	
		{
			background-color:@footer_thrid_area_background_color;
		}
	#footer .wd_footer_end,
	#footer .wd_footer_end > div #copy-right a
		{
			color:@footer_thrid_area_text_color;
		}
	#footer .wd_footer_end > div #copy-right a:hover
		{
			color:@footer_thrid_area_link_color_hover;
		}
	#footer .wd_footer_end > div:after
		{
			background:@footer_thrid_area_border_color;
		}
	#footer .wd_footer_end > div
		{
			border-color:@footer_thrid_area_border_color;
		}
	#footer .wd_footer_end > div #copy-right:after
		{
			background:@footer_thrid_area_border_color;
		}

/*==============================================================*/
/*                     SIDEBAR CUSTOM                           */
/*==============================================================*/
		
	.left-sidebar-content h1, .left-sidebar-content h2, .left-sidebar-content h3, .left-sidebar-content h4, .left-sidebar-content h5, .left-sidebar-content h6,
	.right-sidebar-content h1, .right-sidebar-content h2, .right-sidebar-content h3, .right-sidebar-content h4, .right-sidebar-content h5, .right-sidebar-content h6,
	a.block-control:before
		{
			color:@sidebar_heading_color;
		}
	.left-sidebar-content h3.widget-title,.right-sidebar-content h3.widget-title
		{
			border-color:@sidebar_heading_color;
		}
	.left-sidebar-content, .right-sidebar-content,
	.left-sidebar-content .widget_layered_nav ul li a,.right-sidebar-content .widget_layered_nav ul li a,
	.left-sidebar-content blockquote, .right-sidebar-content blockquote,
	.left-sidebar-content .woocommerce .product_sku, 
	.right-sidebar-content .woocommerce .product_sku,
	.left-sidebar-content .woocommerce .widget_layered_nav_filters ul li a, .right-sidebar-content .woocommerce .widget_layered_nav_filters ul li a,
	.woocommerce-page .left-sidebar-content .widget_layered_nav_filters ul li a, .woocommerce-page .right-sidebar-content .widget_layered_nav_filters ul li a,
	.left-sidebar-content .woocommerce .widget_layered_nav_filters ul li.chosen a, .woocommerce-page .left-sidebar-content .widget_layered_nav_filters ul li.chosen a, 
	.left-sidebar-content .woocommerce .widget-container.widget_layered_nav ul li.chosen a, .woocommerce-page .left-sidebar-content .widget_layered_nav ul li.chosen a,
	.right-sidebar-content .woocommerce .widget_layered_nav_filters ul li.chosen a, .woocommerce-page .right-sidebar-content .widget_layered_nav_filters ul li.chosen a, 
	.right-sidebar-content .woocommerce .widget-container.widget_layered_nav ul li.chosen a, .woocommerce-page .right-sidebar-content .widget_layered_nav ul li.chosen a,
	html .left-sidebar-content input , html .right-sidebar-content input 
		{
			color:@sidebar_text_color;
		}
	.left-sidebar-content .widget_recent_comments_custom .comment-meta span,
	.right-sidebar-content .widget_recent_comments_custom .comment-meta span,
	#main-module-container .left-sidebar-content .widget_recent_post_slider .author,
	#main-module-container .right-sidebar-content .widget_recent_post_slider .author,
	html .left-sidebar-content .woocommerce ul.cart_list li .total, html .right-sidebar-content .woocommerce ul.cart_list li .total, 
	html .left-sidebar-content .woocommerce ul.product_list_widget li .total, html .right-sidebar-content .woocommerce ul.product_list_widget li .total, 
	html .left-sidebar-content .widget_shopping_cart .total strong, html .right-sidebar-content .widget_shopping_cart .total strong,
	html .left-sidebar-content .widget_shopping_cart .amount, html .right-sidebar-content .widget_shopping_cart .amount,
	.left-sidebar-content #searchform .bg_search #s, .right-sidebar-content #searchform .bg_search #s,
	html .left-sidebar-content .woocommerce ul.products li.product .price del, html .right-sidebar-content .woocommerce ul.products li.product .price del, 
	html .woocommerce-page .left-sidebar-content ul.products li.product .price del, html .woocommerce-page .right-sidebar-content ul.products li.product .price del,
	html .left-sidebar-content .woocommerce div.product span.price del, html .right-sidebar-content .woocommerce div.product span.price del, 
	html .left-sidebar-content .woocommerce div.product p.price del, html .right-sidebar-content .woocommerce div.product p.price del, 
	html .woocommerce #content .left-sidebar-content div.product span.price del, html .woocommerce #content .right-sidebar-content div.product span.price del, 
	html .woocommerce .left-sidebar-content #content div.product p.price del, html .woocommerce .right-sidebar-content #content div.product p.price del, 
	html .woocommerce-page .left-sidebar-content div.product span.price del, html .woocommerce-page .right-sidebar-content div.product span.price del, 
	html .woocommerce-page .left-sidebar-content div.product p.price del, html .woocommerce-page .right-sidebar-content div.product p.price del, 
	html .woocommerce-page #content .left-sidebar-content div.product span.price del, html .woocommerce-page #content .right-sidebar-content div.product span.price del, 
	html .woocommerce-page #content .left-sidebar-content div.product p.price del, html .woocommerce-page #content .right-sidebar-content div.product p.price del,
	.left-sidebar-content div.product p.price del , .right-sidebar-content div.product p.price del 
		{
			color:(@sidebar_text_color + #333333);
		}
	.left-sidebar-content .widget_tag_cloud .tagcloud a,
	.right-sidebar-content .widget_tag_cloud .tagcloud a,
	.left-sidebar-content .widget_product_tag_cloud .tagcloud a,
	.right-sidebar-content .widget_product_tag_cloud .tagcloud a,
	html .left-sidebar-content input[type^="text"], html .right-sidebar-content input[type^="text"],
	html .left-sidebar-content input[type^="password"], html .right-sidebar-content input[type^="password"]
		{
			border-color:(@sidebar_text_color + #333333);
			color:(@sidebar_text_color + #333333);
		}
	.left-sidebar-content .widget_tag_cloud .tagcloud a:hover,
	.right-sidebar-content .widget_tag_cloud .tagcloud a:hover,
	.left-sidebar-content .widget_product_tag_cloud .tagcloud a:hover,
	.right-sidebar-content .widget_product_tag_cloud .tagcloud a:hover,
	.left-sidebar-content .widget_layered_nav_filters ul li.chosen a:hover
		{
			border-color:@sidebar_link_color;
			color:@sidebar_link_color;
		}
	
	.left-sidebar-content a, .right-sidebar-content a, 
	.left-sidebar-content .widget_recent_comments_custom ul li .recent_comments_count, .right-sidebar-content .widget_recent_comments_custom ul li .recent_comments_count,
	html .left-sidebar-content .woocommerce ul.cart_list li .quantity, html .right-sidebar-content .woocommerce ul.cart_list li .quantity, 
	html .left-sidebar-content .woocommerce ul.product_list_widget li .quantity, html .right-sidebar-content .woocommerce ul.product_list_widget li .quantity,
	html .left-sidebar-content .woocommerce ul.cart_list li span.amount, html .right-sidebar-content .woocommerce ul.cart_list li span.amount, 
	html .left-sidebar-content .woocommerce ul.product_list_widget li span.amount, html .right-sidebar-content .woocommerce ul.product_list_widget li span.amount,
	html .left-sidebar-content .woocommerce.widget_price_filter .price_slider_amount .price_label,
	html .right-sidebar-content .woocommerce.widget_price_filter .price_slider_amount .price_label, 
	html .left-sidebar-content .woocommerce.widget_price_filter .price_slider_amount .price_label span,
	html .right-sidebar-content .woocommerce.widget_price_filter .price_slider_amount .price_label span,
	.left-sidebar-content #wp-calendar caption, .right-sidebar-content #wp-calendar caption,
	.left-sidebar-content #wp-calendar tbody td a, .right-sidebar-content #wp-calendar tfoot td a,
	.left-sidebar-content .widget_popular ul li .amount, .widget_hot_product ul li .amount,
	.right-sidebar-content .widget_popular ul li .amount, .widget_hot_product ul li .amount
		{
			color:@sidebar_link_color;
		}
	.left-sidebar-content a:hover, .right-sidebar-content a:hover,
	.left-sidebar-content .widget_layered_nav ul li a:hover,.right-sidebar-content .widget_layered_nav ul li a:hover,
	.left-sidebar-content .woocommerce a:hover > .product_sku, 
	.right-sidebar-content .woocommerce a:hover > .product_sku,
	.left-sidebar-content .widget_custom_pages ul li.current_page_item a, .right-sidebar-content .widget_custom_pages ul li.current_page_item a
		{
			color:@sidebar_link_color_hover;
		}
	
	.left-sidebar-content .widget_popular ul li .image, .left-sidebar-content .widget_hot_product ul li .image,
	.right-sidebar-content .widget_popular ul li .image, .right-sidebar-content .widget_hot_product ul li .image,
	.left-sidebar-content .widget_twitterupdate ul li.status-item, .right-sidebar-content .widget_twitterupdate ul li.status-item,
	html .left-sidebar-content .woocommerce ul.cart_list li img, html .left-sidebar-content .woocommerce ul.product_list_widget li img, 
	html .right-sidebar-content .woocommerce ul.cart_list li img, html .right-sidebar-content .woocommerce ul.product_list_widget li img, 
	.left-sidebar-content .widget_search .bg_search, .right-sidebar-content .widget_search .bg_search,
	.left-sidebar-content #calendar_wrap, .right-sidebar-content #calendar_wrap,
	.left-sidebar-content blockquote, .right-sidebar-content blockquote,
	.left-sidebar-content .widget_flickr div.flickr_badge_image a img, .right-sidebar-content .widget_flickr div.flickr_badge_image a img,
	.related ul.products li.product .product_thumbnail_wrapper:after
		{
			border-color:@sidebar_border_color;
		}
	html  .related .woocommerce ul.products li.product .product_thumbnail_wrapper:after, 
	html .woocommerce-page .related ul.products li.product .product_thumbnail_wrapper:after
		{
			border-color:@sidebar_border_color!important;
		}
		
	.left-sidebar-content .widget_search .bg_search, .right-sidebar-content .widget_search .bg_search,
	.left-sidebar-content .widget_popular ul li .image:hover, .left-sidebar-content .widget_hot_product ul li .image:hover,
	.right-sidebar-content .widget_popular ul li .image:hover, .right-sidebar-content .widget_hot_product ul li .image:hover,
	html .left-sidebar-content  .woocommerce ul.cart_list li img:hover, html .left-sidebar-content  .woocommerce ul.product_list_widget li img:hover, 
	html .woocommerce-page .left-sidebar-content  ul.cart_list li img:hover, html .woocommerce-page .left-sidebar-content  ul.product_list_widget li img:hover,
	html .right-sidebar-content  .woocommerce ul.cart_list li img:hover, html .right-sidebar-content  .woocommerce ul.product_list_widget li img:hover, 
	html .woocommerce-page .right-sidebar-content  ul.cart_list li img:hover, html .woocommerce-page .right-sidebar-content  ul.product_list_widget li img:hover
		{
			border-color:@sidebar_link_color;
		}
	.left-sidebar-content .widget_flickr div.flickr_badge_image a img:hover, .right-sidebar-content .widget_flickr div.flickr_badge_image a img:hover
		{
			border-color:@sidebar_link_color;
		}
		
/* =========================================================================== */
/*                          PRIMARY COLOR                                      */
/* =========================================================================== */

	.page_navi .wp-pagenavi span.current,
	.page_navi .wp-pagenavi span:hover, .page_navi .wp-pagenavi a:hover,
	.portfolio-filter,
	#container .gridlist-toggle a:hover, #container .gridlist-toggle a.active,
	#container .gridlist-toggle a#grid:hover, #container .gridlist-toggle a#grid.active,
	.woocommerce #content table.shop_table.cart thead th, .woocommerce-page #content table.shop_table.cart thead th,
	.woocommerce #content table.my_account_orders th, .woocommerce-page #content table.my_account_orders th,
	.woocommerce #content .order_details thead th, .woocommerce-page #content .order_details thead th,
	html div.pp_woocommerce .pp_close,
	.woocommerce .widget-container.widget_price_filter .ui-slider .ui-slider-range, 
	.woocommerce-page .widget-container.widget_price_filter .ui-slider .ui-slider-range
		{
			background-color:@primary_color;
		}
	.page_navi .wp-pagenavi a.nextpostslink:before,
	.page_navi .wp-pagenavi a.nextpostslink:after,
	.page_navi .wp-pagenavi a.previouspostslink:before,
	.page_navi .wp-pagenavi a.previouspostslink:after,
	.page_navi .wp-pagenavi span, .page_navi .wp-pagenavi a
		{
			color:@primary_color;
		}
	.woocommerce #content table.my_account_orders td, .woocommerce-page #content table.my_account_orders td,
	.woocommerce #content table.my_account_orders, .woocommerce-page #content table.my_account_orders,
	.woocommerce #content table.shop_table.cart thead th, .woocommerce-page #content table.shop_table.cart thead th,
	.woocommerce #content table.shop_table.cart tbody tr.cart_table_item td, .woocommerce-page #content table.shop_table.cart tbody tr.cart_table_item td,
	.woocommerce #content table.shop_table.cart thead th.product-thumbnail, .woocommerce-page #content table.shop_table.cart thead th.product-thumbnail,
	.woocommerce #content .order_details tbody td, .woocommerce-page #content .order_details tbody td
		{
			border-color:@primary_color;
		}
	
	.wd_tabs_checkout .nav-tabs > li.active > a, .wd_tabs_checkout .nav-tabs > li > a:hover, body .accordion-heading a.accordion-toggle:before,
	html div.pp_woocommerce .pp_close:hover
		{
			background-color:@secondary_color;
		}
	
			<?php 
			$file = @fopen($cache_file, 'w');
			if( $file != false ){
				@fwrite($file, ob_get_contents()); 
				@fclose($file); 
			}else{
				define('USING_CSS_CACHE', false);
			}
			update_option(THEME_SLUG.'custom_style', ob_get_contents());
			//ob_end_flush();		
			ob_end_clean();
			
			return USING_CSS_CACHE == true ? 1 : 0;
		}catch(Excetion $e){
			// $result = new StdClass();
			// $result->status = array();
			// return $result;
			return -1;
		}
	}
		
	function wd_load_gg_fonts() {
		global $wd_font_name,$wd_font_size;	
		$font_size_str = "";
		if( isset($wd_font_size) && strlen($wd_font_size) > 0 ){
			$font_size_str = ":{$wd_font_size}";
		}
		if( isset($wd_font_name) && strlen( $wd_font_name ) > 0 ){
			$font_name_id = strtolower($wd_font_name);
			$protocol = is_ssl() ? 'https' : 'http';
			wp_enqueue_style( "techgo-{$font_name_id}", "{$protocol}://fonts.googleapis.com/css?family={$wd_font_name}{$font_size_str}" );		
		}
	}		
		
	function custom_style_inline_script(){
		global $default_custom_style_config;
		$custom_style_config = get_option(THEME_SLUG.'custom_style_config','');
		$custom_style_config_arr = unserialize($custom_style_config);
		$custom_style_config_arr = wd_array_atts($default_custom_style_config,$custom_style_config_arr);	
	

	
		$enable_custom_font = (int) $custom_style_config_arr['enable_custom_font'];
		$enable_custom_color = (int) $custom_style_config_arr['enable_custom_color'];
		$body_font = $custom_style_config_arr['body_font_name'];
		$body_font  = str_replace( " ", "+", $body_font );
		$body_font_weight = $custom_style_config_arr['body_font_weight'];
	   
		$heading_font = $custom_style_config_arr['heading_font_name'];
		$heading_font  = str_replace( " ", "+", $heading_font );
		$heading_font_weight = $custom_style_config_arr['heading_font_weight'];	
		
		$menu_font = $custom_style_config_arr['menu_font_name'];
		$menu_font  = str_replace( " ", "+", $menu_font );
		$menu_font_weight = $custom_style_config_arr['menu_font_weight'];			
		
		$sub_menu_font = $custom_style_config_arr['sub_menu_font_name'];
		$sub_menu_font  = str_replace( " ", "+", $sub_menu_font );
		$sub_menu_font_weight = $custom_style_config_arr['sub_menu_font_weight'];		
			
		global $wd_font_name,$wd_font_size;	
			
		if( $enable_custom_font ){
			if( strlen($body_font) > 0 && (int)$body_font != -1 ){?>
				<?php 
					$wd_font_name = trim( $body_font );
					$wd_font_size = trim( $body_font_weight );
					wd_load_gg_fonts();
				?>
			<?php }
			if( strlen($heading_font) > 0 && (int)$heading_font != -1 ){?>
				<?php 
					$wd_font_name = trim( $heading_font );
					$wd_font_size = trim( $heading_font_weight );
					wd_load_gg_fonts();
				?>
			<?php }			
			if( strlen($menu_font) > 0 && (int)$menu_font != -1 ){?>
				<?php 
					$wd_font_name = trim( $menu_font );
					$wd_font_size = trim( $menu_font_weight );
					wd_load_gg_fonts();
				?>
			<?php }
			if( strlen($sub_menu_font) > 0 && (int)$sub_menu_font != -1 ){?>
				<?php 
					$wd_font_name = trim( $sub_menu_font );
					$wd_font_size = trim( $sub_menu_font_weight );
					wd_load_gg_fonts();
				?>
			<?php }
		}
		if( USING_CSS_CACHE == false ){
			global $custom_style;
			echo '<style type="text/css">';
			echo get_option(THEME_SLUG.'custom_style', '');
			echo '</style>';
		}		
		
	}
		
			
		
	function include_cache_css(){
		$custom_cache_file = THEME_CACHE.'custom.less';
		$custom_cache_file_uri = THEME_URI.'/cache_theme/custom.less';
		if (file_exists($custom_cache_file)) {
			wp_register_style( 'custom-style',$custom_cache_file_uri );
			wp_enqueue_style('custom-style');
			wp_dequeue_style('custom');
		}
		
	}
	
	global $default_custom_style_config,$wd_custom_style_config;
	// $custom_style_config = get_option(THEME_SLUG.'custom_style_config','');
	// $custom_style_config_arr = unserialize($custom_style_config);
	// $custom_style_config_arr = wd_array_atts($default_custom_style_config,$custom_style_config_arr);	
	
	$custom_style_config_arr = $wd_custom_style_config;
	
	$enable_custom_font = (int) $custom_style_config_arr['enable_custom_font'];
	$enable_custom_color = (int) $custom_style_config_arr['enable_custom_color'];
		
	
	if( USING_CSS_CACHE == true && ( $enable_custom_font || $enable_custom_color ) ){
		add_action('wp_enqueue_scripts','include_cache_css',10000000000000);
	}	
?>