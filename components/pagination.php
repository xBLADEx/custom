<?php
/**
 * Pagination
 *
 * @package Custom
 */

$previous = get_adjacent_post( false, '', true );
$next     = get_adjacent_post( false, '', false );

if ( empty( $next ) && empty( $previous ) ) {
	return;
}
?>

<nav class="pagination">
	<ul class="pagination__list">
		<?php if ( $previous ) : ?>
			<li class="pagination__list-item pagination__previous">
				<a href="<?php echo esc_url( get_permalink( $previous->ID ) ); ?>" rel="<?php esc_attr_e( 'prev', 'custom' ); ?>">
					<?php echo esc_html( $previous->post_title ); ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( $next ) : ?>
			<li class="pagination__list-item pagination__next">
				<a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" rel="<?php esc_attr_e( 'next', 'custom' ); ?>">
					<?php echo esc_html( $next->post_title ); ?>
				</a>
			</li>
		<?php endif; ?>
	</ul>
</nav>
