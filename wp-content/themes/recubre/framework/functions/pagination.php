<?php 
/*
	Generate pagination.
	Input : 
		- int $num_pages_per_phrase : the number of page per group.
	No output.
*/
function ew_get_pagenum_link($pagenum = 1, $escape = true ) {
    global $wp_rewrite;

    $pagenum = (int) $pagenum;

    $request = remove_query_arg( 'paged' );

    $home_root = parse_url(home_url());
    $home_root = ( isset($home_root['path']) ) ? $home_root['path'] : '';
    $home_root = preg_quote( trailingslashit( $home_root ), '|' );

    $request = preg_replace('|^'. $home_root . '|', '', $request);
    $request = preg_replace('|^/+|', '', $request);

    if ( !$wp_rewrite->using_permalinks() || is_admin() ) {
        $base = trailingslashit( home_url() );

        if ( $pagenum > 1 ) {
            //$result = add_query_arg( 'paged', $pagenum, $base . $request );
			$result = $base . $request;
        } else {
            $result = $base . $request;
        }
    } else {
        $qs_regex = '|\?.*?$|';
        preg_match( $qs_regex, $request, $qs_match );

        if ( !empty( $qs_match[0] ) ) {
            $query_string = $qs_match[0];
            $request = preg_replace( $qs_regex, '', $request );
        } else {
            $query_string = '';
        }

        $request = preg_replace( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request);
        $request = preg_replace( '|^index\.php|', '', $request);
        $request = ltrim($request, '/');

        $base = trailingslashit( home_url() );

        if ( $wp_rewrite->using_index_permalinks() && ( $pagenum > 1 || '' != $request ) )
            $base .= 'index.php/';

        if ( $pagenum > 1 ) {
            $request = ( ( !empty( $request ) ) ? trailingslashit( $request ) : $request ) . user_trailingslashit( $wp_rewrite->pagination_base . "/" . $pagenum, 'paged' );
        }

        $result = $base . $request . $query_string;
    }

    $result = apply_filters('get_pagenum_link', $result);

    if ( $escape )
        return esc_url( $result );
    else
        return esc_url_raw( $result );
}

/**************************important hook**************************/

//add_filter( 'option_posts_per_page' , 'wd_change_posts_per_page'); //filter and change posts_per_page
add_action ('pre_get_posts','prepare_post_query',9); //hook into pre_get_posts to reset some querys

/*merge query post type function*/

function merge_post_type($query,$new_type = array()){
	$defaut_post_type = ( post_type_exists( 'portfolio' ) ? array('portfolio','post') : array('post') );
	$new_type = (is_array($new_type) && count($new_type) > 0) ? $new_type : $defaut_post_type;
	$default_post_type = $query->get('post_type');
	if(is_array($default_post_type)){
		$new_type = array_merge($default_post_type, $new_type);
	}else{
		$new_type = array_merge(array($default_post_type), $new_type);
	}
	return ( $new_type = array_unique($new_type) );
}
/*end merge query post type function*/

function remove_page_from_search_query($where_query){
	$where_query .= " AND wp_posts.post_type NOT IN ('page') ";
	return $where_query;
}

function add_a2z_query($where_query){
	$_start_char = get_query_var('start_char');
	$_up_char = strtoupper($_start_char);
	$_down_char = strtolower($_start_char);
	$where_query .= " AND left(wp_posts.post_title,1) IN ('{$_up_char}','{$_down_char}') ";
	return $where_query;
}


function prepare_post_query($query){
	
	global $page_datas,$post;
	$paged = (int)get_query_var('paged');
		
	
	if($paged>0){
		set_query_var('page',$paged);
	}
	if($query->is_tag()){
		$query->set('post_type',merge_post_type($query) );
	}
	if($query->is_search()){	
		//add_action( "posts_where", "remove_page_from_search_query", 10 );
	}	
	if($query->is_date()){
		$query->set('post_type',merge_post_type($query) );
	}

	if($query->is_author()){
		$query->set('post_type',merge_post_type($query) );
	}
	return $query;
	
}

add_action( 'template_redirect', 'my_page_template_redirect' );

