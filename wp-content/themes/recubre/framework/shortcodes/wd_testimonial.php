<?php
add_image_size('testimonial',115,115);
	if(!function_exists('testimonial')){
		function testimonial($atts,$content){
			extract(shortcode_atts(array(
				'slug'				=>		''
				,'id'				=>		0
			),$atts));
			
			?>
			<?php
			global $post;
			$count = 0;
			if( absint($id) > 0 ){
				$_feature = woothemes_get_testimonials( array('id' => $id,'limit' => 1 ));
			}elseif( strlen(trim($slug)) > 0 ){
				$_feature = get_page_by_path($slug, OBJECT, 'testimonial');
				if( !is_null($_feature) ){
					$_feature = woothemes_get_testimonials( array('id' => $_feature->ID,'limit' => 1 ));
				}else{
					return;
				}
			}else{
				return;
				//invalid input params.
			}
			
			if( !is_array($_feature) && count($_feature) <= 0 ){
				return;
			}else{
				global $post;
				$_feature = $_feature[0];
				$post = $_feature;
				setup_postdata( $post ); 
			}
			
			ob_start();
					?><div class="estimonial-item testimonial">
							<div class="avartar">
								<a href="#"><?php the_post_thumbnail('woo_shortcode');?></a>
							</div>							
							<div class="detail">
								<h3><?php the_title();?><span class="job"> / <?php echo get_post_meta($post->ID,'_byline',true);?></span></h3>
								<div class="testimonial-content"><?php the_content();?></div>
								<div class="twitter_follow"><a class="first" href="<?php echo get_post_meta($post->ID,'_url',true);?>">Follow</a> <a class="second" href="<?php echo get_post_meta($post->ID,'_url',true);?>">@<?php echo get_post_meta($post->ID,THEME_SLUG.'username_twitter_testimonial',true);?></a></div>
							</div>						
						</div>
			<?php
			$output = ob_get_contents();
			ob_end_clean();
			rewind_posts();
			wp_reset_query();
			return $output;
		}
	}
	add_shortcode('testimonial','testimonial');
?>