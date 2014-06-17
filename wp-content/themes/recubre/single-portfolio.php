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
 * @subpackage Tatttoo
 * @since WD_Responsive
 */

get_header(); ?>
	<div class="top-page">
		<?php dimox_breadcrumbs();?>
	</div>
	<div id="container" class="single-template single-portfolio layout-full">
		<div id="content" class="container">
			<div id="container-main" class="span18">
				<div class="main-content alpha omega">
					<h1 class="heading-title page-title blog-title">Portfolio</h1>	
					<div class="single-content">
						<?php	
							if(have_posts()) : while(have_posts()) : the_post(); global $post;
								$thumb = esc_html(get_post_thumbnail_id($post->ID));
								$post_title = esc_html(get_the_title($post->ID));
								$post_url =  esc_url(get_permalink($post->ID));
								$url_video = esc_url(get_post_meta($post->ID,THEME_SLUG.'video_portfolio',true));
								$proj_link = esc_url(get_post_meta($post->ID,THEME_SLUG.'proj_link',true));
								if(	strlen(trim($proj_link)) < 0 ){
									$proj_link = $post_url;
								}

								if( strlen( trim($url_video) ) > 0 ){
									$rand_id = rand().time();
									$slider_start_li = array(	'id' => $rand_id,
																'alt' => $post_title,
																'title' => $post_title
															);
									if(strstr($url_video,'youtube.com') || strstr($url_video,'youtu.be')){
										$thumb_url = array(get_thumbnail_video_src($url_video , 850 ,340));
										$item_class = "thumb-video youtube-fancy";
									}
									if(strstr($url_video,'vimeo.com')){
										$thumb_url = array(wp_parse_thumbnail_vimeo(wp_parse_vimeo_link($url_video), 850, 340));	
										$item_class = "thumb-video vimeo-fancy";
									}
									if( $thumb ){
										$thumb_url = wp_get_attachment_image_src($thumb,'full');
									}
									$light_box_url = $url_video;
								}else{
									$thumb_url = wp_get_attachment_image_src($thumb,'full');
									$item_class = "thumb-image";
									$light_box_url = esc_url($thumb_url[0]);
								}								
								
								$portfolio_slider = get_post_meta($post->ID,THEME_SLUG.'_portfolio_slider',true);
								$portfolio_slider = unserialize($portfolio_slider);
								$slider_thumb = false;
								if( is_array($portfolio_slider) && count($portfolio_slider) > 0 ){
									$slider_thumb = true;
								}
							?>	
								<div <?php post_class('single-post');?>>
									<?php echo stripslashes(htmlspecialchars_decode(get_option(THEME_SLUG.'code_to_top_post')));?>
									<div class="navi span24 hidden-desktop">
										<div class="alpha omega">
											<div class="navi-next"><?php next_post_link('%link', 'Next'); ?></div>
											<div class="navi-prev"><?php previous_post_link('%link', 'Previous'); ?> </div>
										</div>
									</div>
									
									<div class="post-title">
										<h1 class="heading-title"><?php the_title(); ?></h1>
									</div>
									
									<div class="post-info-thumbnail">
										<?php if( $slider_thumb == true) : ?>
											<div class="portfolio-single-slider">
												<ul class="slides">
													<?php foreach( $portfolio_slider as $slide ){ ?>
														<?php $_thumb_uri = wp_get_attachment_image_src( $slide['thumb_id'], 'blog_thumb', false );
															$_thumb_uri = $_thumb_uri[0];
															$_sub_thumb_uri = wp_get_attachment_image_src( $slide['thumb_id'], 'blog_thumb', false );
															$_sub_thumb_uri = $_sub_thumb_uri[0]; 
														?>
														<li data-thumb="<?php  echo $_sub_thumb_uri;?>"><a href="<?php echo $slide['url'];?>"><img alt="<?php echo $slide['alt'];?>" class="opacity_0" src="<?php echo  $_thumb_uri;?>"/></a></li>
													<?php } ?>
												</ul>	
											</div>	
										<?php else:?>	
											<div class="thumbnail">
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
											</div>
										<?php endif ; ?>
										
										<div class="post-info-meta">
												<div class="author">	
													<?php the_author_posts_link(); ?> 
												</div>
												<div class="time">
													<span class="entry-date"><?php echo get_the_date('d M, Y') ?></span>
												</div>
												<span class="views-count">
													<?php ppbv_display_product(true); ?>
												</span>
												<span class="comments-count">
													<?php $comments_count = wp_count_comments($post->ID); if($comments_count->approved < 10 && $comments_count->approved > 0) echo '0'; echo $comments_count->approved;?>
												</span>
											
										</div>
									</div>
									<div class="post-info-content">
										<!--Category List-->
										<?php
											/* translators: used between list items, there is a space after the comma */
											$cat_post =  wp_get_post_terms(get_the_ID(),'gallery'); 
											$categories = '';
											foreach($cat_post as $cat){
												$temp  = '<a href="'.get_term_link($cat->slug,$cat->taxonomy).'">'.$cat->name.'</a>'. ', ';
												$categories .= $temp ;
											}      
											$categories = substr($categories,0,-2) .' categories'  ;
															  
										
											?>
											<span class="cat-links">
												<?php printf( __( '%2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories );?>
											</span>
										<div class="short-content"><?php the_content(); ?></div>
										
											<?php wp_link_pages(); ?>									
									</div>
								</div>	
									<?php
										/* translators: used between list items, there is a space after the comma */
										$tags_list = get_the_tag_list( '', __( '', 'wpdance' ) );
										if ( $tags_list ):
										?>
										<div class="tags_social">
											<div class="tags">
												<span class="tag-title"><?php _e('Tags','wpdance');?></span>
												<span class="tag-links">
													<?php printf( __( '<span class="%1$s"></span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
													$show_sep = true; ?>
												</span>
											</div>
										</div>
									<?php endif; // End if $tags_list ?>	
									
									
									
									
									<div class="related-project related container">
										<span class="title"><?php _e("Related Posts",'wpdance'); ?></span>
										<div class="portfolio-project-slider">
											<ul class="slides">
											<?php
												$gallery_ids = array();
												$galleries = wp_get_post_terms($post->ID,'gallery');
												foreach($galleries as $gallery){
													if( $gallery->count > 0 ){
														array_push( $gallery_ids,$gallery->term_id );
													}	
												}
												if(!empty($galleries) && count($gallery_ids) > 0 )
													$args = array(
														'post_type'=>$post->post_type,
															'tax_query' => array(
															array(
																'taxonomy' => 'gallery',
																'field' => 'id',
																'terms' => $gallery_ids
															)
														),
														'post__not_in'=>array($post->ID),
														'posts_per_page'=> get_option('posts_per_page'),//get_option(THEME_SLUG.'num_post_related', 10)
													);
												else
													$args = array(
													'post_type'=>$post->post_type,
													'post__not_in'=>array($post->ID),
													'posts_per_page'=> get_option('posts_per_page'),//get_option(THEME_SLUG.'num_post_related', 10)
												);
												wp_reset_query();
												$related=new wp_query($args);$cout=0;
												if($related->have_posts()) : while($related->have_posts()) : $related->the_post();global $post;$cout++;
													$thumb = (int)get_post_thumbnail_id($post->ID);
													$thumb_url = wp_get_attachment_image_src($thumb,'related_portfolio');
													if(!$thumb_url[0]){ //truong hop slider
														$portfolio_slider = get_post_meta($post->ID,THEME_SLUG.'_portfolio_slider',true);
														$portfolio_slider = unserialize($portfolio_slider);
														if($portfolio_slider)
															$thumb_url = wp_get_attachment_image_src( $portfolio_slider[0]['thumb_id'], 'related_portfolio', false );
													}
													//$url_video = get_post_meta($post->ID,THEME_SLUG.'video_portfolio',true);
													/*if( $thumb <= 0 && strlen( trim($url_video) > 0 ) ){
														if(strstr($url_video,'youtube.com') || strstr($url_video,'youtu.be')){
															$thumb_url = array(get_thumbnail_video_src($url_video , 500 ,320));
														}
														if(strstr($url_video,'vimeo.com')){
															$thumb_url = array(wp_parse_thumbnail_vimeo(wp_parse_vimeo_link($url_video), 500, 320));	
														}
													}*/
													?>
														<li class="span6 related-item <?php if($cout==1) echo " first";if($cout==$related->post_count) echo " last";?>">
															<div>
																<a class="thumbnail" href="<?php the_permalink(); ?>">
																	<?php 
																		if ( has_post_thumbnail() ) {
																			the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-blog'));
																			//the_post_thumbnail( 'related_thumb',array('title' => get_the_title(),'alt' => get_the_title(),'class' => 'thumbnail-effect-1') );
																			//the_post_thumbnail( 'related_thumb',array('title' => get_the_title(),'alt' => get_the_title(),'class' => 'thumbnail-effect-2') );
																		} 							
																	?>
																	<div class="thumbnail-shadow"></div>
																</a>
																<!--<a class="thumbnail" href="<?php the_permalink(); ?>">
																	<?php if($thumb_url[0]){ ?>
																		<img alt="<?php echo $post_title?>" title="<?php echo $post_title;?>" class="opacity_0" src="<?php echo  esc_url($thumb_url[0]);?>"/>
																	<?php } else { ?>	
																		<img alt="<?php the_title(); ?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri(); ?>/images/no-product-830x332.gif"/>
																	<?php } ?>
																	<div class="thumbnail-shadow"></div>
																</a>-->
																<span class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
															</div>
														</li>
													<?php
												endwhile;
												endif;
												wp_reset_query();
											?>
											</ul>
										</div>
									</div>									
									
								
								<?php echo stripslashes(get_option(THEME_SLUG.'code_to_bottom_post'));?>	
							<?php						
							endwhile;
							endif;	
							wp_reset_query();
						?>	
					</div>	
				</div>				
			</div><!-- #content -->
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
		</div>	
									<script type="text/javascript">
										function switch_flex_slider( windowWidth,orgin_slider ){
											if( windowWidth > 981 && jQuery('.portfolio-project-slider ul > li').length >= 4 ) { //4 column
												parrent_div = jQuery('.portfolio-project-slider').parent();
												jQuery('.portfolio-project-slider').hide().remove();
												orgin_slider.clone().appendTo(parrent_div);
												//jQuery('.portfolio-project-slider').html(orgin_slider.html());
												item_width = jQuery('.portfolio-project-slider').width()/4;
												return cur_slider = jQuery('.portfolio-project-slider').flexslider({
													animation: "slide"
													,animationLoop: false
													,itemWidth: item_width
													,itemMargin: 0
													,move: 1
													,start: function(){
														jQuery('a.flex-next').attr( "title","Next" );
														jQuery('a.flex-prev').attr( "title","Previous" );
													},
												});
											}

											if( windowWidth <= 980 && windowWidth > 481  && jQuery('.portfolio-project-slider ul > li').length >= 3 ) { //3 column
												parrent_div = jQuery('.portfolio-project-slider').parent();
												jQuery('.portfolio-project-slider').hide().remove();
												orgin_slider.clone().appendTo(parrent_div);
												item_width = jQuery('.portfolio-project-slider').width()/3;
												return cur_slider = jQuery('.portfolio-project-slider').flexslider({
													animation: "slide"
													,animationLoop: false
													,itemWidth: item_width
													,itemMargin: 0
													,move: 1
													,start: function(){
														jQuery('a.flex-next').attr( "title","Next" );
														jQuery('a.flex-prev').attr( "title","Previous" );
													},
												});
											}
											if( windowWidth <= 480 && windowWidth > 321 && jQuery('.portfolio-project-slider ul > li').length >= 2 ) { //2 column
												parrent_div = jQuery('.portfolio-project-slider').parent();
												jQuery('.portfolio-project-slider').hide().remove();
												orgin_slider.clone().appendTo(parrent_div);
												item_width = jQuery('.portfolio-project-slider').width()/2;
												return cur_slider = jQuery('.portfolio-project-slider').flexslider({
													animation: "slide"
													,animationLoop: false
													,itemWidth: item_width
													,itemMargin: 0
													,move: 1
													,start: function(){
														jQuery('a.flex-next').attr( "title","Next" );
														jQuery('a.flex-prev').attr( "title","Previous" );
													},
												});

											}		
											if( windowWidth <= 320 ) {  //1 column
												parrent_div = jQuery('.portfolio-project-slider').parent();
												jQuery('.portfolio-project-slider').hide().remove();
												orgin_slider.clone().appendTo(parrent_div);
												return cur_slider = jQuery('.portfolio-project-slider').flexslider({
													animation: "slide"
													,animationLoop: false
													,start: function(){
														jQuery('a.flex-next').attr( "title","Next" );
														jQuery('a.flex-prev').attr( "title","Previous" );
													},
												});
											}
										}
										
										jQuery(document).ready(function() {
											cur_slider = null;
											windowWidth = jQuery(window).width();
											if( jQuery('.portfolio-single-slider').length > 0 ){
												jQuery('.portfolio-single-slider').flexslider({
													animation: "slide"
													,animationLoop: false
													,controlNav: false
													,start: function(){
													}
												});	
											}
											orgin_slider = null;
											if( jQuery('.portfolio-project-slider').length > 0 ){
												orgin_slider = jQuery('.portfolio-project-slider').clone();
												cur_slider = switch_flex_slider(windowWidth,orgin_slider);
												
											}
											using_mobile = checkIfTouchDevice();
											if( using_mobile == 0 ){
												jQuery(window).bind('resize',function(event) {
													if( jQuery('.portfolio-project-slider').length > 0 ){
														//delete cur_slider; 
														var resize_width = jQuery(window).width();
														if( jQuery.browser.msie && ( parseInt( jQuery.browser.version, 10 ) <= 8 ) ){
														}else{
															cur_slider = switch_flex_slider(resize_width,orgin_slider);
														}
													}
												});
											}else{
												jQuery(window).bind('orientationchange',function(event) {	
													if( jQuery('.portfolio-project-slider').length > 0 ){
														//delete cur_slider; 
														var resize_width = jQuery(window).width();
														if( jQuery.browser.msie && ( parseInt( jQuery.browser.version, 10 ) <= 8 ) ){

														}else{
															cur_slider = switch_flex_slider(resize_width,orgin_slider);
														}
													}
												});
											}											
											
										});	
									</script>			
		</div><!-- #container -->
<?php get_footer(); ?>