function my_page_template_redirect(){
	global $wp_query,$post,$page_datas;
	if($wp_query->is_page()){
		global $page_datas,$wd_custom_style_config;
		$page_datas = unserialize(get_post_meta($post->ID,THEME_SLUG.'page_configuration',true));
		$page_datas = wd_array_atts(array(	
											"page_layout" 			=> '0'
											,"page_column" 			=> '0-1-0'
											,"left_sidebar" 		=> 'primary-widget-area'
											,"right_sidebar" 		=> 'primary-widget-area'
											,"page_slider" 			=> 'none'
											,"page_revolution" 		=> ''
											,"page_flex" 			=> ''
											,"page_nivo" 			=> ''		
											,"product_tag"			=> ''
											,"portfolio_columns" 	=> 1
											,"portfolio_filter"		=> 1
											,"hide_new_product" 	=> 1
											,"hide_breadcrumb" 		=> 0	
											//,"hide_ads" 			=> 0	
											,"hide_title" 			=> 0
											,"hide_banner"			=> 1											
										),$page_datas);		
		$wd_custom_style_config['page_layout'] = strcmp($page_datas['page_layout'],'0') == 0 ? $wd_custom_style_config['page_layout'] : $page_datas['page_layout'] ;
		
	
	}
	
	if( is_tax( 'product_cat' ) ){
		global $wp_query,$category_prod_datas;
		$category_product_config = get_option(THEME_SLUG.'category_product_config','');
		$category_product_config = unserialize($category_product_config);
		
		$category_prod_datas = wd_array_atts(
			array(
						'cat_columns' 				=> 3
						,'cat_layout' 				=> "1-1-0"
						,'cat_left_sidebar' 		=> "category-widget-area"
						,'cat_right_sidebar' 		=> "category-widget-area"
				)
			,$category_product_config);	
			
		/******************* Start Load Config On Category Product ******************/
		$term = $wp_query->queried_object;
		
		$_term_config = get_metadata( 'woocommerce_term', $term->term_id, "cat_config", true );
		
		
		if( strlen($_term_config) > 0 ){
			$_term_config = unserialize($_term_config);	
			
			if( is_array($_term_config) && count($_term_config) > 0 ){
				$category_prod_datas['cat_columns'] = ( isset($_term_config['cat_columns']) && strlen($_term_config['cat_columns']) > 0 && (int)$_term_config['cat_columns'] != 0 ) ? $_term_config['cat_columns'] : $category_prod_datas['cat_columns'];
				$category_prod_datas['cat_layout'] = ( isset($_term_config['cat_layout']) && strlen($_term_config['cat_layout']) > 0 && strcmp($_term_config["cat_layout"],'0') != 0 ) ? $_term_config['cat_layout'] : $category_prod_datas['cat_layout'];
				$category_prod_datas['cat_left_sidebar'] = ( isset($_term_config['cat_left_sidebar']) && strlen($_term_config['cat_left_sidebar']) > 0 && strcmp($_term_config["cat_left_sidebar"],'0') != 0 ) ? $_term_config['cat_left_sidebar'] : $category_prod_datas['cat_left_sidebar'];
				$category_prod_datas['cat_right_sidebar'] = ( isset($_term_config['cat_right_sidebar']) && strlen($_term_config['cat_right_sidebar']) > 0 && strcmp($_term_config["cat_right_sidebar"],'0') != 0 ) ? $_term_config['cat_right_sidebar'] : $category_prod_datas['cat_right_sidebar'];
				$category_prod_datas['cat_custom_content'] = ( isset($_term_config['cat_custom_content']) && strlen($_term_config['cat_custom_content']) > 0 ) ? $_term_config['cat_custom_content'] : "";
			}
			
		}			
		/******************* End Config On Category Product ******************/	
		//print_r($category_prod_datas);
			
	}
	if ( is_singular('product') ) {
		global $single_prod_datas,$post;
		$single_product_config = get_option(THEME_SLUG.'single_product_config','');
		$single_product_config = unserialize($single_product_config);	
		$single_prod_datas = wd_array_atts(
			array(
					'show_image' 			=> 1
					,'show_label' 			=> 1
					,'show_title' 			=> 1
					,'show_email' 			=> 1
					,'show_sku' 			=> 1
					,'show_rating' 			=> 1
					,'show_view' 			=> 1
					,'show_review' 			=> 1
					,'show_availability' 	=> 1
					,'show_add_to_cart' 	=> 1
					,'show_price' 			=> 1
					,'show_short_desc'		=> 1
					,'show_meta' 			=> 1
					,'show_related' 		=> 1
					,'show_sharing'			=> 1
					,'related_title' 		=> __("Related Products","wpdance")
					,'sharing_title' 		=> "Share this"
					,'sharing_intro' 		=> "Love it?Share with your friend"
					,'sharing_custom_code' 	=> ""
					,'show_ship_return' 	=> 1				
					,'ship_return_title' 	=> 'FREE SHIPPING & RETURN'	
					,'ship_return_content' 	=>  htmlentities('<a href="#"><img src="http://demo.wpdance.com/imgs/woocommerce/return_shipping.png" alt="free shipping and return" title="free shipping and return"></a><div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry'."'".'s standard dummy text ever since the 1500s</div>')
					,'show_tabs' 			=> 1
					,'show_custom_tab' 		=> 1	
					,'custom_tab_title' 	=> "Custom Title"				
					,'custom_tab_content' 	=> "<div>Table content goes here</div>"				
					,'show_upsell' 			=> 1
					,'upsell_title'			=> __("YOU MAY ALSO BE INTERESTED IN THE FOLLOWING PRODUCT(S)",'wpdance')
					,'layout' 				=> '0-1-0'
					,'left_sidebar' 		=> 'product-widget-area'
					,'right_sidebar' 		=> 'product-widget-area'	
				)
			,$single_product_config);	

			
		/******************* Start Load Config On Single Post ******************/
		$_prod_config = get_post_meta($post->ID,THEME_SLUG.'custom_product_config',true);
		
		if( strlen($_prod_config) > 0 ){
			$_prod_config = unserialize($_prod_config);
			if( is_array($_prod_config) && count($_prod_config) > 0 ){
				$single_prod_datas['layout'] = ( isset($_prod_config['layout']) && strlen($_prod_config['layout']) > 0 && strcmp($_prod_config["layout"],'0') != 0 ) ? $_prod_config['layout'] : $single_prod_datas['layout'];
				$single_prod_datas['left_sidebar'] = ( isset($_prod_config['left_sidebar']) && strlen($_prod_config['left_sidebar']) > 0 && strcmp($_prod_config["left_sidebar"],'0') != 0 ) ? $_prod_config['left_sidebar'] : $single_prod_datas['left_sidebar'];
				$single_prod_datas['right_sidebar'] = ( isset($_prod_config['right_sidebar']) && strlen($_prod_config['right_sidebar']) > 0 && strcmp($_prod_config["right_sidebar"],'0') != 0 ) ? $_prod_config['right_sidebar'] : $single_prod_datas['right_sidebar'];
			}
		}			
		/******************* End Config On Single Post ******************/

		
		if( !$single_prod_datas['show_image'] )	
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );	

		if( !$single_prod_datas['show_label'] )	
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

		if( !$single_prod_datas['show_title'] )	
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		
		if( !$single_prod_datas['show_email'] )	
			remove_action( 'woocommerce_single_product_summary', 'wd_template_single_mail', 15 );
			
		if( !$single_prod_datas['show_sku'] )	
			//remove_action( 'woocommerce_single_product_summary', 'wd_template_single_sku', 6 );
			remove_action( 'wd_single_product_summary_end', 'wd_template_single_sku', 13 );
		
		if( !$single_prod_datas['show_rating'] ){	
			remove_action( 'wd_single_product_summary_end', 'wd_template_single_rating', 14);	
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		}
		if( !$single_prod_datas['show_view'] )	
			remove_action( 'wd_single_product_summary_end', 'ppbv_display_product', 15);
		
		if( !$single_prod_datas['show_review'] )	
			remove_action( 'woocommerce_single_product_summary', 'wd_template_single_review', 7 );

		if( !$single_prod_datas['show_availability'] )	
			//remove_action( 'woocommerce_single_product_summary', 'wd_template_single_availability', 8 );
			remove_action( 'wd_single_product_summary_end', 'wd_template_single_availability', 12 );
		if( !$single_prod_datas['show_add_to_cart'] ){
			remove_action( 'wd_single_product_summary_end', 'button_add_to_card', 16);	
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
			remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
			remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
			remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
		}

		if( !$single_prod_datas['show_price'] )	
			//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 31 );
		if( !$single_prod_datas['show_short_desc'] ){	
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
			remove_action( 'woocommerce_single_product_summary', 'wd_template_single_content', 20 );
		}	
		if( !$single_prod_datas['show_meta'] )	{
			remove_action( 'wd_single_product_summary_end', 'get_product_categories', 17);
			remove_action( 'wd_single_product_summary_end', 'product_tags_template', 18);
			//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		}
		if( !$single_prod_datas['show_related'] ){	
			//remove_action( 'woocommerce_after_single_product_summary', 'wd_output_related_products', 9 );
			remove_action( 'wd_after_single_product_summary', 'wd_output_related_products', 9 );
			add_filter( "single_product_wrapper_class", "update_single_product_wrapper_class", 10);
		}else{
			global $post;
			$_product = get_product($post);
			if ( sizeof( $_product->get_related() ) == 0 )
				add_filter( "single_product_wrapper_class", "update_single_product_wrapper_class", 10);
		}

		if( !$single_prod_datas['show_sharing'] )	
			//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_template_single_sharing', 25 );
			remove_action( 'wd_single_product_summary_end', 'woocommerce_template_single_sharing', 11 );
		if( !$single_prod_datas['show_ship_return'] )	
			remove_action( 'woocommerce_product_thumbnails', 'wd_template_shipping_return', 30 );

		if( !$single_prod_datas['show_tabs'] )	
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			
		if( !$single_prod_datas['show_custom_tab'] ){
			remove_filter( 'woocommerce_product_tabs', 'wd_addon_custom_tabs',13 );
		}		

		if( !$single_prod_datas['show_upsell'] )	
			remove_action( 'woocommerce_after_single_product_summary', 'wd_upsell_display', 15 );
		
		
	
	}
}


