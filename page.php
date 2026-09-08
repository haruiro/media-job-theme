<?php
/**
 * 固定ページ
 *
 * @package homecareer-theme
 */

get_header();
?>

<main id="primary" class="site-main">

	<div class="breadcrumb">
		<div class="breadcrumb__inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a>
			<span class="breadcrumb__sep">›</span>
			<span><?php the_title(); ?></span>
		</div>
	</div>

	<div class="page-body">
		<div class="page-content">
			<?php while ( have_posts() ) : the_post(); ?>
				<h1 class="page-content__title"><?php the_title(); ?></h1>
				<div class="page-content__body">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>

</main>

<?php get_footer(); ?>
