<?php
/**
 * Content Title
 *
 * @package Custom
 */

?>
<div class="g-l-row">
	<h1 class="page-title">
		<?php
		if ( is_archive() ) {
			post_type_archive_title();
		} else {
			the_title();
		}
		?>
	</h1>
</div>
