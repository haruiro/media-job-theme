<?php
/**
 * メディキャリとは？ページ
 * Template Name: メディキャリとは？
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
			<span>メディキャリとは？</span>
		</div>
	</div>

	<div class="page-body">
		<div class="about">
			<div class="about__inner">

				<h1 class="about__title">メディキャリとは？</h1>

				<div class="about__video">
					<div class="about__video-wrap">
						<iframe
							src="https://www.youtube.com/embed/aqz-KE-bpKQ?rel=0"
							frameborder="0"
							allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
							allowfullscreen
						></iframe>
					</div>
				</div>

				<div class="about__lead">
					<p>メディキャリは「求人情報」と「動画コンテンツ」をひとまとめにしたメディアサイトです。<br>
					動画制作とサイトへの掲出がセットのプランを低コストでご提供しております。<br>
					企業の魅力を動画の力でリアルに伝え、地域で働く人材とのベストな出会いをサポートします。</p>
				</div>

				<div class="about__points">

					<div class="about__point">
						<div class="about__point-head">
							<span class="about__point-label">POINT①</span>
							<h2 class="about__point-title">動画だから伝わる職場の「リアル」</h2>
						</div>
						<p class="about__point-body">「求人を出してもいい人が来ない」「入社してもすぐ辞めてしまう」<br>
						といった企業の悩みを解決。<br>
						求人広告の原稿だけでは伝わらない『社風』を動画で伝えることで、<br>
						入社後のミスマッチを防ぎます。</p>
					</div>

					<div class="about__point">
						<div class="about__point-head">
							<span class="about__point-label">POINT②</span>
							<h2 class="about__point-title">プロの撮影・編集だから安心</h2>
						</div>
						<p class="about__point-body">撮影当日はプロが指示を出すので、ご担当者の立ち会いだけでOK。<br>
						「動画なんて撮ったことがない」という企業様も安心。<br>
						動画制作実績多数ならではのハイクオリティを実現します。</p>
					</div>

					<div class="about__point">
						<div class="about__point-head">
							<span class="about__point-label">POINT③</span>
							<h2 class="about__point-title">地域に特化した集客</h2>
						</div>
						<p class="about__point-body">各地域に根ざした企業を掲載することで、地元で働きたい人材<br>
						にしっかり届きます。</p>
					</div>

					<div class="about__point">
						<div class="about__point-head">
							<span class="about__point-label">POINT④</span>
							<h2 class="about__point-title">採用活動をトータルサポート</h2>
						</div>
						<p class="about__point-body">動画制作からSNS運用までおまかせ。<br>
						採用担当者様の負担を軽減します。</p>
					</div>

				</div><!-- .about__points -->

				<div class="about__cta">
					<p>動画の制作・掲載をご希望の方はこちらからお問い合わせください。</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--main">お問い合わせフォームへ</a>
				</div>

			</div><!-- .about__inner -->
		</div><!-- .about -->
	</div>

</main>

<?php get_footer(); ?>
