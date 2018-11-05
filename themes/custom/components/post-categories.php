<?php
/**
 * Post Categories
 *
 * @package Custom
 */

?>

<p class="categories"><?php esc_html_e( 'Categories:', 'custom' ); ?> <?php the_category( ', ' ); ?></p>
