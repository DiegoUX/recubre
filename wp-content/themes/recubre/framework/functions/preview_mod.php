<?php
	function font_string_to_font_obj( $font_name = "" ,$font_style_str = "" ,$font_size = "" ){
		if( strlen( $font_style_str ) > 0 ){
			$font_weight = strcmp( $font_style_str,'regular' ) == 0 ? '400' : $font_style_str;
			$font_weight = strcmp( $font_style_str,'italic' ) == 0 ? '400italic' : $font_style_str;
			$font_style = strpos($font_weight, 'italic') == false ? 'normal' : 'italic';
			$font_weight = str_replace( "italic", "", $font_weight );
			return $ret = array(
								"font_name" => $font_name
								,"font_weight" => $font_weight
								,"font_style" => $font_style
								,"font_size" => $font_size
							);
		}
		return $ret = array(
							"font_name" => $font_name
							,"font_weight" => ""
							,"font_style" => ""
							,"font_size" => $font_size		
		);
	}

	global $default_custom_style_config,$wd_custom_style_config;
	$default_custom_style_config = array(
						'enable_custom_preview' 		=> 0
						,'enable_custom_font' 			=> 0
						,'enable_custom_color' 			=> 0
						,'page_layout' 					=> 'wide'
						,'font_sort' 					=>  "popularity"
						
						/******** Body font *******/
						,"body_font_name" 				=> "-1"
						,"body_font_style"				=> "normal"
						,"body_font_style_str" 			=> ""
						,"body_font_weight" 			=> "normal"

						
						/******** Heading font *******/
						,"heading_font_name" 			=> "-1"
						,"heading_font_style" 			=> "normal"
						,"heading_font_style_str" 		=> ""
						,"heading_font_weight" 			=> "normal"	
						
						/******** Menu font *******/
						,"menu_font_name" 				=> "-1"
						,"menu_font_style" 				=> "normal"
						,"menu_font_style_str" 			=> ""
						,"menu_font_weight" 			=> "normal"
						
						/******** Menu font *******/
						,"sub_menu_font_name" 				=> "-1"
						,"sub_menu_font_style" 				=> "normal"
						,"sub_menu_font_style_str" 			=> ""
						,"sub_menu_font_weight" 			=> "normal"

						,'primary_color' 					=> "#000"
						,'secondary_color' 					=> "#BE0404"

						,'header_top_background' => '#000' 
						,'header_top_text_color' => '#fff' 
						,'header_top_link_color' => '#999' 
						,'header_top_social_background_hover' => '#fff' 
						,'header_menu_text_color' => '#999' 
						,'header_menu_active_text_color' => '#000' 
						,'header_submenu_text_color' => '#666' 
						,'header_submenu_link_color' => '#000' 
						,'header_submenu_border_top_color' => '#000' 
						,'header_submenu_border_color' => '#d7d7d7' 
						,'header_submenu_hover_item_color' => '#000' 
						
						
						,'footer_first_area_background_color' => 'rgba(0,0,0,0.08)' 
						,'footer_first_area_text_color' => '#666' 
						,'footer_first_area_link_color' => '#000' 
						,'footer_first_area_link_color_hover' => '#BE0404' 		
						,'footer_first_area_heading_color' => '#000' 
						,'footer_first_area_border_color' => '#c1bfc0' 

						,'footer_second_area_background_color' => '#000' 
						,'footer_second_area_text_color' => '#666' 
						,'footer_second_area_link_color' => '#fff' 
						,'footer_second_area_link_color_hover' => '#BE0404' 		
						,'footer_second_area_heading_color' => '#fff' 
						,'footer_second_area_border_color' => '#c0c0bf' 

						,'footer_thrid_area_background_color' => '#000' 
						,'footer_thrid_area_text_color' => '#666' 
						,'footer_thrid_area_link_color' => '#666' 
						,'footer_thrid_area_link_color_hover' => '#fff' 		
						,'footer_thrid_area_border_color' => '#212121' 						
						
						,'sidebar_text_color' => '#666'
						,'sidebar_link_color' => '#000'
						,'sidebar_link_color_hover' => '#BE0404'
						,'sidebar_heading_color' => '#000'
						,'sidebar_border_color' => '#cfcfcf'
	

						,'primary_text_color' => '#666'
						,'primary_link_color' => '#000'
						,'primary_link_color_hover' => '#BE0404'
						,'primary_heading_color' => '#000'		
						,'primary_button_background_color' => '#000'
						,'primary_button_border_color' => '#000'
						,'primary_button_text_color' => '#fff'
						,'primary_button_background_color_hover' => '#BE0404'
						,'primary_button_border_color_hover' => '#BE0404'
						,'primary_button_text_color_hover' => '#fff'
						,'secondary_button_background_color' => '#fff'
						,'secondary_button_border_color' => '#000'		
						,'secondary_button_text_color' => '#000'
						,'secondary_button_background_color_hover' => '#fff'
						,'secondary_button_border_color_hover' => '#BE0404'
						,'secondary_button_text_color_hover' => '#BE0404'
						
						,'primary_border_color' => '#000'
						,'primary_border_color_hover' => '#BE0404'
						,'secondary_border_color' => '#d9d9d9'
						,'secondary_border_color_hover' => '#000'		
						,'primary_tab_background_color' => '#000'
						,'primary_tab_border_color' => '#000'
						,'primary_tab_text_color' => '#666'
						,'primary_tab_active_text_color' => '#fff'

						,'cart_icon_color' => '#fff' 
						,'cart_background_color' => '#000' 
						,'cart_background_color_hover' => '#BE0404' 
						,'feedback_background' => '#000' 
						,'feedback_background_hover' => '#BE0404' 
						,'totop_background' => '#000' 		
						,'totop_background_hover' => '#BE0404' 
						,'scollbar' => '#000' 
						,'rating_color' => '#000' 
						,'quickshop_text_color' => '#fff' 
						,'quickshop_background_color' => '#000' 		
						,'quickshop_background_color_hover' => '#BE0404'		
	);	

	$wd_custom_style_config = get_option(THEME_SLUG.'custom_style_config','');
	$wd_custom_style_config = unserialize($wd_custom_style_config);
	if( !is_array($wd_custom_style_config) ){
		$wd_custom_style_config = array();
	}
	$wd_custom_style_config = wd_array_atts_str($default_custom_style_config,$wd_custom_style_config);	
	
	
	add_action('wp_ajax_nopriv_wd_ajax_style', 'ajax_save_style');
	add_action('wp_ajax_wd_ajax_style', 'ajax_save_style');
	
	function ajax_save_style(){
		global $default_custom_style_config,$wd_custom_style_config;
		
		//get config data,merge it with default config data
		// $custom_style_config = get_option(THEME_SLUG.'custom_style_config','');
		// $style_datas = unserialize($custom_style_config);
		// $style_datas = wd_array_atts($default_custom_style_config,$style_datas);
				
		$style_datas = $wd_custom_style_config;		
				


		
		$enable_custom_font = $style_datas['enable_custom_font'];
		$enable_custom_color = $style_datas['enable_custom_color'];
				
		if(	! is_user_logged_in() ){
			die('You do not have sufficient permissions to do this action.');
		}else{
			if ( !current_user_can( 'manage_options' ) )  {
				wp_die( __( 'You do not have sufficient permissions to do this action.','wpdance' ) );
			}else{
				//TODO : check nonce & do font save
				if( !$enable_custom_font && !$enable_custom_color ){
					wp_die( __( 'Custom style disabled','wpdance' ) );
				}
				if ( empty($_POST) || !wp_verify_nonce($_POST['ajax_preview'],'ajax_save_style') ){
					wp_die( __( 'Something goes wrong!Please login again','wpdance' ) );
				}else{
				   // process form data
										
					// $body_font_weight = strcmp( $_POST['body_font_weight'],'regular' ) == 0 ? '400' : $_POST['body_font_weight'];
					// $body_font_weight = strcmp( $_POST['body_font_weight'],'italic' ) == 0 ? '400italic' : $_POST['body_font_weight'];
					
					// $heading_font_weight = strcmp( $_POST['heading_font_weight'],'regular' ) == 0 ? '400' : $_POST['heading_font_weight'];
					// $heading_font_weight = strcmp( $_POST['heading_font_weight'],'italic' ) == 0 ? '400italic' : $_POST['heading_font_weight'];		
					
					// $body_font_style = strpos($body_font_weight, 'italic') == false ? 'normal' : 'italic';
					// $heading_font_style = strpos($heading_font_weight, 'italic') == false ? 'normal' : 'italic';	

					// $body_font_weight = str_replace( "italic", "", $body_font_weight );		
					// $heading_font_weight = str_replace( "italic", "", $heading_font_weight );
		
					
					$save_datas = $style_datas;
					$save_datas['page_layout'] = strlen( $_POST['page_layout'] ) > 0 ? $_POST['page_layout'] : $save_datas['page_layout'];
					
					$save_datas['body_font_style_str'] = $_POST['body_font_style_str'];
					$save_datas['heading_font_style_str'] = $_POST['heading_font_style_str'] ;
					$save_datas['menu_font_style_str'] = $_POST['menu_font_style_str'] ;
					$save_datas['sub_menu_font_style_str'] = $_POST['sub_menu_font_style_str'] ;
					
					$save_datas['body_font_name'] = strlen( $_POST['@font_body'] ) > 0 ? $_POST['@font_body'] : $save_datas['body_font_name'];
					$save_datas['body_font_weight'] = strlen( $_POST['@font_body_fontweight'] ) > 0 ? $_POST['@font_body_fontweight'] : $save_datas['body_font_weight'];
					$save_datas['body_font_style'] = strlen( $_POST['@font_body_fontstyle'] ) > 0 ? $_POST['@font_body_fontstyle'] : $save_datas['body_font_style'];
					$save_datas['menu_font_name'] = strlen( $_POST['@font_menu'] ) > 0 ? $_POST['@font_menu'] : $save_datas['menu_font_name'];
					$save_datas['menu_font_weight'] = strlen( $_POST['@font_menu_fontweight'] ) > 0 ? $_POST['@font_menu_fontweight'] : $save_datas['menu_font_weight'];
					$save_datas['menu_font_style'] = strlen( $_POST['@font_menu_fontstyle'] ) > 0 ? $_POST['@font_menu_fontstyle'] : $save_datas['menu_font_style'];
					$save_datas['heading_font_name'] = strlen( $_POST['@font_heading'] ) > 0 ? $_POST['@font_heading'] : $save_datas['heading_font_name'];
					$save_datas['heading_font_weight'] = strlen( $_POST['@font_heading_fontweight'] ) > 0 ? $_POST['@font_heading_fontweight'] : $save_datas['heading_font_weight'];
					$save_datas['heading_font_style'] = strlen( $_POST['@font_heading_fontstyle'] ) > 0 ? $_POST['@font_heading_fontstyle'] : $save_datas['heading_font_style'];
					$save_datas['sub_menu_font_name'] = strlen( $_POST['@font_sub_menu'] ) > 0 ? $_POST['@font_sub_menu'] : $save_datas['sub_menu_font_name'];
					$save_datas['sub_menu_font_weight'] = strlen( $_POST['@font_sub_menu_fontweight'] ) > 0 ? $_POST['@font_sub_menu_fontweight'] : $save_datas['sub_menu_font_weight'];
					$save_datas['sub_menu_font_style'] = strlen( $_POST['@font_sub_menu_fontstyle'] ) > 0 ? $_POST['@font_sub_menu_fontstyle'] : $save_datas['sub_menu_font_style'];
					
					$save_datas['primary_color'] = strlen( $_POST['@primary_color'] ) > 0 ? $_POST['@primary_color'] : $save_datas['primary_color'];
					$save_datas['secondary_color'] = strlen( $_POST['@secondary_color'] ) > 0 ? $_POST['@secondary_color'] : $save_datas['secondary_color'];
					
					$save_datas['header_top_background'] = strlen( $_POST['@header_top_background'] ) > 0 ? $_POST['@header_top_background'] : $save_datas['header_top_background'];
					$save_datas['header_top_text_color'] = strlen( $_POST['@header_top_text_color'] ) > 0 ? $_POST['@header_top_text_color'] : $save_datas['header_top_text_color'];
					$save_datas['header_top_link_color'] = strlen( $_POST['@header_top_link_color'] ) > 0 ? $_POST['@header_top_link_color'] : $save_datas['header_top_link_color'];
					$save_datas['header_top_social_background_hover'] = strlen( $_POST['@header_top_social_background_hover'] ) > 0 ? $_POST['@header_top_social_background_hover'] : $save_datas['header_top_social_background_hover'];
					$save_datas['header_menu_text_color'] = strlen( $_POST['@header_menu_text_color'] ) > 0 ? $_POST['@header_menu_text_color'] : $save_datas['header_menu_text_color'];
					$save_datas['header_menu_active_text_color'] = strlen( $_POST['@header_menu_active_text_color'] ) > 0 ? $_POST['@header_menu_active_text_color'] : $save_datas['header_menu_active_text_color'];
					$save_datas['header_submenu_text_color'] = strlen( $_POST['@header_submenu_text_color'] ) > 0 ? $_POST['@header_submenu_text_color'] : $save_datas['header_submenu_text_color'];
					$save_datas['header_submenu_link_color'] = strlen( $_POST['@header_submenu_link_color'] ) > 0 ? $_POST['@header_submenu_link_color'] : $save_datas['header_submenu_link_color'];
					$save_datas['header_submenu_border_top_color'] = strlen( $_POST['@header_submenu_border_top_color'] ) > 0 ? $_POST['@header_submenu_border_top_color'] : $save_datas['header_submenu_border_top_color'];
					$save_datas['header_submenu_border_color'] = strlen( $_POST['@header_submenu_border_color'] ) > 0 ? $_POST['@header_submenu_border_color'] : $save_datas['header_submenu_border_color'];
					$save_datas['header_submenu_hover_item_color'] = strlen( $_POST['@header_submenu_hover_item_color'] ) > 0 ? $_POST['@header_submenu_hover_item_color'] : $save_datas['header_submenu_hover_item_color'];
					
					$save_datas['footer_first_area_background_color'] = strlen( $_POST['@footer_first_area_background_color'] ) > 0 ? $_POST['@footer_first_area_background_color'] : $save_datas['footer_first_area_background_color'];
					$save_datas['footer_first_area_text_color'] = strlen( $_POST['@footer_first_area_text_color'] ) > 0 ? $_POST['@footer_first_area_text_color'] : $save_datas['footer_first_area_text_color'];
					$save_datas['footer_first_area_link_color'] = strlen( $_POST['@footer_first_area_link_color'] ) > 0 ? $_POST['@footer_first_area_link_color'] : $save_datas['footer_first_area_link_color'];
					$save_datas['footer_first_area_link_color_hover'] = strlen( $_POST['@footer_first_area_link_color_hover'] ) > 0 ? $_POST['@footer_first_area_link_color_hover'] : $save_datas['footer_first_area_link_color_hover'];
					$save_datas['footer_first_area_heading_color'] = strlen( $_POST['@footer_first_area_heading_color'] ) > 0 ? $_POST['@footer_first_area_heading_color'] : $save_datas['footer_first_area_heading_color'];
					$save_datas['footer_first_area_border_color'] = strlen( $_POST['@footer_first_area_border_color'] ) > 0 ? $_POST['@footer_first_area_border_color'] : $save_datas['footer_first_area_border_color'];
					$save_datas['footer_second_area_background_color'] = strlen( $_POST['@footer_second_area_background_color'] ) > 0 ? $_POST['@footer_second_area_background_color'] : $save_datas['footer_second_area_background_color'];
					$save_datas['footer_second_area_text_color'] = strlen( $_POST['@footer_second_area_text_color'] ) > 0 ? $_POST['@footer_second_area_text_color'] : $save_datas['footer_second_area_text_color'];
					$save_datas['footer_second_area_link_color'] = strlen( $_POST['@footer_second_area_link_color'] ) > 0 ? $_POST['@footer_second_area_link_color'] : $save_datas['footer_second_area_link_color'];
					$save_datas['footer_second_area_link_color_hover'] = strlen( $_POST['@footer_second_area_link_color_hover'] ) > 0 ? $_POST['@footer_second_area_link_color_hover'] : $save_datas['footer_second_area_link_color_hover'];
					$save_datas['footer_second_area_heading_color'] = strlen( $_POST['@footer_second_area_heading_color'] ) > 0 ? $_POST['@footer_second_area_heading_color'] : $save_datas['footer_second_area_heading_color'];
					$save_datas['footer_second_area_border_color'] = strlen( $_POST['@footer_second_area_border_color'] ) > 0 ? $_POST['@footer_second_area_border_color'] : $save_datas['footer_second_area_border_color'];
					$save_datas['footer_thrid_area_background_color'] = strlen( $_POST['@footer_thrid_area_background_color'] ) > 0 ? $_POST['@footer_thrid_area_background_color'] : $save_datas['footer_thrid_area_background_color'];
					$save_datas['footer_thrid_area_text_color'] = strlen( $_POST['@footer_thrid_area_text_color'] ) > 0 ? $_POST['@footer_thrid_area_text_color'] : $save_datas['footer_thrid_area_text_color'];
					$save_datas['footer_thrid_area_link_color'] = strlen( $_POST['@footer_thrid_area_link_color'] ) > 0 ? $_POST['@footer_thrid_area_link_color'] : $save_datas['footer_thrid_area_link_color'];
					$save_datas['footer_thrid_area_link_color_hover'] = strlen( $_POST['@footer_thrid_area_link_color_hover'] ) > 0 ? $_POST['@footer_thrid_area_link_color_hover'] : $save_datas['footer_thrid_area_link_color_hover'];
					$save_datas['footer_thrid_area_border_color'] = strlen( $_POST['@footer_thrid_area_border_color'] ) > 0 ? $_POST['@footer_thrid_area_border_color'] : $save_datas['footer_thrid_area_border_color'];
					
					$save_datas['sidebar_text_color'] = strlen( $_POST['@sidebar_text_color'] ) > 0 ? $_POST['@sidebar_text_color'] : $save_datas['sidebar_text_color'];
					$save_datas['sidebar_link_color'] = strlen( $_POST['@sidebar_link_color'] ) > 0 ? $_POST['@sidebar_link_color'] : $save_datas['sidebar_link_color'];
					$save_datas['sidebar_link_color_hover'] = strlen( $_POST['@sidebar_link_color_hover'] ) > 0 ? $_POST['@sidebar_link_color_hover'] : $save_datas['sidebar_link_color_hover'];
					$save_datas['sidebar_heading_color'] = strlen( $_POST['@sidebar_heading_color'] ) > 0 ? $_POST['@sidebar_heading_color'] : $save_datas['sidebar_heading_color'];
					$save_datas['sidebar_border_color'] = strlen( $_POST['@sidebar_border_color'] ) > 0 ? $_POST['@sidebar_border_color'] : $save_datas['sidebar_border_color'];
					

					$save_datas['primary_text_color'] = strlen( $_POST['@primary_text_color'] ) > 0 ? $_POST['@primary_text_color'] : $save_datas['primary_text_color'];
					$save_datas['primary_link_color'] = strlen( $_POST['@primary_link_color'] ) > 0 ? $_POST['@primary_link_color'] : $save_datas['primary_link_color'];
					$save_datas['primary_link_color_hover'] = strlen( $_POST['@primary_link_color_hover'] ) > 0 ? $_POST['@primary_link_color_hover'] : $save_datas['primary_link_color_hover'];
					$save_datas['primary_heading_color'] = strlen( $_POST['@primary_heading_color'] ) > 0 ? $_POST['@primary_heading_color'] : $save_datas['primary_heading_color'];
					$save_datas['primary_button_background_color'] = strlen( $_POST['@primary_button_background_color'] ) > 0 ? $_POST['@primary_button_background_color'] : $save_datas['primary_button_background_color'];$save_datas['sidebar_text_color'] = strlen( $_POST['@sidebar_text_color'] ) > 0 ? $_POST['@sidebar_text_color'] : $save_datas['sidebar_text_color'];
					$save_datas['primary_button_border_color'] = strlen( $_POST['@primary_button_border_color'] ) > 0 ? $_POST['@primary_button_border_color'] : $save_datas['primary_button_border_color'];
					$save_datas['primary_button_text_color'] = strlen( $_POST['@primary_button_text_color'] ) > 0 ? $_POST['@primary_button_text_color'] : $save_datas['primary_button_text_color'];
					$save_datas['primary_button_background_color_hover'] = strlen( $_POST['@primary_button_background_color_hover'] ) > 0 ? $_POST['@primary_button_background_color_hover'] : $save_datas['primary_button_background_color_hover'];
					$save_datas['primary_button_border_color_hover'] = strlen( $_POST['@primary_button_border_color_hover'] ) > 0 ? $_POST['@primary_button_border_color_hover'] : $save_datas['primary_button_border_color_hover'];$save_datas['sidebar_text_color'] = strlen( $_POST['@sidebar_text_color'] ) > 0 ? $_POST['@sidebar_text_color'] : $save_datas['sidebar_text_color'];
					$save_datas['primary_button_text_color_hover'] = strlen( $_POST['@primary_button_text_color_hover'] ) > 0 ? $_POST['@primary_button_text_color_hover'] : $save_datas['primary_button_text_color_hover'];
					$save_datas['secondary_button_background_color'] = strlen( $_POST['@secondary_button_background_color'] ) > 0 ? $_POST['@secondary_button_background_color'] : $save_datas['secondary_button_background_color'];
					$save_datas['secondary_button_border_color'] = strlen( $_POST['@secondary_button_border_color'] ) > 0 ? $_POST['@secondary_button_border_color'] : $save_datas['secondary_button_border_color'];
					$save_datas['secondary_button_text_color'] = strlen( $_POST['@secondary_button_text_color'] ) > 0 ? $_POST['@secondary_button_text_color'] : $save_datas['secondary_button_text_color'];
					$save_datas['secondary_button_background_color_hover'] = strlen( $_POST['@secondary_button_background_color_hover'] ) > 0 ? $_POST['@secondary_button_background_color_hover'] : $save_datas['secondary_button_background_color_hover'];
					$save_datas['secondary_button_border_color_hover'] = strlen( $_POST['@secondary_button_border_color_hover'] ) > 0 ? $_POST['@secondary_button_border_color_hover'] : $save_datas['secondary_button_border_color_hover'];
					$save_datas['secondary_button_text_color_hover'] = strlen( $_POST['@secondary_button_text_color_hover'] ) > 0 ? $_POST['@secondary_button_text_color_hover'] : $save_datas['secondary_button_text_color_hover'];
					
					$save_datas['primary_border_color'] = strlen( $_POST['@primary_border_color'] ) > 0 ? $_POST['@primary_border_color'] : $save_datas['primary_border_color'];
					$save_datas['primary_border_color_hover'] = strlen( $_POST['@primary_border_color_hover'] ) > 0 ? $_POST['@primary_border_color_hover'] : $save_datas['primary_border_color_hover'];
					$save_datas['secondary_border_color'] = strlen( $_POST['@secondary_border_color'] ) > 0 ? $_POST['@secondary_border_color'] : $save_datas['secondary_border_color'];
					$save_datas['secondary_border_color_hover'] = strlen( $_POST['@secondary_border_color_hover'] ) > 0 ? $_POST['@secondary_border_color_hover'] : $save_datas['secondary_border_color_hover'];	
					
					$save_datas['primary_tab_background_color'] = strlen( $_POST['@primary_tab_background_color'] ) > 0 ? $_POST['@primary_tab_background_color'] : $save_datas['primary_tab_background_color'];$save_datas['secondary_button_text_color'] = strlen( $_POST['@sidebar_text_color'] ) > 0 ? $_POST['@sidebar_text_color'] : $save_datas['sidebar_text_color'];
					$save_datas['primary_tab_border_color'] = strlen( $_POST['@primary_tab_border_color'] ) > 0 ? $_POST['@primary_tab_border_color'] : $save_datas['primary_tab_border_color'];
					$save_datas['primary_tab_text_color'] = strlen( $_POST['@primary_tab_text_color'] ) > 0 ? $_POST['@primary_tab_text_color'] : $save_datas['primary_tab_text_color'];
					$save_datas['primary_tab_active_text_color'] = strlen( $_POST['@primary_tab_active_text_color'] ) > 0 ? $_POST['@primary_tab_active_text_color'] : $save_datas['primary_tab_active_text_color'];
					
					
					
					$save_datas['totop_background'] = strlen( $_POST['@totop_background'] ) > 0 ? $_POST['@totop_background'] : $save_datas['totop_background'];
					$save_datas['totop_background_hover'] = strlen( $_POST['@totop_background_hover'] ) > 0 ? $_POST['@totop_background_hover'] : $save_datas['totop_background_hover'];
					$save_datas['feedback_background_hover'] = strlen( $_POST['@feedback_background_hover'] ) > 0 ? $_POST['@feedback_background_hover'] : $save_datas['feedback_background_hover'];
					$save_datas['quickshop_background_color_hover'] = strlen( $_POST['@quickshop_background_color_hover'] ) > 0 ? $_POST['@quickshop_background_color_hover'] : $save_datas['quickshop_background_color_hover'];
					$save_datas['cart_background_color_hover'] = strlen( $_POST['@cart_background_color_hover'] ) > 0 ? $_POST['@cart_background_color_hover'] : $save_datas['cart_background_color_hover'];
					
					
					
					
					//merge new config data with old config data,then save
					

					update_option(THEME_SLUG.'custom_style_config',serialize($save_datas));						
						
					$ret_value = save_custom_style( $save_datas );
					wp_die(  $ret_value  );
				}
			}
			
		}
	
	}
	

	function previewPanel(){
	/***************Start font block****************/
	
	$api_key = get_option(THEME_SLUG.'googlefont_api_key','AIzaSyAP4SsyBZEIrh0kc_cO9s90__r2oCJ8Rds');
	$google_font_url = "https://www.googleapis.com/webfonts/v1/webfonts?key=".$api_key;
	

	
	global $default_custom_style_config,$wd_custom_style_config;
	
	// $custom_style_config = get_option(THEME_SLUG.'custom_style_config','');
	// $style_datas = unserialize($custom_style_config);
	// $style_datas = wd_array_atts($default_custom_style_config,$style_datas);	
	
	
	$style_datas = $wd_custom_style_config;
		
	$body_font_name = $style_datas['body_font_name'];
	$body_font_style_str = $style_datas['body_font_style_str'];
	
	$heading_font_name = $style_datas['heading_font_name'];
	$heading_font_style_str = $style_datas['heading_font_style_str'];
	
	$font_sort = $style_datas['font_sort'];


	
	/***************End font block****************/	
	$enable_custom_font = 	(int) $style_datas['enable_custom_font'];
	$enable_custom_color = 	(int) $style_datas['enable_custom_color'];
	
	
	if( $enable_custom_font || $enable_custom_color ){

	?>	

		<div id="wd-control-panel" class="default-font hidden-phone">
			<div id="control-panel-main">
						<a id="wd-control-close" href="#"></a>

						
<div class="accordion" id="review_panel_accordion">
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#review_panel_accordion" href="#collapse_layout">
				<h2 class="wd-preview-heading">Layout Style</h2>
			</a>
		</div>
		<div id="collapse_layout" class="accordion-body collapse in">
			<div class="accordion-inner">
				<select name="page_layout" id="_page_layout" class="page_layout">
					<option value="wide" <?php if( strcmp(esc_html($style_datas['page_layout']),'wide') == 0 ) echo "selected";?>>Wide</option>
					<option value="box" <?php if( strcmp(esc_html($style_datas['page_layout']),'box') == 0 ) echo "selected";?>>Box</option>
				</select>	
			</div>
		</div>
	</div>
	<?php if($enable_custom_color):?>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#review_panel_accordion" href="#collapse_color">
				<h2 class="wd-preview-heading">Custom Color</h2>
			</a>
		</div>
		<div id="collapse_color" class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="input-append color colorpicker6 colorpicker_theme_color" data-color="<?php echo esc_html($style_datas['primary_color']); ?>" data-color-format="hex">
					<p class="custom-title">Primary Color</p>
					<input name="theme_color" id="theme_color" type="text" class="span2" value="<?php echo esc_html($style_datas['primary_color']); ?>" >
					<span class="add-on"><i style="color: <?php echo esc_html($style_datas['primary_color']); ?>"></i></span>
				</div>		

				<div class="input-append color colorpicker6 colorpicker_secondary_color" data-color="<?php echo esc_html($style_datas['secondary_color']); ?>" data-color-format="hex">
					<p class="custom-title">Secondary Color</p>
					<input name="secondary_color" id="secondary_color" type="text" class="span2" value="<?php echo esc_html($style_datas['secondary_color']); ?>" >
					<span class="add-on"><i style="color: <?php echo esc_html($style_datas['secondary_color']); ?>"></i></span>
				</div>					
				
				<div class="input-append color colorpicker_header_top_color" data-color="<?php echo esc_html($style_datas['header_top_background']); ?>" data-color-format="hex">
					<p class="custom-title">Header Top</p>
					<input name="header_top_color" id="header_top_color" type="text" class="span2" value="<?php echo esc_html($style_datas['header_top_background']); ?>" >
					<span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['header_top_background']); ?>"></i></span>
				</div>
				<div class="input-append color colorpicker_header_middle_color" data-color="<?php echo esc_html($style_datas['header_menu_text_color']); ?>" data-color-format="hex">
					<p class="custom-title">Header Middle</p>
					<input name="header_middle_color" id="header_middle_color" type="text" class="span2" value="<?php echo esc_html($style_datas['header_menu_text_color']); ?>" >
					<span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['header_menu_text_color']); ?>"></i></span>
				</div>
				<div class="input-append color colorpicker_footer_first_color colorpicker_control_rgba" data-color="<?php echo esc_html($style_datas['footer_first_area_background_color']); ?>" data-color-format="hex">
					<p class="custom-title">Footer First Area</p>
					<input name="footer_first_color" id="footer_first_color" type="text" class="span2 colorpicker_control_rgba" value="<?php echo esc_html($style_datas['footer_first_area_background_color']); ?>" >
					<span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['footer_first_area_background_color']); ?>"></i></span>
				</div>
				<div class="input-append color colorpicker_footer_second_color" data-color="<?php echo esc_html($style_datas['footer_second_area_background_color']); ?>" data-color-format="hex">
					<p class="custom-title">Footer Second Area</p>
					<input name="footer_second_color" id="footer_second_color" type="text" class="span2" value="<?php echo esc_html($style_datas['footer_second_area_background_color']); ?>" >
					<span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['footer_second_area_background_color']); ?>"></i></span>
				</div>
				<div class="input-append color colorpicker_footer_third_color" data-color="<?php echo esc_html($style_datas['footer_thrid_area_background_color']); ?>" data-color-format="hex">
					<p class="custom-title">Footer Third Area</p>
					<input name="footer_third_color" id="footer_third_color" type="text" class="span2" value="<?php echo esc_html($style_datas['footer_thrid_area_background_color']); ?>" >
					<span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['footer_thrid_area_background_color']); ?>"></i></span>
				</div>										

			</div>
		</div>
	</div>
	<?php endif;?>
	
	
	<?php if($enable_custom_font):?>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#review_panel_accordion" href="#collapse_font">
				<h2 class="wd-preview-heading">Custom Font</h2>
			</a>
		</div>
		<div id="collapse_font" class="accordion-body collapse">
			<div class="accordion-inner">
							<h2 class="wd-preview-heading">Custom Font</h2>
							<hr/>						
						<div class="custom-body">
							<p class="custom-title">Body Font</p>
							<label for="textbody" id="textbody-contain">
								<select name="body_font" id="list_body_font">
								</select>
							</label>
							
							<?php if( $enable_custom_color ):?>				
								<div class="input-append color colorpicker_text_color" data-color="<?php echo esc_html($style_datas['primary_text_color']); ?>" data-color-format="hex">
									<input name="text-color" <?php if($enable_custom_font) echo 'style="display:none;"'?> id="text-color" type="text" class="span2" value="<?php echo esc_html($style_datas['primary_text_color']); ?>" >
									<span class="add-on"><i style="color: <?php echo esc_html($style_datas['primary_text_color']); ?>"></i></span>
								</div>
							<?php endif;?>
							
							<div class="custom-font-body">
								<p class="custom-title">Body Font Style</p>
								<label for="heading_font" id="heading_font-contain">
									<select name="body_font_weight" id="body_font_weight">
									</select>
								</label>
							</div>							
							
						</div>
						
						<div class="custom-heading">
						<?php if($enable_custom_font):?>
						
							<p class="custom-title">Heading Font</p>
							<label for="heading" id="textbody-contain">
								<select name="heading_font" id="list_heading_font">
								</select>
							</label>
						<?php endif;?>
						
						<?php if($enable_custom_color):?>
							<div class="input-append color colorpicker_heading_color" data-color="<?php echo esc_html($style_datas['primary_heading_color']); ?>" data-color-format="hex">
								<input name="primary_heading_color" <?php if($enable_custom_font) echo 'style="display:none;"'?> id="primary_heading_color" type="text" class="span2" value="<?php echo esc_html($style_datas['primary_heading_color']); ?>" >
								<span class="add-on"><i style="color: <?php echo esc_html($style_datas['primary_heading_color']); ?>"></i></span>
							</div>
						<?php endif;?>
						
							<div class="custom-heading-style">
								<p class="custom-title">Heading Font Style</p>
								<label for="heading_font_weight" id="heading_font_weight-contain">
									<select name="heading_font_weight" id="heading_font_weight">
									</select>
								</label>
							</div>						
						</div>
						
						<div class="custom-menu">
						<?php if($enable_custom_font):?>
						
							<p class="custom-title">Menu Font</p>
							<label for="menu" id="textbody-contain">
								<select name="menu_font" id="list_menu_font">
								</select>
							</label>
						<?php endif;?>
						
						<?php if($enable_custom_color):?>
							<div class="input-append color colorpicker_menu_text_color" data-color="<?php echo esc_html($style_datas['header_menu_text_color']); ?>" data-color-format="hex">
								<input name="menu_color" <?php if($enable_custom_font) echo 'style="display:none;"'?> id="menu_color" type="text" class="span2" value="<?php echo esc_html($style_datas['header_menu_text_color']); ?>" >
								<span class="add-on"><i style="color: <?php echo esc_html($style_datas['header_menu_text_color']); ?>"></i></span>
							</div>
						<?php endif;?>
						
							<div class="custom-heading-style">
								<p class="custom-title">Menu Font Style</p>
								<label for="menu_font_weight" id="menu_font_weight-contain">
									<select name="menu_font_weight" id="menu_font_weight">
									</select>
								</label>
							</div>						
						</div>
						
						<div class="custom-sub-menu">
						<?php if($enable_custom_font):?>
						
							<p class="custom-title">Sub Menu Font</p>
							<label for="sub_menu" id="textbody-contain">
								<select name="sub_menu_font" id="list_sub_menu_font">
								</select>
							</label>
						<?php endif;?>
						
						
						<?php if($enable_custom_color):?>
							<div class="input-append color colorpicker_sub_menu_text_color" data-color="<?php echo esc_html($style_datas['header_submenu_text_color']); ?>" data-color-format="hex">
								<input name="sub_menu_color" <?php if($enable_custom_font) echo 'style="display:none;"'?> id="sub_menu_color" type="text" class="span2" value="<?php echo esc_html($style_datas['header_submenu_text_color']); ?>" >
								<span class="add-on"><i style="color: <?php echo esc_html($style_datas['header_submenu_text_color']); ?>"></i></span>
							</div>
						<?php endif;?>
						
							<div class="custom-heading-style">
								<p class="custom-title">Sub Menu Font Style</p>
								<label for="sub_menu_font_weight" id="sub_menu_font_weight-contain">
									<select name="sub_menu_font_weight" id="sub_menu_font_weight">
									</select>
								</label>
							</div>						
						</div>
						
			</div>
		</div>
	</div>
	<?php endif;?>
	
	<?php global $_demo_mod ;$_demo_mod=1;?>	
	<?php if( $_demo_mod ): ?>	
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#review_panel_accordion" href="#collapse_textures">
				<h2 class="wd-preview-heading">Textures</h2>
			</a>
		</div>
		<div id="collapse_textures" class="accordion-body collapse">
			<div class="accordion-inner">

					<h2 class="wd-preview-heading">Custom Background (Support Box Layout Only)</h2>
					<hr/>					
					<div class="wd-background-wrapper">
						<p class="custom-title">Background Image</p>
						<?php
							$_base_path = get_template_directory_uri() . '/images/partern/';
							echo "<ul class='wd-background-patten'>";
							for( $i = 0 ; $i <= 10 ; $i++ ){
								$temp_class = '';
								$_cur_path = $_base_path."{$i}.png";
								if($i==0)
									$temp_class = ' class="active"';
								echo "<li".$temp_class."><img id='patten_{$i}' class='wd-background-patten-image' src='{$_cur_path}' title='patten {$i}' alt='patten {$i}'></li>";
							}
							echo "</ul>";
						?>
						<?php if($enable_custom_color):?>
						<h2 class="wd-preview-heading">Backgrounds Color</h2>
						<div class="input-append color colorpicker1 colorpicker_background_color" data-color="#f5f5f5" data-color-format="hex">
							<input name="background_color" id="background_color" type="text" class="span2" value="#f5f5f5" >
							<span class="add-on"><i style="background-color: #f5f5f5"></i></span>
						</div>
						<?php endif; ?>
					</div>					
			</div>
		</div>
	</div>	
	<?php endif; ?>	
