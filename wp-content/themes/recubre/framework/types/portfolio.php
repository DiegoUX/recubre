<?php 
/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Portfolio */
/*-----------------------------------------------------------------------------------*/
function register_portfolio_post_type(){
	register_post_type('portfolio', array(
		'labels' => array(
                'name' => _x('Portfolio Items', 'post type general name','wpdance'),
                'singular_name' => _x('Portfolio Item', 'post type singular name','wpdance'),
                'add_new' => _x('Add New', 'portfolio','wpdance'),
                'add_new_item' => __('Add New Portfolio Item','wpdance'),
                'edit_item' => __('Edit Portfolio Item','wpdance'),
                'new_item' => __('New Portfolio Item','wpdance'),
                'view_item' => __('View Portfolio Item','wpdance'),
                'search_items' => __('Search Portfolio Items','wpdance'),
                'not_found' =>  __('No portfolio item found','wpdance'),
                'not_found_in_trash' => __('No portfolio items found in Trash','wpdance'),
                'parent_item_colon' => '',
                'menu_name' => __('Portfolio Items','wpdance'),
		),
		'singular_label' => __('portfolio','wpdance'),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		//'menu_position' => 20,
		'capability_type' => 'page',
		'hierarchical' => false,
		'supports'  =>  array(
                  'title', 'editor', 'comments', 'author', 'excerpt', 'thumbnail',
                  'custom-fields','category'
                ),
                'taxonomies' => array('post_tag'), // this is IMPORTANT
		'has_archive' => true,
		'rewrite' =>  array('slug'  =>  'portfolio', 'with_front' =>  true),
		'query_var' => true,
		'can_export' => true,
		'show_in_nav_menus' => false,
	));

	global $wp_rewrite;
    //register taxonomy gallery for portfolio
	register_taxonomy('gallery','portfolio',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Gallery', 'taxonomy general name','wpdance'),
			'singular_name' => _x( 'Gallery', 'taxonomy singular name','wpdance'),
			'search_items' =>  __( 'Search Galleries','wpdance'),
			'popular_items' => __( 'Popular Galleries','wpdance'),
			'all_items' => __( 'All Gallery','wpdance'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Gallery','wpdance'),
			'update_item' => __( 'Update Gallery','wpdance'),
			'add_new_item' => __( 'Add New Gallery','wpdance'),
			'new_item_name' => __( 'New Gallery','wpdance'),
			'separate_items_with_commas' => __( 'Separate Gallery with commas','wpdance'),
			'add_or_remove_items' => __( 'Add or remove Gallery','wpdance'),
			'choose_from_most_used' => __( 'Choose from the most used Gallery','wpdance'),
			'menu_name' => __( 'Galleries','wpdance'),
		),
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => false,
		'query_var' => 'gallery',
		'rewrite' =>  did_action( 'init' ) ? array(
					'hierarchical' => true,
					'slug' => 'gallery',
					'with_front' => (! $wp_rewrite->using_index_permalinks() ) ? false : true ) : false
	));	
}

add_action('init','register_portfolio_post_type',0);

// function add_new_columns($defaults) {
    // $defaults['type'] = __('Type');
    // return $defaults;
// }
// function add_column_data( $column_name, $post_id ) {
	// if( $column_name == 'type' ) {
		// $type = get_post_meta($post_id,THEME_SLUG.'type_portfolio',true);
		// if ( $type ) {
			// echo $type;
		// }
		// else {
			// _e('Untype');
		// }
	// }
// }
// add_filter( 'manage_portfolio_posts_columns', 'add_new_columns' );
// add_action( 'manage_posts_custom_column', 'add_column_data', 10, 2 );
?>