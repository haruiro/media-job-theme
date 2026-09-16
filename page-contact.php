<?php
/**
 * 応募フォームページ
 * Template Name: 問い合わせフォーム
 *
 * @package media-job-theme
 */

get_header();
?>

<main id="primary" class="site-main">

	<div class="breadcrumb">
		<div class="breadcrumb__inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a>
			<span class="breadcrumb__sep">›</span>
			<span><?php echo get_post_field( 'post_name' ) === 'contact' ? 'お問い合わせ' : '応募フォーム'; ?></span>
		</div>
	</div>

	<div class="contact page-body">
		<div class="contact__inner">
			<h1 class="contact__title"><?php the_title(); ?></h1>
			<p class="contact__lead js-contact-lead">以下の項目を記入のうえ、<br class="sp-only">確認ボタンを押して下さい。</p>

			<?php the_content(); ?>
		</div>
	</div>

</main>

<?php get_footer(); ?>
