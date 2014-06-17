<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! comments_open() )
	return;
?>
<div id="reviews"><?php

	echo '<div id="comments">'; ?>

	<h2><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_rating_count() ) )
				printf( _n('%s review for %s', '%s reviews for %s', $count, 'wpdance'), $count, get_the_title() );
			else
				_e( 'Reviews', 'wpdance' );
		?></h2>
	<?php
	$title_reply = '';

	if ( have_comments() ) :

		echo '<ol class="commentlist">';

		wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); 

		echo '</ol>';

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'wpdance' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'wpdance' ) ); ?></div>
			</div>
		<?php endif;

		echo '<p class="add_review"><a href="#review_form" class="inline show_review_form button" title="' . __( 'Add Your Review', 'wpdance' ) . '">' . __( 'Add Review', 'wpdance' ) . '</a></p>';

		$title_reply = __( 'Add a review', 'wpdance' );

	else :

		$title_reply = __( 'Be the first to review', 'wpdance' ).' &ldquo;'.$post->post_title.'&rdquo;';

		echo '<p class="noreviews">'.__( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'wpdance' ).'</p>';

	endif;

	$commenter = wp_get_current_commenter();

	echo '</div>';
	if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : 
		echo '<div id="review_form_wrapper"><div id="review_form">';
		
		$commenter = wp_get_current_commenter();
		
		$comment_form = array(
			'title_reply' => $title_reply,
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'wpdance' ) . '</label> ' . '<span class="required">*</span>' .
							'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
				'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'wpdance' ) . '</label> ' . '<span class="required">*</span>' .
							'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
			),
			'label_submit' => __( 'Submit Review', 'wpdance' ),
			'logged_in_as' => '',
			'comment_field' => ''
		);

		if ( get_option('woocommerce_enable_review_rating') === 'yes' ) {

			$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', 'wpdance' ) .'</label><select name="rating" id="rating">
				<option value="">'.__( 'Rate&hellip;', 'wpdance' ).'</option>
				<option value="5">'.__( 'Perfect', 'wpdance' ).'</option>
				<option value="4">'.__( 'Good', 'wpdance' ).'</option>
				<option value="3">'.__( 'Average', 'wpdance' ).'</option>
				<option value="2">'.__( 'Not that bad', 'wpdance' ).'</option>
				<option value="1">'.__( 'Very Poor', 'wpdance' ).'</option>
			</select></p>';

		}

		$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'wpdance' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);

		comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

		echo '</div></div>';
	else :?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'wpdance' ); ?></p>	
	<?php endif;
?><div class="clear"></div></div>