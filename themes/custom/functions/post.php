<?php
/* 
====================
	FUNCTIONS - POST
====================
*/

/* 
====================
	POST EXCERPT
====================
*/
if ( ! function_exists( 'custom_excerpt' ) ) {
	function custom_excerpt( $text ) {
        global $post;
        if ( '' == $text ) {
            $text = get_the_content( '' );
            $text = apply_filters( 'the_content', $text );
            $text = str_replace( '\]\]\>', ']]&gt;', $text );
            $text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text );
            $text = strip_tags( $text, '<p>' );
            $excerpt_length = 80;
            $words = explode( ' ', $text, $excerpt_length + 1 );
            if ( count( $words ) > $excerpt_length ) {
                array_pop( $words );
                array_push( $words, '... <br><br><a href="' . get_permalink( $post->ID ) . '" class="button">Read More</a>' );
                $text = implode( ' ', $words );
            }
        }
        return $text;
	}
	remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
	add_filter( 'get_the_excerpt', 'custom_excerpt' );
}
/* 
====================
	COMMENTS TEMPLATE
====================
*/
if ( ! function_exists( 'foundation_comment' ) ) {
	function foundation_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( '(Edit)', '<span>', '</span>' ); ?></p>
		<?php
			break;
			default :
			global $post;
		?>
		<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<header>
					<?php
						echo "<span class='comment-gravatar'>";
						echo get_avatar( $comment, 44 );
						echo "</span>";
						printf( '%2$s %1$s',
							get_comment_author_link(),
							( $comment->user_id === $post->post_author ) ? '<span>Posted by: </span>' : ''
						);
						printf( '<br><a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							sprintf( __( '%1$s at %2$s', 'foundation' ), get_comment_date(), get_comment_time() )
						);
					?>
				</header>
				<?php if ( '0' == $comment->comment_approved ) { ?>
					<p>Your comment is awaiting moderation.</p>
				<?php } ?>
				<div>
					<?php comment_text(); ?>
				</div>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Reply', 'after' => ' &darr; <br><br>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
			</article>
		<?php
			break;
		}
	}
}
/* 
====================
	REMOVE CLASS STICKY POST
====================
*/
if ( ! function_exists( 'custom_remove_sticky' ) ) {
	function custom_remove_sticky( $classes ) {
		$classes = array_diff( $classes, array( 'sticky' ) );
		return $classes;
	}
	add_filter( 'post_class', 'custom_remove_sticky' );
}
/* 
====================
	PAGINATION
====================
*/
if ( ! function_exists( 'blade_pagination' ) ) {
	function blade_pagination() {
		global $custom_query;
		$big = 999999999;
		$pagArg = array( // http://codex.wordpress.org/Function_Reference/paginate_links
			'base'         			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'       			=> '?page=%#%',
			'total'        			=> $custom_query->max_num_pages,
			'current'      			=> max( 1, get_query_var('paged') ),
			'show_all'     			=> False,
			'end_size'     			=> 1,
			'mid_size'     			=> 2,
			'prev_next'    			=> True,
			'prev_text'    			=> '&laquo; Previous',
			'next_text'    			=> 'Next &raquo;',
			'type'         			=> 'list',
			'add_args'     			=> False,
			'add_fragment' 			=> '',
			'before_page_number' 	=> '',
			'after_page_number' 	=> ''
		);
		echo paginate_links( $pagArg ); 
	}
}