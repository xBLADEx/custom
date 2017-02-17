<?php
/**
 * Footer
 *
 * @package Custom
 */

?>

</main>

<footer class="footer">
	<div class="row">
		<div class="medium-12 columns">
			<p><?php esc_html_e( 'Copyright &copy;', 'custom' ); ?> <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All Rights Reserved.', 'custom' ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
