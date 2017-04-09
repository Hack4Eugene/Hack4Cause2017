<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package uncode
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h5 class="comments-title">
			<?php
				printf( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments', 'uncode' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h5>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'uncode' ); ?></h1>
			<ul class="navigation">
				<li class="page-prev"><span class="btn-container"><?php previous_comments_link( '<i class="fa fa-angle-left"></i><span>' . esc_html__( 'Older Comments', 'uncode' ) . '</span>' ); ?></span></li>
				<li class="page-next"><span class="btn-container"><?php next_comments_link( '<span>' . esc_html__( 'Newer Comments', 'uncode' ) . '</span><i class="fa fa-angle-right"></i>' ); ?></span></li>
			</ul>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<div class="comment-list">
			<?php
				wp_list_comments( array(
					'walker'  => new uncode_walker_comment(),
					'style'      => 'ul',
					'short_ping' => true,
				) );
			?>
		</div><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'uncode' ); ?></h1>
			<ul class="navigation">
				<li class="page-prev"><span class="btn-container"><?php previous_comments_link( '<i class="fa fa-angle-left"></i><span>' . esc_html__( 'Older Comments', 'uncode' ) . '</span>' ); ?></span></li>
				<li class="page-next"><span class="btn-container"><?php next_comments_link( '<span>' . esc_html__( 'Newer Comments', 'uncode' ) . '</span><i class="fa fa-angle-right"></i>' ); ?></span></li>
			</ul>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'uncode' ); ?></p>
	<?php endif; ?>

	<?php
		if ( is_user_logged_in() ) {
			$current_user = wp_get_current_user();
			$gravatar = '<div class="comment-content"><div class="comment-figure"><figure class="gravatar">'.get_avatar( $current_user->ID, 256 ).'</figure><p class="logged-in-as"><a href="'.get_edit_user_link().'">'.$user_identity.'</a></p><a href="'.wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ).'" title="Log out of this account" class="clearfix">'.esc_html__('Log out','uncode').'</a></div><div class="comment-meta post-meta"><p class="comment-form-comment comment-loggedin"><textarea id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true"></textarea></p></div></div>';
		} else $gravatar = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'uncode' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true"></textarea></p>';
	?>
	<div<?php if ( is_user_logged_in() ) echo ' class="form-indent"'; ?>>
	<?php
		comment_form(
			array(
				'title_reply'					=>	esc_html__('Add comment','uncode'),
				'comment_notes_after' 	=> '',
				'comment_notes_before' 	=> '',
				'logged_in_as'				=> '',
				'class_submit' 				=> 'btn',
				'comment_field'       => $gravatar
			)
		);
	?>
	</div>
</div><!-- #comments -->
