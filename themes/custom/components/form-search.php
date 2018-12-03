<?php
/**
 * Form Search
 *
 * @package Custom
 */

?>

<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="form-search">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'custom' ); ?></span>
		<input
			type="search"
			name="s"
			class="form-search__input"
			placeholder="<?php esc_attr_e( 'Search', 'custom' ); ?>"
			value="<?php echo get_search_query(); ?>"
		>
	</label>

	<input type="submit" class="button form-search__submit" value="<?php esc_attr_e( 'Go', 'custom' ); ?>">
</form>
