<?php
/**
 * The template for displaying the footer
 *
 * @package homecareer-theme
 */
?>

	<footer id="colophon" class="site-footer">
		<div class="site-footer__inner">
			<nav class="site-footer__nav">
				<?php
				$footer_menu = wp_get_nav_menu_items( get_nav_menu_locations()['footer'] ?? 0 );
				if ( $footer_menu ) :
					foreach ( $footer_menu as $item ) :
						echo '<a href="' . esc_url( $item->url ) . '" class="site-footer__link">' . esc_html( $item->title ) . '</a>';
					endforeach;
				endif;
				?>
			</nav>
			<p class="site-footer__copy">
				<small>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> Inc. All Rights Reserved.</small>
			</p>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
