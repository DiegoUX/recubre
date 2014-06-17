<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Roedok
 * @since WD_Responsive
 */

get_header(); ?>
		<div class="top-page">
			<?php dimox_breadcrumbs();?>
		</div>
		<div id="container">
			<div id="content" class="container single-blog">
				<div id="main" class="span18">
					<div class="main-content alpha omega">
						<h1 class="heading-title page-title blog-title">blog</h1>			
						<div class="single-content">
							<?php	
								if(have_posts()) : while(have_posts()) : the_post(); global $post,$single_post_config;
								$single_post_config = unserialize( get_option(THEME_SLUG.'single_post_config','') );
								$single_post_config = wd_array_atts(
									array(
											'show_category' => 1
											,'show_author_post_link' => 1
											,'show_time' => 1
											,'show_tags' => 1
											,'show_thumb' => 1
											,'show_view_count' => 1
											,'show_comment_count' => 1
											,'show_social' => 1
											,'show_author' => 1
											,'show_related' => 1
											,'related_label' => "Related Posts"
											,'show_comment_list' => 1				
											,'comment_list_label' => "Responds"				
											,'num_post_related' => 4
											,'show_category_phone' => 1
											,'show_author_post_link_phone' => 1
											,'show_time_phone' => 1
											,'show_thumb_phone' => 1
											,'show_tags_phone' => 1
											,'show_view_count_phone' => 1
											,'show_comment_count_phone' => 1
											,'show_social_phone' => 1
											,'show_author_phone' => 1
											,'show_related_phone' => 1
											,'show_comment_list_phone' => 1													
										)
									,$single_post_config);										
								?>
									<div <?php post_class("single-post");?>>
										<?php echo stripslashes(htmlspecialchars_decode(get_option(THEME_SLUG.'code_to_top_post')));?>
													
										<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="wd-edit-link hidden-phone">', '</span>' ); ?>	
										
										
										
										<div class="post-title">
											<h1 class="heading-title"><?php the_title(); ?></h1>
										</div>
										
										<div class="post-info-thumbnail">
											<?php if( $single_post_config['show_thumb'] == 1 ) : ?>
												<div class="thumbnail<?php if( $single_post_config['show_thumb_phone'] != 1 ) echo " hidden-phone";?>">
													<?php 
														$video_url = get_post_meta( $post->ID, THEME_SLUG.'url_video', true);
														if( $video_url!= ''){
															echo get_embbed_video( $video_url, 280, 246 );
														}
														else{
															?>
															<div class="image">
																<a class="thumb-image" href="<?php the_permalink() ; ?>">
																<?php 
																	if ( has_post_thumbnail() ) {
																		the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-blog'));
																		//the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-effect-2'));
																	} 			
																?>	
																	<div class="thumbnail-shadow"></div>	
																</a>
																
															</div>
															<?php
														}
													?>	
												</div>
											<?php endif;?>
											<div class="post-info-meta">
												<?php if( absint($single_post_config['show_author_post_link']) == 1 ) : ?>	
													<div class="author <?php if( $single_post_config['show_author_post_link_phone'] != 1 ) echo " hidden-phone";?>">	
														<?php the_author_posts_link(); ?> 
													</div>
												<?php endif; ?>
												<?php if( absint($single_post_config['show_time']) == 1 ) : ?>			
													<div class="time <?php if( $single_post_config['show_time_phone'] != 1 ) echo " hidden-phone";?>">
														<span class="entry-date"><?php echo get_the_date('d M, Y') ?></span>
													</div>
												<?php endif; ?>
												<?php if( absint($single_post_config['show_view_count']) == 1 ) : ?>
													<span class="views-count<?php if( absint($single_post_config['show_view_count_phone']) != 1 ) echo " hidden-phone";?>">
														<?php ppbv_display_product(true); ?>
													</span>
												<?php endif;?>
												<?php if( absint($single_post_config['show_comment_count']) == 1 ) : ?>
													<span class="comments-count <?php if( $single_post_config['show_comment_count_phone'] != 1 ) echo " hidden-phone";?>">
														<?php $comments_count = wp_count_comments($post->ID); if($comments_count->approved < 10 && $comments_count->approved > 0) echo '0'; echo $comments_count->approved;?>
													</span>
												<?php endif; ?>
											</div>	
										</div>
										<div class="post-info-content">
											<!--Category List-->
										<?php if( $single_post_config['show_category'] == 1 ) : ?>
											<?php if ( is_object_in_taxonomy( get_post_type(), 'category' ) ) : // Hide category text when not supported ?>
											<?php
												/* translators: used between list items, there is a space after the comma */
												$categories_list = get_the_category_list( __( ', ', 'wpdance' ) );
													if ( $categories_list ):
												?>
												<span class="cat-links<?php if( $single_post_config['show_category_phone'] != 1 ) echo " hidden-phone";?>">
													<?php printf( __( '<span class="%1$s heading-title"></span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );?>
												</span>
												<?php endif; // End if categories ?>
											<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'category' ) ?>	
											
										<?php endif;?>	
										
											<div class="short-content"><?php the_content(); ?></div>
											
												<?php wp_link_pages(); ?>
											
													


																					
										</div>
										
										
									
										<?php echo stripslashes(htmlspecialchars_decode(get_option(THEME_SLUG.'code_to_bottom_post')));?>	
									</div>
									<div class="tags_social">
										<?php if( absint($single_post_config['show_tags']) == 1 ) : ?>
											<?php if ( is_object_in_taxonomy( get_post_type(), 'post_tag' ) ) : // Hide tag text when not supported ?>
											<?php
												/* translators: used between list items, there is a space after the comma */
												$tags_list = get_the_tag_list( '', __( '', 'wpdance' ) );
												if ( $tags_list ):
												?>
													<div class="tags<?php if( $single_post_config['show_tags_phone'] != 1 ) echo " hidden-phone";?>">
														<span class="tag-title"><?php _e('Tags','wpdance');?></span>
														<span class="tag-links">
															<?php printf( __( '<span class="%1$s"></span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
															$show_sep = true; ?>
														</span>
													</div>
												<?php endif; // End if $tags_list ?>
											<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'post_tag' ) ?>
										<?php endif; ?>	
										<?php if( absint($single_post_config['show_social']) == 1 ) : ?>
											<div class="share-list<?php if( $single_post_config['show_social_phone'] != 1 ) echo " hidden-phone";?>">
												<span class="social-label"><?php _e("share this post",'wpdance');?></span>
												<a class="facebook" title="<?php _e('Share This','wpdance');?>" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&title=<?php echo urlencode(get_the_title()) ?>" target="_blank"></a>
												<a class="twitter" title="<?php _e('Twitter This','wpdance');?>" href="http://twitter.com/home?status=Share <?php the_permalink(); ?>" title="Click to send this product to Twitter!" target="_blank"></a>
												<a class="pin" title="<?php _e('Pin This','wpdance');?>" target="_blank" data-pin-config="above" href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" data-pin-do="buttonPin" ></a>	
												<a class="plus" title="<?php _e('Plus This','wpdance');?>" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()) ?>"></a>
											</div>
										<?php endif;?>
									</div>
									<?php if( absint($single_post_config['show_author']) == 1 ) : ?>
										<div id="entry-author-info" class="<?php if( $single_post_config['show_author_phone'] != 1 ) echo "hidden-phone";?>">
											<div class="author-inner">
												
												<div id="author-description">
													<div id="author-avatar" class="image-style">
														<div class="thumbnail">
															<?php echo get_avatar( get_the_author_meta( 'user_email' ), 96,get_bloginfo('template_url') . '/images/mycustomgravatar.png' ); ?>
														</div>
													</div><!-- #author-avatar -->		
													<div class="author-desc">		
														<span class="author-name"><?php the_author_posts_link();?></span>
														<?php the_author_meta( 'description' ); ?>
														<span class="view-all-author-posts">
															<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
																<?php _e("View all posts by",'wpdance');echo " ";the_author_meta( 'display_name' ); ?>
															</a>
														</span>
													</div>
												</div><!-- #author-description -->
											</div><!-- #author-inner -->
										</div><!-- #entry-author-info -->
									<?php endif; ?>	
									
									<?php if( absint($single_post_config['show_related']) == 1 ) : ?>
										<?php 
											get_template_part( 'templates/related_posts' );
										?>
									<?php endif;?>
									
									<?php comments_template( '', true );?>
									
								<?php						
								endwhile;
								endif;	
								wp_reset_query();
							?>	
						</div>
					</div>
				</div>
							
				<div id="right-sidebar" class="span6">
					<div class="right-sidebar-content alpha omega">
					<?php
						if ( is_active_sidebar( 'blog-widget-area' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'blog-widget-area' ); ?>
							</ul>
					<?php endif; ?>
					</div>
				</div><!-- end right sidebar -->	
				
			</div><!-- #content -->
			
		</div><!-- #container -->
<?php get_footer(); ?>