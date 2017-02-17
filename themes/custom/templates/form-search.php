<?php
/**
 * Form Search
 *
 * @package Custom
 */

?>

<div class="clearfix">
	<form action="/" class="form-search" method="GET">
		<input type="submit" class="form-search-button" name="submit" value="<?php esc_attr_e( 'Find', 'custom' ); ?>">

		<input type="text" class="form-search-box" name="s" placeholder="<?php esc_attr_e( 'Search', 'custom' ); ?>">
	</form>
</div>
