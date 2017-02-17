<?php
/**
 * Comments
 * Comments template in functions/post.php foundation_comment().
 *
 * @package Custom
 */

// Exit if post is password protected.
if ( post_password_required() ) {
	return;
}

if ( have_comments() ) :
	?>
	<h4 class="comment-title">
		<?php printf( _n( '1 reply to &ldquo;%2$s&rdquo;', '%1$s replies to &ldquo;%2$s&rdquo;', get_comments_number(), 'custom' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
	</h4>

	<ol class="comment-list">
		<?php
		// @see http://codex.wordpress.org/Function_Reference/wp_list_comments.
		wp_list_comments(
			array(
				'style'    => 'ol',
			)
		);
		?>
	</ol>

	<?php
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav>
			<h4><?php esc_html_e( 'Comment navigation', 'custom' ); ?></h4>

			<div>
				<?php previous_comments_link( '&larr; Older Comments' ); ?>
			</div>

			<div>
				<?php next_comments_link( 'Newer Comments &rarr;' ); ?>
			</div>
		</nav>
		<?php
	endif;

	if ( ! comments_open() && get_comments_number() ) :
		?>
		<p><?php esc_html_e( 'Comments are closed.', 'custom' ); ?></p>
		<?php
	endif;
endif;

if ( comments_open() ) :
	?>
	<div class="panel comment-form">
		<?php comment_form(); // @see http://codex.wordpress.org/Function_Reference/comment_form. ?>
	</div>
	<?php
endif;