</div>					
						
					<p class="button-save"><button class="btn btn-primary" data-loading-text="Saving..." id="font-save-btn" type="button">Save</button></p>
					<p class="button-clear"><button class="btn btn-primary" data-loading-text="Clearing..." id="font-clear-btn" type="button">Clear</button></p>
					
					<div id="preview-save-result" class="alert" style="display:none;">

					</div>

					<?php //TODO ?>
					<?php wp_nonce_field('ajax_save_style','preview_nonce_field'); ?>	
			</div>
		</div>
	<script type="text/javascript">
	//<![CDATA[
		function loadSelectedFont( font_name,font_weight ){
			if(  font_name.length > 0 ){
				jQuery('head').append("<link id='" + font_name + "' href='http://fonts.googleapis.com/css?family="+font_name.replace(/ /g,'+')+( jQuery.trim(font_weight).length > 0 ? (':' + font_weight) : '' )+"' rel='stylesheet' type='text/css' />");
			}
		}

		function get_font_weight(font_string){
			font_string = font_string.replace("italic","");
			if( font_string.length <= 0 || font_string == 'regular' ){
				return 'normal';
			}
			return font_string;
		}
		function get_font_style(font_string){
			if( font_string.indexOf('italic') >= 0 )
				return 'italic';
			return 'normal';
		}
		function set_cookie(custom_datas){
			var json_object = JSON.stringify(custom_datas);
			var custom = [];
			if(custom_datas.length < 2883){
				jQuery.cookie("custom_datas",  JSON.stringify(custom_datas));
			} else {
				var number_cookie = parseInt(json_object.length / 2800) + 1;
				for(i = 0 ; i < number_cookie; i++){
					custom[i]= {}; 
				}
				var j = 0;
				var flag = 2800;
				jQuery.each(custom_datas, function(key, value) {
					custom[j][key] = value;
					if(JSON.stringify(custom[j]).length > flag){
						delete custom[j].key;
						flag = flag * 2;
						j++;
						custom[j][key] = value;
					}
					//console.log('key: ' + key + '\n' + 'value: ' + value);
				});
				for(i = 0; i<custom.length;i++){
					if(i==0){
						temp = '';
					} else {
						temp = '_'+i;
					}
					//console.log(custom[i]);
					jQuery.cookie("custom_datas"+temp,  JSON.stringify(custom[i]));
				}
			}
		}
		function get_number_cookie(custom_datas){
			var json_object = JSON.stringify(custom_datas);
			var number_cookie = parseInt(json_object.length / 2800) + 1;
			return number_cookie;
		}
		function get_from_cookie(number_cookie){
			var result = '';
			for(i = 0; i< number_cookie;i++){
				if(i==0){
					tempple = '';
				} else {
					tempple = '_' + i;
				}
				var temp = jQuery.cookie("custom_datas"+tempple);
				temp = temp.replace("{", "");
				temp = temp.replace("}", "");
				result = result + ',' + temp;
				//console.log(result);
			}
			result = result.substring(1);
			result = '{' + result + '}';
			return result;
		}
		function remove_data_cookie(custom_datas){
			var number_cookie = get_number_cookie(custom_datas);
			for(i = 0; i< number_cookie;i++){
				if(i==0){
					tempple = '';
				} else {
					tempple = '_' + i;
				}
				jQuery.removeCookie("custom_datas"+tempple);
			}	
		}
		function set_color( selector_id,color_value ){
			jQuery(selector_id).find('input.span2').val(color_value);
			setTimeout(function(){
				jQuery(selector_id).find('i').eq(0).css('background-color',color_value);
			},1000);
		}		
		
	jQuery(document).ready(function() {
		if(jQuery('.colorpicker_control_rgba').length > 0 ) {
			jQuery('.colorpicker_control_rgba').each(function(index,element){
				jQuery(element).colorpicker({ 'format':"rgba" });
			});
		}
		jQuery.cookie.defaults = { path: '/', expires: 365 };
	
			<?php
				$_style_datas = $style_datas;
				foreach( $_style_datas as $_key => $_value ){
					$_style_datas[$_key] = strlen($_value) <= 0 ? "null" : $_value;
				}
				$_style_datas['body_font_name'] = (strcmp($_style_datas['body_font_name'],'null') == 0 || (int)$_style_datas['body_font_name'] == - 1) ? "Roboto" : $_style_datas['body_font_name'];
				$_style_datas['heading_font_name'] = (strcmp($_style_datas['heading_font_name'],'null') == 0 || (int)$_style_datas['heading_font_name'] == - 1) ? "Share" : $_style_datas['heading_font_name'];
				$_style_datas['menu_font_name'] = (strcmp($_style_datas['menu_font_name'],'null') == 0 || (int)$_style_datas['menu_font_name'] == - 1) ? "Share" : $_style_datas['menu_font_name'];
				$_style_datas['sub_menu_font_name'] = (strcmp($_style_datas['sub_menu_font_name'],'null') == 0 || (int)$_style_datas['sub_menu_font_name'] == - 1) ? "Roboto" : $_style_datas['sub_menu_font_name'];
			?>
			custom_datas = {	"@font_body" : "<?php echo esc_html($_style_datas['body_font_name']); ?>"
								,"@font_body_fontweight" : "<?php echo esc_html($_style_datas['body_font_weight']); ?>"
								,"@font_body_fontstyle" : "<?php echo esc_html($_style_datas['body_font_style']); ?>"
								,"@font_menu" : "<?php echo esc_html($_style_datas['menu_font_name']); ?>"
								,"@font_menu_fontweight" : "<?php echo esc_html($_style_datas['menu_font_weight']); ?>"
								,"@font_menu_fontstyle" : "<?php echo esc_html($_style_datas['menu_font_style']); ?>"
								,"@font_sub_menu" : "<?php echo esc_html($_style_datas['sub_menu_font_name']); ?>"
								,"@font_sub_menu_fontweight" : "<?php echo esc_html($_style_datas['sub_menu_font_weight']); ?>"
								,"@font_sub_menu_fontstyle" : "<?php echo esc_html($_style_datas['sub_menu_font_style']); ?>"
								,"@font_heading" : "<?php echo esc_html($_style_datas['heading_font_name']); ?>"
								,"@font_heading_fontweight" : "<?php echo esc_html($_style_datas['heading_font_weight']); ?>"
								,"@font_heading_fontstyle" : "<?php echo esc_html($_style_datas['heading_font_style']); ?>"
								
								// Primary
								,"@primary_color" : "<?php echo esc_html($_style_datas['primary_color']); ?>"
								// Secondary
								,"@secondary_color" : "<?php echo esc_html($_style_datas['secondary_color']); ?>"

								// Header
								,"@header_top_background" : "<?php echo esc_html($_style_datas['header_top_background']); ?>"
								,"@header_top_text_color" : "<?php echo esc_html($_style_datas['header_top_text_color']); ?>"
								,"@header_top_link_color" : "<?php echo esc_html($_style_datas['header_top_link_color']); ?>"
								,"@header_top_social_background_hover" : "<?php echo esc_html($_style_datas['header_top_social_background_hover']); ?>"
								,"@header_menu_text_color" : "<?php echo esc_html($_style_datas['header_menu_text_color']); ?>"
								,"@header_menu_active_text_color" : "<?php echo esc_html($_style_datas['header_menu_active_text_color']); ?>"
								,"@header_submenu_text_color" : "<?php echo esc_html($_style_datas['header_submenu_text_color']); ?>"
								,"@header_submenu_link_color" : "<?php echo esc_html($_style_datas['header_submenu_link_color']); ?>"
								,"@header_submenu_border_top_color" : "<?php echo esc_html($_style_datas['header_submenu_border_top_color']); ?>"
								,"@header_submenu_border_color" : "<?php echo esc_html($_style_datas['header_submenu_border_color']); ?>"
								,"@header_submenu_hover_item_color" : "<?php echo esc_html($_style_datas['header_submenu_hover_item_color']); ?>"
								
								// Footer
								,"@footer_first_area_background_color" : "<?php echo esc_html($_style_datas['footer_first_area_background_color']); ?>"
								,"@footer_first_area_text_color" : "<?php echo esc_html($_style_datas['footer_first_area_text_color']); ?>"
								,"@footer_first_area_link_color" : "<?php echo esc_html($_style_datas['footer_first_area_link_color']); ?>"
								,"@footer_first_area_link_color_hover" : "<?php echo esc_html($_style_datas['footer_first_area_link_color_hover']); ?>"
								,"@footer_first_area_heading_color" : "<?php echo esc_html($_style_datas['footer_first_area_heading_color']); ?>"
								,"@footer_first_area_border_color" : "<?php echo esc_html($_style_datas['footer_first_area_border_color']); ?>"
								,"@footer_second_area_background_color" : "<?php echo esc_html($_style_datas['footer_second_area_background_color']); ?>"
								,"@footer_second_area_text_color" : "<?php echo esc_html($_style_datas['footer_second_area_text_color']); ?>"
								,"@footer_second_area_link_color" : "<?php echo esc_html($_style_datas['footer_second_area_link_color']); ?>"
								,"@footer_second_area_link_color_hover" : "<?php echo esc_html($_style_datas['footer_second_area_link_color_hover']); ?>"
								,"@footer_second_area_heading_color" : "<?php echo esc_html($_style_datas['footer_second_area_heading_color']); ?>"
								,"@footer_second_area_border_color" : "<?php echo esc_html($_style_datas['footer_second_area_border_color']); ?>"
								,"@footer_thrid_area_background_color" : "<?php echo esc_html($_style_datas['footer_thrid_area_background_color']); ?>"
								,"@footer_thrid_area_text_color" : "<?php echo esc_html($_style_datas['footer_thrid_area_text_color']); ?>"
								,"@footer_thrid_area_link_color" : "<?php echo esc_html($_style_datas['footer_thrid_area_link_color']); ?>"
								,"@footer_thrid_area_link_color_hover" : "<?php echo esc_html($_style_datas['footer_thrid_area_link_color_hover']); ?>"
								,"@footer_thrid_area_border_color" : "<?php echo esc_html($_style_datas['footer_thrid_area_border_color']); ?>"

								// Sidebar
								,"@sidebar_text_color" :  "<?php echo esc_html($_style_datas['sidebar_text_color']); ?>"
								,"@sidebar_link_color" : "<?php echo esc_html($_style_datas['sidebar_link_color']); ?>"
								,"@sidebar_link_color_hover" : "<?php echo esc_html($_style_datas['sidebar_link_color_hover']); ?>"
								,"@sidebar_heading_color" :  "<?php echo esc_html($_style_datas['sidebar_heading_color']); ?>"
								,"@sidebar_border_color" : "<?php echo esc_html($_style_datas['sidebar_border_color']); ?>"

								// Especial
								,"@primary_text_color" : "<?php echo esc_html($_style_datas['primary_text_color']); ?>"
								,"@primary_link_color" : "<?php echo esc_html($_style_datas['primary_link_color']); ?>"
								,"@primary_link_color_hover" : "<?php echo esc_html($_style_datas['primary_link_color_hover']); ?>"
								,"@primary_heading_color" : "<?php echo esc_html($_style_datas['primary_heading_color']); ?>"
								,"@primary_button_background_color" : "<?php echo esc_html($_style_datas['primary_button_background_color']); ?>"
								,"@primary_button_border_color" : "<?php echo esc_html($_style_datas['primary_button_border_color']); ?>"
								,"@primary_button_text_color" : "<?php echo esc_html($_style_datas['primary_button_text_color']); ?>"
								,"@primary_button_background_color_hover" : "<?php echo esc_html($_style_datas['primary_button_background_color_hover']); ?>" 

								,"@primary_button_border_color_hover" : "<?php echo esc_html($_style_datas['primary_button_border_color_hover']); ?>"
								,"@primary_button_text_color_hover" : "<?php echo esc_html($_style_datas['primary_button_text_color_hover']); ?>"
								,"@secondary_button_background_color" : "<?php echo esc_html($_style_datas['secondary_button_background_color']); ?>"
								,"@secondary_button_border_color" : "<?php echo esc_html($_style_datas['secondary_button_border_color']); ?>"
								,"@secondary_button_text_color" : "<?php echo esc_html($_style_datas['secondary_button_text_color']); ?>"
								,"@secondary_button_background_color_hover" : "<?php echo esc_html($_style_datas['secondary_button_background_color_hover']); ?>"
								,"@secondary_button_border_color_hover" : "<?php echo esc_html($_style_datas['secondary_button_border_color_hover']); ?>"
								,"@secondary_button_text_color_hover" : "<?php echo esc_html($_style_datas['secondary_button_text_color_hover']); ?>"
								
								,"@primary_border_color" : "<?php echo esc_html($_style_datas['primary_border_color']); ?>"
								,"@primary_border_color_hover" : "<?php echo esc_html($_style_datas['primary_border_color_hover']); ?>"
								,"@secondary_border_color" : "<?php echo esc_html($_style_datas['secondary_border_color']); ?>" 
								,"@secondary_border_color_hover" : "<?php echo esc_html($_style_datas['secondary_border_color_hover']); ?>"
								,"@primary_tab_background_color" : "<?php echo esc_html($_style_datas['primary_tab_background_color']); ?>"
								,"@primary_tab_border_color" : "<?php echo esc_html($_style_datas['primary_tab_border_color']); ?>"
								,"@primary_tab_text_color" : "<?php echo esc_html($_style_datas['primary_tab_text_color']); ?>"
								,"@primary_tab_active_text_color" : "<?php echo esc_html($_style_datas['primary_tab_active_text_color']); ?>"

								,"@cart_icon_color" : "<?php echo esc_html($_style_datas['cart_icon_color']); ?>"
								,"@cart_background_color" : "<?php echo esc_html($_style_datas['cart_background_color']); ?>"
								,"@cart_background_color_hover" : "<?php echo esc_html($_style_datas['cart_background_color_hover']); ?>"
								,"@feedback_background" : "<?php echo esc_html($_style_datas['feedback_background']); ?>"
								,"@feedback_background_hover" : "<?php echo esc_html($_style_datas['feedback_background_hover']); ?>"

								,"@totop_background" : "<?php echo esc_html($_style_datas['totop_background']); ?>"
								,"@totop_background_hover" : "<?php echo esc_html($_style_datas['totop_background_hover']); ?>"
								,"@scollbar" : "<?php echo esc_html($_style_datas['scollbar']); ?>"
								,"@rating_color" : "<?php echo esc_html($_style_datas['rating_color']); ?>"
								,"@quickshop_text_color" : "<?php echo esc_html($_style_datas['quickshop_text_color']); ?>"
								,"@quickshop_background_color" : "<?php echo esc_html($_style_datas['quickshop_background_color']); ?>"
								,"@quickshop_background_color_hover" : "<?php echo esc_html($_style_datas['quickshop_background_color_hover']); ?>"
								
							};
			orgin_custom_datas = custom_datas;
			
			<?php if( $enable_custom_font && $enable_custom_color ) : ?>
			
			if ( jQuery.cookie("page_layout") !== undefined ){
				jQuery('#_page_layout').val(jQuery.cookie("page_layout"));
				jQuery('body').removeClass('wide box').addClass(jQuery.cookie("page_layout"));
			}
			if ( jQuery.cookie("bg_image") !== undefined ){
				jQuery('ul.wd-background-patten > li.active').removeClass('active');
				var _img_id = '#'+jQuery.cookie("bg_image");
				if( jQuery(_img_id).length > 0 ){
					jQuery('body').css( "background-image",'url("' + jQuery(_img_id).attr('src') + '")' );
					jQuery('body').css( "background-repeat","repeat" );	
					jQuery(_img_id).parent().addClass('active');
				}
			}			
			if ( jQuery.cookie("bg_color") !== undefined ){
				set_color( '.colorpicker_background_color',jQuery.cookie("bg_color") );
				jQuery('body').css('background-color',jQuery.cookie("bg_color"));	
			}			
			
			if ( jQuery.cookie("custom_datas") !== undefined ){
				var number_cookie = get_number_cookie(custom_datas);
				//custom_datas = jQuery.cookie("custom_datas");
				custom_datas = get_from_cookie(number_cookie);
				if( typeof custom_datas == 'string' ){
					custom_datas = jQuery.parseJSON(custom_datas);
					//console.log(custom_datas);
					<?php if( $enable_custom_color ) : ?>
					set_color('.colorpicker_theme_color',custom_datas['@primary_color']);//
					set_color('.colorpicker_secondary_color',custom_datas['@secondary_color']);
					
					
					set_color('.colorpicker_header_top_color',custom_datas['@header_top_background']);
					set_color('.colorpicker_header_middle_color',custom_datas['@header_menu_text_color']);
					set_color('.colorpicker_footer_first_color',custom_datas['@footer_first_area_background_color']);
					set_color('.colorpicker_footer_second_color',custom_datas['@footer_second_area_background_color']);
					set_color('.colorpicker_footer_third_color',custom_datas['@footer_thrid_area_background_color']);
					set_color('.colorpicker_text_color',custom_datas['@primary_text_color']);
					set_color('.colorpicker_heading_color',custom_datas['@primary_heading_color']);
					set_color('.colorpicker_menu_text_color',custom_datas['@header_menu_text_color']);
					set_color('.colorpicker_sub_menu_text_color',custom_datas['@header_submenu_text_color']);
					<?php endif;?>
					
					<?php if( $enable_custom_font ) : ?>
					
					loadSelectedFont(custom_datas['@font_body'],jQuery.cookie("body_font_style_str"));
					loadSelectedFont(custom_datas['@font_heading'],jQuery.cookie("heading_font_style_str"));
					loadSelectedFont(custom_datas['@font_menu'],jQuery.cookie("menu_font_style_str"));
					loadSelectedFont(custom_datas['@font_sub_menu'],jQuery.cookie("sub_menu_font_style_str"));
					
					jQuery('body').bind('font_load_success',function(){
						setTimeout(function(){
							jQuery('#list_body_font').val(custom_datas['@font_body']);
							jQuery('#list_heading_font').val(custom_datas['@font_heading']);
							jQuery('#list_menu_font').val(custom_datas['@font_menu']);
							jQuery('#list_sub_menu_font').val(custom_datas['@font_sub_menu']);
						},1000);
						setTimeout(function(){
							if ( jQuery.cookie("body_font_style_str") !== undefined ){
								if( custom_datas['@font_body'] != 'Roboto' ){
									weight_array = font_config[custom_datas['@font_body']][0];
									weight_array = weight_array[0];
									jQuery.each(weight_array, function(index, value) {
										option_weight_html = '<option value="'+value+'">' + value + '</option>';
										jQuery('#body_font_weight').append(option_weight_html);
									});
								}	
								jQuery('#body_font_weight').val( jQuery.cookie("body_font_style_str") );
							}
							if ( jQuery.cookie("heading_font_style_str") !== undefined ){
								if( custom_datas['@font_heading'] != 'Share'  ){
									weight_array = font_config[custom_datas['@font_heading']][0];
									weight_array = weight_array[0];
									jQuery.each(weight_array, function(index, value) {
										option_weight_html = '<option value="'+value+'">' + value + '</option>';
										jQuery('#heading_font_weight').append(option_weight_html);
									});
								}							
								jQuery('#heading_font_weight').val( jQuery.cookie("heading_font_style_str") );
							}
								
							if ( jQuery.cookie("menu_font_style_str") !== undefined ){
								if( custom_datas['@font_menu'] != 'Share' ){
									weight_array = font_config[custom_datas['@font_menu']][0];
									weight_array = weight_array[0];
									jQuery.each(weight_array, function(index, value) {
										option_weight_html = '<option value="'+value+'">' + value + '</option>';
										jQuery('#menu_font_weight').append(option_weight_html);
									});
								}
								jQuery('#menu_font_weight').val( jQuery.cookie("menu_font_style_str") );
							}
							
							if ( jQuery.cookie("sub_menu_font_style_str") !== undefined ){
								if( custom_datas['@font_sub_menu'] != 'Roboto' ){
									weight_array = font_config[custom_datas['@font_sub_menu']][0];
									weight_array = weight_array[0];
									jQuery.each(weight_array, function(index, value) {
										option_weight_html = '<option value="'+value+'">' + value + '</option>';
										jQuery('#sub_menu_font_weight').append(option_weight_html);
									});
								}
								jQuery('#sub_menu_font_weight').val( jQuery.cookie("sub_menu_font_style_str") );
							}		
						},3000);						
					});
					<?php endif;?>
					less.modifyVars(custom_datas);
				}
			}
			<?php endif;?>
			

			
					
			jQuery('ul.wd-background-patten > li > img.wd-background-patten-image').click(function(event){
				jQuery('ul.wd-background-patten > li.active').removeClass('active');
				$_src_img = jQuery(this).attr('src');
				jQuery('body').css( "background-image",'url("' + $_src_img + '")' );
				jQuery('body').css( "background-repeat","repeat" );		
				jQuery.cookie("bg_image", jQuery(this).attr('id'));
				jQuery(this).parent().addClass('active');
				if(jQuery(this).attr('id') == 'patten_0'){
					jQuery('.wd-background-wrapper .color').children('.add-on.default-style').hide();
					jQuery('.wd-background-wrapper .color').children('#background_color').prop('disabled', true);
				} else {
					jQuery('.wd-background-wrapper .color').children('.add-on.default-style').show();
					jQuery('.wd-background-wrapper .color').children('#background_color').prop('disabled', false);
				}
				event.preventDefault();
			});
			jQuery('#_page_layout').change(function(event){
				//less goes here
				jQuery('body').removeClass('wide').removeClass('box').addClass(jQuery(this).val());
				jQuery.cookie("page_layout", jQuery(this).val());
				
				if( jQuery('.slideshow-wrapper').length > 0 ){
					if( jQuery(this).val() == 'wide' ){
						jQuery('.slideshow-wrapper').removeClass('container').addClass('wide');
						jQuery('.slideshow-sub-wrapper').removeClass('span24').addClass('wide-wrapper');
					}	
					if( jQuery(this).val() == 'box' ){
						jQuery('.slideshow-wrapper').removeClass('wide').addClass('container');
						jQuery('.slideshow-sub-wrapper').removeClass('wide-wrapper').addClass('span24');
						jQuery('body').css('background-color',jQuery('input#background_color').val());	
						jQuery.cookie("bg_color", jQuery('input#background_color').val());	
						//jQuery('body').css('background-color',jQuery.cookie("bg_color"));	
						//#f5f0f0
						
					}	
					jQuery('body').trigger('resize');					
				}

			});		
	
	
			jQuery('#wd-control-panel').find('p,span,a,button,div,input,textarea,button').addClass('default-style');
			
			<?php if( $enable_custom_font ) : ?>
			/******************START FONT LOADER*******************/
			var body_option_html,selected_body_font,selected_body_weight,body_font_weight_obj,heading_font_weight_obj,menu_font_weight_obj;
			font_config = new Array();
			selected_body_weight = '<?php echo esc_html($body_font_style_str); ?>';
			selected_body_font = '<?php echo esc_html($_style_datas['body_font_name']); ?>';

			selected_body_font = jQuery.trim(selected_body_font);
			selected_body_weight = jQuery.trim(selected_body_weight);
			
			selected_heading_weight = '<?php echo esc_html($heading_font_style_str); ?>';
			selected_heading_font = '<?php echo esc_html($_style_datas['heading_font_name']); ?>';

			selected_heading_font = jQuery.trim(selected_heading_font);
			selected_heading_weight = jQuery.trim(selected_heading_weight);

			selected_menu_weight = '<?php echo esc_html($style_datas['menu_font_style_str']); ?>';
			selected_menu_font = '<?php echo esc_html($_style_datas['menu_font_name']); ?>';

			selected_menu_font = jQuery.trim(selected_menu_font);
			selected_menu_weight = jQuery.trim(selected_menu_weight);				
			
			selected_sub_menu_weight = '<?php echo esc_html($style_datas['sub_menu_font_style_str']); ?>';
			selected_sub_menu_font = '<?php echo esc_html($_style_datas['sub_menu_font_name']); ?>';

			selected_sub_menu_font = jQuery.trim(selected_sub_menu_font);
			selected_sub_menu_weight = jQuery.trim(selected_sub_menu_weight);
			

			jQuery.ajax("<?php echo esc_url($google_font_url); ?>", {
				data : { sort: "<?php echo esc_html($font_sort);?>" }
				,dataType: 'jsonp'
				,success : function(data){
					
					if( typeof(data) == 'string' ){
						data = JSON.parse(data);
					}
					option_html = "";
					//apend list font to select box,prepare data for font array object
					jQuery.each(data.items, function(i, obj) {
						font_config[obj.family] = new Array(
							new Array(obj.variants)
							,new Array(obj.subsets)
						);
						option_html = option_html + '<option value="'+obj.family+'" >' + obj.family + '</option>';
					});
					
					jQuery('#list_body_font').html("<option value='Roboto'>Default</option>"+option_html).val(selected_body_font);
					jQuery('#list_heading_font').html("<option value='Share'>Default</option>"+option_html).val(selected_heading_font);
					jQuery('#list_menu_font').html("<option value='Share'>Default</option>"+option_html).val(selected_menu_font);					
					jQuery('#list_sub_menu_font').html("<option value='Roboto'>Default</option>"+option_html).val(selected_sub_menu_font);					
					
					//do the first font weight
					if( selected_body_font.length <= 0 ){
						body_font_weight_obj = data.items[0].variants;
					}else{
						if( selected_body_font != 'Roboto' ){
							body_font_weight_obj = font_config[selected_body_font][0][0];
						}else{
							body_font_weight_obj = new Array();
						}
					}
					
					if( selected_heading_font.length <= 0 ){
						heading_font_weight_obj = data.items[0].variants;
					}else{
						if( selected_heading_font != 'Share' ){
							heading_font_weight_obj = font_config[selected_heading_font][0][0];
						}else{
							heading_font_weight_obj = new Array();
						}						
					}
					
					if( selected_menu_font.length <= 0 ){
						menu_font_weight_obj = data.items[0].variants;
					}else{
						if( selected_menu_font != 'Share' ){
							menu_font_weight_obj = font_config[selected_menu_font][0][0];
						}else{
							menu_font_weight_obj = new Array();
						}						
					}	
						
					if( selected_sub_menu_font.length <= 0 ){
						sub_menu_font_weight_obj = data.items[0].variants;
					}else{
						if( selected_sub_menu_font != 'Share' ){
							sub_menu_font_weight_obj = font_config[selected_sub_menu_font][0][0];
						}else{
							sub_menu_font_weight_obj = new Array();
						}						
					}				
					
					jQuery.each(body_font_weight_obj, function(i, obj) {
						body_selected_str = ( selected_body_weight == obj ? "selected" : "");
						body_option_html = '<option value="'+obj+'"' + body_selected_str + '>' + obj + '</option>';
						jQuery('#body_font_weight').append(body_option_html);

					});
					
					jQuery.each(heading_font_weight_obj, function(i, obj) {
						heading_selected_str = ( selected_heading_weight == obj ? "selected" : "");
						heading_option_html = '<option value="'+obj+'"' + heading_selected_str + '>' + obj + '</option>';
						jQuery('#heading_font_weight').append(heading_option_html);
					});				
					
					
					jQuery.each(menu_font_weight_obj, function(i, obj) {
						menu_selected_str = ( selected_menu_weight == obj ? "selected" : "");
						menu_option_html = '<option value="'+obj+'"' + menu_selected_str + '>' + obj + '</option>';
						jQuery('#menu_font_weight').append(menu_option_html);
					});				
					
					jQuery.each(sub_menu_font_weight_obj, function(i, obj) {
						sub_menu_selected_str = ( selected_sub_menu_weight == obj ? "selected" : "");
						sub_menu_option_html = '<option value="'+obj+'"' + sub_menu_selected_str + '>' + obj + '</option>';
						jQuery('#sub_menu_font_weight').append(sub_menu_option_html);
					});
					
					jQuery('body').trigger('font_load_success');
					//end first font weigh
				}


			});

				//select another font,reload font weight
				jQuery('#list_body_font').change(function(event){
					jQuery('#body_font_weight').html('');
					if( jQuery(this).val() != 'Roboto' ){
						weight_array = font_config[jQuery(this).val()][0];
						weight_array = weight_array[0];
						jQuery.each(weight_array, function(index, value) {
							option_weight_html = '<option value="'+value+'">' + value + '</option>';
							jQuery('#body_font_weight').append(option_weight_html);
						});
						loadSelectedFont(jQuery(this).val(),jQuery('#body_font_weight').val());
					}
					custom_datas['@font_body'] = jQuery(this).val();
					jQuery.cookie("body_font_style_str", jQuery('#body_font_weight').val());
					jQuery('body').trigger('less_update');
					//less goes here
				});

				jQuery('#list_heading_font').change(function(event){
					jQuery('#heading_font_weight').html('');
					if( jQuery(this).val() != 'Share' ){
						weight_array = font_config[jQuery(this).val()][0];
						weight_array = weight_array[0];
						jQuery.each(weight_array, function(index, value) {
							option_weight_html = '<option value="'+value+'">' + value + '</option>';
							jQuery('#heading_font_weight').append(option_weight_html);
						});
						loadSelectedFont(jQuery(this).val(),jQuery('#heading_font_weight').val());
					}
					custom_datas['@font_heading'] = jQuery(this).val();
					jQuery.cookie("heading_font_style_str", jQuery('#heading_font_weight').val());
					jQuery('body').trigger('less_update');
					//less goes here
				});	

				jQuery('#list_menu_font').change(function(event){
					jQuery('#menu_font_weight').html('');
					if( jQuery(this).val() != 'Share' ){
						weight_array = font_config[jQuery(this).val()][0];
						weight_array = weight_array[0];
						jQuery.each(weight_array, function(index, value) {
							option_weight_html = '<option value="'+value+'">' + value + '</option>';
							jQuery('#menu_font_weight').append(option_weight_html);
						});
						loadSelectedFont(jQuery(this).val(),jQuery('#menu_font_weight').val());
					}
					custom_datas['@font_menu'] = jQuery(this).val();
					jQuery.cookie("menu_font_style_str", jQuery('#menu_font_weight').val());
					jQuery('body').trigger('less_update');
					//less goes here
				});					
				
				jQuery('#list_sub_menu_font').change(function(event){
					jQuery('#sub_menu_font_weight').html('');
					if( jQuery(this).val() != 'Roboto' ){
						weight_array = font_config[jQuery(this).val()][0];
						weight_array = weight_array[0];
						jQuery.each(weight_array, function(index, value) {
							option_weight_html = '<option value="'+value+'">' + value + '</option>';
							jQuery('#sub_menu_font_weight').append(option_weight_html);
						});
						loadSelectedFont(jQuery(this).val(),jQuery('#sub_menu_font_weight').val());
					}
					custom_datas['@font_sub_menu'] = jQuery(this).val();
					jQuery.cookie("sub_menu_font_style_str", jQuery('#sub_menu_font_weight').val());
					jQuery('body').trigger('less_update');
					//less goes here
				});
			
			jQuery('#body_font_weight').change(function(event){
				//less goes here
				custom_datas['@font_body_fontweight'] = get_font_weight(jQuery(this).val());
				custom_datas['@font_body_fontstyle'] = get_font_style(jQuery(this).val());
				loadSelectedFont(jQuery('#list_body_font').val(),jQuery(this).val());
				jQuery.cookie("body_font_style_str", jQuery(this).val());
				jQuery('body').trigger('less_update');
			});
			jQuery('#heading_font_weight').change(function(event){
				//less goes here
				custom_datas['@font_heading_fontweight'] = get_font_weight(jQuery(this).val());
				custom_datas['@font_heading_fontstyle'] = get_font_style(jQuery(this).val());
				loadSelectedFont(jQuery('#list_heading_font').val(),jQuery(this).val());
				jQuery.cookie("heading_font_style_str", jQuery(this).val());
				jQuery('body').trigger('less_update');
			});	
			jQuery('#menu_font_weight').change(function(event){
				//less goes here
				custom_datas['@font_menu_fontweight'] = get_font_weight(jQuery(this).val());
				custom_datas['@font_menu_fontstyle'] = get_font_style(jQuery(this).val());
				loadSelectedFont(jQuery('#list_menu_font').val(),jQuery(this).val());
				jQuery.cookie("menu_font_style_str", jQuery(this).val());
				jQuery('body').trigger('less_update');
			});	
			jQuery('#sub_menu_font_weight').change(function(event){
				//less goes here
				custom_datas['@font_sub_menu_fontweight'] = get_font_weight(jQuery(this).val());
				custom_datas['@font_sub_menu_fontstyle'] = get_font_style(jQuery(this).val());
				loadSelectedFont(jQuery('#list_sub_menu_font').val(),jQuery(this).val());
				jQuery.cookie("sub_menu_font_style_str", jQuery(this).val());
				jQuery('body').trigger('less_update');
			});	
		/******************END FONT LOADER*******************/
		<?php endif; ?>
		

		<?php if( $enable_custom_color ) : ?>
		/******************START COLOR PICKER*******************/
		// color picker1 - Theme color
		$body_bg_picker = jQuery('.colorpicker_theme_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['@primary_color'] = ev.color.toHex();
			custom_datas['@header_top_background'] = ev.color.toHex();
			custom_datas['@header_menu_active_text_color'] = ev.color.toHex();
			custom_datas['@header_submenu_border_top_color'] = ev.color.toHex();
			custom_datas['@header_submenu_hover_item_color'] = ev.color.toHex();
			custom_datas['@footer_first_area_link_color'] = ev.color.toHex();
			custom_datas['@footer_first_area_heading_color'] = ev.color.toHex();
			custom_datas['@footer_second_area_background_color'] = ev.color.toHex();
			custom_datas['@footer_thrid_area_background_color'] = ev.color.toHex();
			custom_datas['@sidebar_link_color'] = ev.color.toHex();
			custom_datas['@sidebar_heading_color'] = ev.color.toHex();
			custom_datas['@primary_heading_color'] = ev.color.toHex();
			custom_datas['@primary_border_color'] = ev.color.toHex();
			custom_datas['@secondary_border_color_hover'] = ev.color.toHex();
			custom_datas['@primary_tab_background_color'] = ev.color.toHex();
			custom_datas['@primary_tab_border_color'] = ev.color.toHex();
			custom_datas['@cart_background_color_hover'] = ev.color.toHex();
			custom_datas['@feedback_background'] = ev.color.toHex();
			custom_datas['@totop_background'] = ev.color.toHex();
			custom_datas['@scollbar'] = ev.color.toHex();
			custom_datas['@rating_color'] = ev.color.toHex();
			custom_datas['@quickshop_background_color'] = ev.color.toHex();	
			custom_datas['@feedback_background'] = ev.color.toHex();
			custom_datas['@totop_background'] = ev.color.toHex();
			custom_datas['@primary_border_color'] = ev.color.toHex();			
			
			jQuery('body').trigger('less_update');
		});

		// color picker1 - Theme color
		$secondary_bg_picker = jQuery('.colorpicker_secondary_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['@secondary_color'] = ev.color.toHex();
			
			custom_datas['@footer_first_area_link_color_hover'] = ev.color.toHex();
			custom_datas['@footer_second_area_link_color_hover'] = ev.color.toHex();
			custom_datas['@sidebar_link_color_hover'] = ev.color.toHex();
			custom_datas['@primary_link_color_hover'] = ev.color.toHex();
			custom_datas['@primary_button_background_color_hover'] = ev.color.toHex();
			
			custom_datas['@primary_button_border_color_hover'] = ev.color.toHex();
			custom_datas['@secondary_button_border_color_hover'] = ev.color.toHex();
			custom_datas['@secondary_button_text_color_hover'] = ev.color.toHex();
			custom_datas['@primary_border_color_hover'] = ev.color.toHex();
			custom_datas['@cart_background_color_hover'] = ev.color.toHex();
			
			custom_datas['@feedback_background_hover'] = ev.color.toHex();
			custom_datas['@totop_background_hover'] = ev.color.toHex();
			custom_datas['@quickshop_background_color_hover'] = ev.color.toHex();

			
			jQuery('body').trigger('less_update');
		});		
		
		$background_bg_picker = jQuery('.colorpicker_background_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			jQuery('body').css('background-color',ev.color.toHex());	
			jQuery.cookie("bg_color", ev.color.toHex());			
		});
		
		$header_top_bg_picker = jQuery('.colorpicker_header_top_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['@header_top_background'] = ev.color.toHex();
			//console.log(custom_datas);
			jQuery('body').trigger('less_update');
		});
		// color picker3 - colorpicker_header_middle_color
		$header_middle_bg_picker = jQuery('.colorpicker_header_middle_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['@header_menu_text_color'] = ev.color.toHex();
			jQuery('body').trigger('less_update');
		});
		
		// color picker4 - colorpicker_footer_first_color
		$text_picker = jQuery('.colorpicker_footer_first_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			var rgb = ev.color.toRGB();
			rgb =  'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+rgb.a+')';
			custom_datas['@footer_first_area_background_color'] = rgb;	
			jQuery('body').trigger('less_update');			
		});
		// color picker4 - colorpicker_footer_second_color
		$text_picker = jQuery('.colorpicker_footer_second_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['@footer_second_area_background_color'] = ev.color.toHex();	
			jQuery('body').trigger('less_update');			
		});
		// color picker4 - colorpicker_footer_third_color
		$text_picker = jQuery('.colorpicker_footer_third_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['@footer_thrid_area_background_color'] = ev.color.toHex();	
			jQuery('body').trigger('less_update');			
		});
		
		// color picker4 - color text body
		$text_picker = jQuery('.colorpicker_text_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['@primary_text_color'] = ev.color.toHex();	
			jQuery('body').trigger('less_update');			
		});
		
		// color picker5 - heading
		$heading_picker = jQuery('.colorpicker_heading_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['@primary_heading_color'] = ev.color.toHex();
			custom_datas['@sidebar_heading_color'] = ev.color.toHex();
			custom_datas['@footer_first_area_heading_color'] = ev.color.toHex();
			custom_datas['@footer_second_area_heading_color'] = ev.color.toHex();
			jQuery('body').trigger('less_update');
		});
		
		$menu_color_picker = jQuery('.colorpicker_menu_text_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['@header_menu_text_color'] = ev.color.toHex();
			jQuery('body').trigger('less_update');
		});
		
		$hover_picker = jQuery('.colorpicker_sub_menu_text_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['@header_submenu_text_color'] = ev.color.toHex();
			jQuery('body').trigger('less_update');
		});
		/******************END COLOR PICKER*******************/
		<?php endif; ?>
		
	
		jQuery('body').bind('less_update',jQuery.debounce( 250, function(){	
			less.modifyVars(custom_datas);	
			set_cookie(custom_datas);
			//jQuery.cookie("custom_datas", JSON.stringify(custom_datas));	
			var _container_offet = jQuery('.header-middle').offset();
			
			setTimeout(function(){
				jQuery('.menu-item-level0.wd-mega-menu.fullwidth-menu').each(function(index,value){
					var _cur_offset = jQuery(value).offset();
					var _margin_left = _cur_offset.left - _container_offet.left ;
					jQuery(value).children('ul.sub-menu').css('width',jQuery('.header-main-content').outerWidth()).css('margin-left','-'+_margin_left+'px');
					
				});	
			},3000);			
		}));
	
		/******************START PANEL CONTROLLER*******************/
		
			// open and close custom panel
			var $et_control_panel = jQuery('#wd-control-panel'),
			$et_control_close = jQuery('#wd-control-close');

			$et_control_panel.animate( { left: -$et_control_panel.outerWidth() } );
			
			$et_control_close.click(function(){
				if ( jQuery(this).hasClass('control-open') ) {
					$et_control_panel.animate( { left: -jQuery("#wd-control-panel").outerWidth() } );
					jQuery(this).removeClass('control-open');
					jQuery.cookie('et_aggregate_control_panel_open', 0);
				} else {
					$et_control_panel.animate( { left: 0 } );
					jQuery(this).addClass('control-open');
					jQuery.cookie('et_aggregate_control_panel_open', 1);
				}
				return false;
			});
			if ( jQuery.cookie('et_aggregate_control_panel_open') == 1 ) { 
				$et_control_panel.animate( { left: 0 } );
				$et_control_close.addClass('control-open');
			}else{
				$et_control_panel.animate( { left: -jQuery("#wd-control-panel").outerWidth() } );
				$et_control_close.removeClass('control-open');
			}			
		/******************END PANEL CONTROLLER*******************/
		
		/******************START AJAX SAVE CONFIG*******************/
		jQuery('#font-clear-btn').click(function(event){
			//jQuery.removeCookie("custom_datas");
			remove_data_cookie(custom_datas);
			jQuery.removeCookie("page_layout");
			jQuery.removeCookie("bg_image");
			jQuery.removeCookie("bg_color");
			jQuery.removeCookie("body_font_style_str");
			jQuery.removeCookie("heading_font_style_str");
			jQuery.removeCookie("menu_font_style_str");
			jQuery('body').css( "background-image",'' );
			jQuery('body').css( "background-color","#f5f5f5" );		

			jQuery('#_page_layout').val('<?php echo esc_html($style_datas['page_layout']);?>').trigger('change');
			jQuery('ul.wd-background-patten > li.active').removeClass('active');
			
			custom_datas = orgin_custom_datas;
			setTimeout(function(){
				jQuery('#list_body_font').val(custom_datas['@font_body']);
				jQuery('#list_heading_font').val(custom_datas['@font_heading']);
				jQuery('#list_menu_font').val(custom_datas['@font_menu']);
				jQuery('#list_sub_menu_font').val(custom_datas['@font_sub_menu']);
			},1000);			
			
			less.modifyVars(custom_datas);
		});
		
		
			jQuery('#font-save-btn').click(function(event){
				
				var current_btn = jQuery(this);
				current_btn.button('loading');
			
				var ajax_data =  {
						//action
						action  				: 'wd_ajax_style'
						//verify nonce
						,ajax_preview			: jQuery('#preview_nonce_field').val()
						,page_layout 			: jQuery('#_page_layout').val()
						,body_font_style_str 	: jQuery('#body_font_weight').val() === null ? "" : jQuery('#body_font_weight').val()
						,heading_font_style_str	: jQuery('#heading_font_weight').val() === null ? "" : jQuery('#heading_font_weight').val()
						,menu_font_style_str	: jQuery('#menu_font_weight').val() === null ? "" : jQuery('#menu_font_weight').val()
						,sub_menu_font_style_str	: jQuery('#sub_menu_font_weight').val() === null ? "" : jQuery('#sub_menu_font_weight').val()
				};	
				ajax_data = jQuery.extend(ajax_data, custom_datas);
				if( ajax_data['@font_body'] == 'Roboto' )
					ajax_data['@font_body'] = -1;
				if( ajax_data['@font_heading'] == 'Share' )
					ajax_data['@font_heading'] = -1;
				if( ajax_data['@font_menu'] == 'Share' )
					ajax_data['@font_menu'] = -1;					
				if( ajax_data['@font_sub_menu'] == 'Roboto' )
					ajax_data['@font_sub_menu'] = -1;
				
				//console.log(ajax_data);
				jQuery.ajax({
					type  :'POST'
					,url   : '<?php echo admin_url('admin-ajax.php'); ?>'
					,data  : ajax_data
					,success : function(data){
						
						if( parseInt(data) == 1 ){
							jQuery('#preview-save-result').html('Success').attr('class','alert alert-success').show()//.wait(3000).hide();
							setTimeout(								
								function(){
									jQuery('#preview-save-result').hide();
								},3000);
						}else{
							jQuery('#preview-save-result').html('Error!Sufficient permissions').attr('class','alert alert-error').show()//.wait(3000).hide();
							setTimeout(	
								function(){
									jQuery('#preview-save-result').hide();
								},3000);
						}	
						current_btn.button('reset');
					}			
				}).fail(function(){
					current_btn.button('reset');
				});
			});		

		
		
		/******************END AJAX SAVE CONFIG*******************/	

	});
	//]]>
	</script>	
	<?php
		}
	}
?>