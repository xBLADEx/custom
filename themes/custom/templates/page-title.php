<?php
/* 
====================
	PAGE TITLE
====================
*/
?>
<div class="row">
	<div class="medium-12 columns">
		<h1 class="page-title">
			<?php 
			if ( is_archive() ) {
				post_type_archive_title();
			} else {
				the_title();
			} ?>
		</h1>
	</div>
</div>