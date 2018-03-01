<?php
/**
 * Footer
 *
 * @package Custom
 */

?>

</main>

<footer class="g-footer">
	<div class="g-l-row">
		<p><?php esc_html_e( 'Copyright &copy;', 'custom' ); ?> <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All Rights Reserved.', 'custom' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
