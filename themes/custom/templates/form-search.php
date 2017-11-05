<?php
/**
 * Form Search
 *
 * @package Custom
 */

?>

<form action="/" class="form-search" method="GET">
	<input type="text" class="form-search__input" name="s" placeholder="<?php esc_attr_e( 'Search', 'custom' ); ?>">
	<input type="submit" class="form-search__button" name="submit" value="<?php esc_attr_e( 'Find', 'custom' ); ?>">
</form>
