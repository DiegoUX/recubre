<?php 
// Create widget tabs post
if(!class_exists('WP_Widget_Hot_Product')){
	class WP_Widget_Hot_Product extends WP_Widget {
		function WP_Widget_Hot_Product() {
			$widget_ops = array( 'classname' => 'widget_hot_product', 'description' => __( "Show Hot Products",'wpdance' ) );
			$this->WP_Widget('hot_product', __('WD - Hot Products','wpdance'), $widget_ops);
		}

		function widget( $args, $instance ) {
			extract( $args );
			$title = apply_filters('widget_title', empty($instance['title_popular']) ? __('Hot Products','wpdance') : $instance['title_popular']);
			$num_popular = empty( $instance['num_popular'] ) ? 5 : absint($instance['num_popular']);
			
			$post_type = "product";
			
			$thumbnail_width = 60;
			$thumbnail_height = 60;

			$output = $before_widget;
			if ( $title )
				$output .= $before_title . $title . $after_title;
			
			echo $output;
			wp_reset_query();
			global $post;
			$popular=new wp_query(array('post_type' => 'product','posts_per_page' => $num_popular,'post_status'=>'publish','ignore_sticky_posts'=> 1, 'order' => 'DESC'));
	?>
			<?php if($popular->post_count>0){$i = 0;
			?>
			<ul class="popular-post-list">
				<?php while ($popular->have_posts()) : $popular->the_post();?>
				<li <?php if($i==0) echo "class='first'";if(++$i == count($popular)) echo "class='last'";?>>

					<div class="image image-style">
						<a class="thumbnail" href="<?php echo get_permalink($post->ID); ?>">
							<?php  
								if ( has_post_thumbnail() ) {
									the_post_thumbnail('prod_tini_thumb',array('title' => esc_attr(get_the_title()),'alt' => esc_attr(get_the_title()) ));
								} 
							?>
						</a>		
						<span class="shadow"></span>
					</div><!-- .image -->

					<div class="detail">
						<p class="title"><a  href="<?php echo get_permalink($post->ID); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></p>
						<!--
						<span class="author-time">
							<span class="author"><i class="icon-user custom-icon"></i><?php //the_author(); ?></span>
							<span class="time"><i class="icon-calendar custom-icon"></i><?php //the_time(get_option( 'date_format' )); ?></span>
							<span class="comment-number"><i class="icon-comments-alt custom-icon"></i><?php //comments_number( '0 Comments','1 Comment','% Comments'); ?></span>
						</span>-->
						<?php woocommerce_template_loop_price(); ?>
					</div>
				</li>
				<?php endwhile;?>
			</ul>
			<?php }?>
			<?php wp_reset_query(); ?>
			
	<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title_popular'] = strip_tags($new_instance['title_popular']);
				$instance['num_popular'] = absint($new_instance['num_popular']);
				return $instance;
		}

		function form( $instance ) {
				//Defaults
				$instance = wp_parse_args( (array) $instance, array( 'title_popular' => 'Popular' , 'num_popular' => 5 ) );
				$title_popular = esc_attr( $instance['title_popular'] );
				$num_popular = absint( $instance['num_popular'] );

	?>
				<p><label for="<?php echo $this->get_field_id('title_popular'); ?>"><?php _e( 'Title for popular tab:','wpdance' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title_popular'); ?>" name="<?php echo $this->get_field_name('title_popular'); ?>" type="text" value="<?php echo $title_popular; ?>" /></p>

				<p><label for="<?php echo $this->get_field_id('num_popular'); ?>"><?php _e( 'The number of popular post','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id('num_popular'); ?>" name="<?php echo $this->get_field_name('num_popular'); ?>" type="text" value="<?php echo $num_popular; ?>" /></p>
				

	<?php
		}
	}
}
?>