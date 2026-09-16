<?php
/**
 * The main template file
 *
 * @package media-job-theme
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="page-body">
		<div class="page-content">
			<p><?php esc_html_e( 'ページが見つかりませんでした。', 'media-job-theme' ); ?></p>
		</div>
	</div>
</main>

<?php get_footer(); ?>
