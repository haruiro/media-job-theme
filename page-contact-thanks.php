<?php
if ( isset( $_COOKIE['cf7msm_posted_data'] ) ) {
	setcookie( 'cf7msm_posted_data', '', time() - 3600, '/' );
	unset( $_COOKIE['cf7msm_posted_data'] );
}

/**
 * 応募サンクスページ
 * Template Name: 問い合わせサンクス
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
			<span><?php echo get_post_field( 'post_name' ) === 'contact-thanks' ? 'お問い合わせ' : '応募フォーム'; ?></span>
		</div>
	</div>

	<div class="contact thanks page-body">
		<div class="contact__inner thanks__inner">
			<h1 class="thanks__title"><?php the_title(); ?></h1>
			<?php if ( get_post_field( 'post_name' ) === 'contact-thanks' ) : ?>
			<p class="thanks__body">
				お送りいただいた内容を確認のうえ、<br>
				担当者よりご連絡いたします。<br>
				今しばらくお待ちください。
			</p>
			<?php else : ?>
			<p class="thanks__body">
				ご応募内容を確認させていただきます。<br>
				担当者が面談を希望する場合のみ、改めてご連絡いたします。<br>
				ご連絡まで今しばらくお待ちください。
			</p>
			<?php endif; ?>
			<p class="thanks__note">
				※ 確認メールをお送りしております。<br>
				届かない場合は迷惑メールフォルダを<br class="sp-only">ご確認ください。
			</p>
		</div>
	</div>

</main>

<?php get_footer(); ?>
