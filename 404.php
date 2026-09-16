<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package media-job-theme
 */

get_header();
?>

<main id="primary" class="site-main">
	<section class="page-body error-404">
		<div class="page-content">
			<h1 class="page-content__title">ページが見つかりません</h1>
			<div class="page-content__body">
				<p>お探しのページは移動または削除された可能性があります。</p>
				<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップページへ戻る</a></p>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
