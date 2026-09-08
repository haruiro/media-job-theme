<?php
/**
 * 応募確認ページ
 * Template Name: 問い合わせ確認
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
			<span><?php echo get_post_field( 'post_name' ) === 'contact-confirm' ? 'お問い合わせ' : '応募フォーム'; ?></span>
		</div>
	</div>

	<div class="contact page-body" id="confirm-page">
		<div class="contact__inner">
			<h1 class="contact__title"><?php the_title(); ?></h1>
			<p class="contact__lead">入力内容をご確認ください。<br>修正する場合には下の「入力内容を修正する」ボタンより<br class="sp-only">入力フォームへお戻りください。</p>

			<?php the_content(); ?>
		</div>
	</div>

</main>

<?php get_footer(); ?>