function wd_change_posts_per_page($option_posts_per_page){
	global $wp_query;
	if($wp_query->is_search()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_search') > 0 ? (int)get_option(THEME_SLUG.'num_post_search') : $option_posts_per_page );
        return $posts_per_page;
	}
	//if($wp_query->is_front_page() || $wp_query->is_home()){
	if( $wp_query->is_home() ){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_home') > 0 ? (int)get_option(THEME_SLUG.'num_post_home') : $option_posts_per_page );
        return $posts_per_page;
	}
	//if( is_page_template('page-templates/blog-template.php') ){
	if( $wp_query->is_page() ){
		$blog_template_array = array('blog-template.php','blogtemplate.php','portfolio.php');
		//$template_name = get_post_meta( $wp_query->queried_object_id, '_wp_page_template', true );
		$template_name = get_post_meta( $wp_query->query_vars['page_id'], '_wp_page_template', true );
		if(in_array($template_name,$blog_template_array)){
			$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_blog_page') > 0 ? (int)get_option(THEME_SLUG.'num_post_blog_page') : $option_posts_per_page );
			return $posts_per_page;
		}
	}

	if($wp_query->is_single()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_related') > 0 ? (int)get_option(THEME_SLUG.'num_post_related') : $option_posts_per_page );
        return $posts_per_page;
	}
	if($wp_query->is_category()){
		
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_cat') > 0 ? (int)get_option(THEME_SLUG.'num_post_cat') : $option_posts_per_page );
        return $posts_per_page;
	}
	if($wp_query->is_tag()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_tag') > 0 ? (int)get_option(THEME_SLUG.'num_post_tag') : $option_posts_per_page );
        return $posts_per_page;
	}
    if ($wp_query->is_category() ) {
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_cat') > 0 ? (int)get_option(THEME_SLUG.'num_post_cat') : $option_posts_per_page );
        return $posts_per_page;
    }
	if($wp_query->is_archive()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_archive') > 0 ? (int)get_option(THEME_SLUG.'num_post_archive') : $option_posts_per_page );
        return $posts_per_page;
	}
    return $option_posts_per_page;
}

