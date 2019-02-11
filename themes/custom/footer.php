<?php
/**
 * Footer
 *
 * @package Custom
 */

?>

</main>

<footer class="g-footer">
	<div class="g-row">
		<p class="g-footer__copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All Rights Reserved.', 'custom' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