/**************************end the hook**************************/

if(!function_exists ('ew_pagination')){
	function ew_pagination($num_pages_per_phrase = 3){
			if(function_exists ('wp_pagenavi')){
				wp_pagenavi() ;			
				return;
			}
			global $wp_query;

			if( !isset($_GET['page']) ){
				$_GET['page'] = 1;
			}
			
			if($wp_query->found_posts > 0) : 
			$pageLink = ew_get_pagenum_link($_GET['page']);
			$pageLink = str_replace(array('page='.$_GET['page'],'page/'.$_GET['page']),'',$pageLink);
			if(strpos($pageLink,'?') === false)
				$pageLink .= '?';
			elseif(strpos($pageLink,'?') >= 0 && strpos($pageLink,'&') === false)
				$pageLink .= '&';
				
			//best case
			if( isset($_GET['page']) || isset($_GET['paged']) ){
				$paged = isset($_GET['paged']) ? $_GET['paged'] : $_GET['page'];
			}else{
				if(!is_paged()){
					$paged = 1;
				}else{
					$paged = get_query_var('paged');
				}
			}


			
			$term = get_query_var('term');
			$tax = get_query_var('taxonomy');
			$max_page = min(array($wp_query->max_num_pages,$num_pages_per_phrase));
			$phrase = ceil($paged/$max_page);
			$start_page = $max_page*($phrase-1) + 1;

			?>
			<span class='curent-total'><span><span>Page <?php echo $paged ; ?> of <?php echo $wp_query->max_num_pages ; ?></span></span></span>
			<?php
			if($paged > 1){?>
			<a class="first" href="<?php echo $pageLink;?><?php echo 'paged=1'; //first link ?>"><span><span><?php _e('First','wpdance')?></span></span></a>
			<a class="previous" href="<?php echo $pageLink;?><?php echo 'paged=' . ($paged - 1); //next link ?>"><span><span><?php _e('Previous','wpdance')?></span></span></a>
			<?php }
			if($phrase > 1){?>
					<a class="previous-phrase" href="<?php echo $pageLink;?><?php echo 'paged=' . ($max_page*($phrase-2) + 1); //prev prase link ?>">...</a>
			<?php } ?>
			<?php
			for($i=0;$start_page+$i<=min(array($wp_query->max_num_pages,$start_page+$max_page-1));$i++){?>
					<?php if($paged==$start_page+$i):?>
					<span class="pager current<?php if($i == 0) echo ' first-pager';if($start_page+$i == min(array($wp_query->max_num_pages,$start_page+$max_page-1))) echo ' last-pager';?>"><span><span><?php echo $start_page+$i;?></span></span></span>
					<?php else:?>
					<a class="pager<?php if($i == 0) echo ' first-pager';if($start_page+$i == min(array($wp_query->max_num_pages,$start_page+$max_page-1))) echo ' last-pager';?>" href="<?php echo $pageLink;?><?php echo 'paged=' . ($start_page + $i); ?>"><span><span><?php echo $start_page+$i;?></span></span></a>
					<?php endif; ?>
					<?php
			}
			if($phrase < ceil($wp_query->max_num_pages/$max_page)){?>
					<a class="next-phrase" href="<?php echo $pageLink;?><?php echo 'paged=' . ($max_page*$phrase + 1); //next phrase link ?>">...</a>
			<?php } ?>
			<?php if($paged < $wp_query->max_num_pages){?>
					<a class="next" href="<?php echo $pageLink;?><?php echo 'paged=' . ($paged + 1); //next link ?>"><span><span><?php _e('Next','wpdance')?></span></span></a>
					<a class="last" href="<?php echo $pageLink;?><?php echo 'paged=' . $wp_query->max_num_pages; //next link ?>"><span><span><?php _e('Last','wpdance')?></span></span></a>
			<?php }?>
		
			<?php
			endif;
			
	}
}	
?>