<?php
/**
 * 求人詳細ページ
 *
 * @package media-job-theme
 */

get_header();
?>

<main id="primary" class="site-main">
<?php while ( have_posts() ) : the_post(); ?>

	<?php
	$company_name  = get_field( 'company_name' );
	$company_logo  = get_field( 'company_logo' );
	$catch_copy    = get_field( 'catch_copy' );
	$job_desc      = get_field( 'job_description' );
	$salary        = get_field( 'salary' );
	$bonus         = get_field( 'bonus' );
	$working_hours = get_field( 'working_hours' );
	$holidays      = get_field( 'holidays' );
	$probation     = get_field( 'probation' );
	$benefits      = get_field( 'benefits' );
	$location      = get_field( 'location' );
	$company_about = get_field( 'company_about' );
	$founded       = get_field( 'founded' );
	$employees     = get_field( 'employees' );
	$capital       = get_field( 'capital' );
	$business      = get_field( 'business' );

	$employment_types = get_the_terms( get_the_ID(), 'employment_type' );
	$employment_label = $employment_types ? $employment_types[0]->name : '';

	$detail_videos = array();
	foreach ( range( 1, 5 ) as $i ) {
		$url = get_field( 'video_url_' . $i );
		if ( $url ) {
			preg_match( '/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m );
			if ( ! empty( $m[1] ) ) {
				$detail_videos[] = $m[1];
			}
		}
	}
	?>

	<!-- パンくずリスト -->
	<div class="breadcrumb">
		<div class="breadcrumb__inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a>
			<span class="breadcrumb__sep">›</span>
			<a href="<?php echo esc_url( home_url( '/jobs' ) ); ?>">一覧</a>
			<span class="breadcrumb__sep">›</span>
			<span><?php echo esc_html( $company_name ); ?></span>
		</div>
	</div>

	<div class="job-detail page-body">
		<div class="job-detail__inner">

			<!-- メインカラム -->
			<div class="job-detail__main">

				<!-- ヘッダー -->
				<div class="job-detail__header">
					<div class="job-detail__logo-wrap">
						<?php if ( $company_logo ) : ?>
							<img src="<?php echo esc_url( $company_logo['url'] ); ?>" alt="<?php echo esc_attr( $company_logo['alt'] ); ?>" class="job-detail__logo">
						<?php else : ?>
							<div class="job-detail__logo-placeholder">ロゴ</div>
						<?php endif; ?>
					</div>
					<div class="job-detail__header-info">
						<h1 class="job-detail__title"><?php the_title(); ?></h1>
						<p class="job-detail__company"><?php echo esc_html( $company_name ); ?></p>
					</div>
				</div>

				<!-- キャッチコピー -->
				<?php if ( $catch_copy ) : ?>
					<p class="job-detail__catch"><?php echo esc_html( $catch_copy ); ?></p>
				<?php endif; ?>

				<!-- アイキャッチ画像 -->
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="job-detail__thumb">
						<?php the_post_thumbnail( 'large', array( 'class' => 'job-detail__thumb-img' ) ); ?>
					</div>
				<?php endif; ?>

				<!-- 動画一覧 -->
				<?php if ( ! empty( $detail_videos ) ) : ?>
				<div class="job-detail__section">
					<h2 class="job-detail__section-title">動画一覧</h2>
					<div class="job-detail__videos">
						<?php foreach ( $detail_videos as $vid ) : ?>
						<button class="job-detail__video-thumb js-video-open" data-youtube-id="<?php echo esc_attr( $vid ); ?>" aria-label="動画を再生">
							<img src="https://img.youtube.com/vi/<?php echo esc_attr( $vid ); ?>/hqdefault.jpg" alt="">
							<span class="job-detail__video-play">
								<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="24" cy="24" r="24" fill="white" fill-opacity="0.9"/>
									<path d="M19 15L35 24L19 33V15Z" fill="#D10000"/>
								</svg>
							</span>
						</button>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif; ?>

				<!-- 募集要項 -->
				<div class="job-detail__section">
					<h2 class="job-detail__section-title">募集要項</h2>
					<table class="job-detail__table">
						<?php if ( $job_desc ) : ?>
						<tr>
							<th>■仕事内容</th>
							<td><?php echo nl2br( esc_html( $job_desc ) ); ?></td>
						</tr>
						<?php endif; ?>
						<tr>
							<th>■勤務条件</th>
							<td>
								<dl class="job-detail__dl">
									<?php if ( $employment_label ) : ?>
									<div class="job-detail__dl-row">
										<dt>雇用形態</dt>
										<dd><?php echo esc_html( $employment_label ); ?></dd>
									</div>
									<?php endif; ?>
									<?php if ( $salary ) : ?>
									<div class="job-detail__dl-row">
										<dt>給与</dt>
										<dd><?php echo nl2br( esc_html( $salary ) ); ?></dd>
									</div>
									<?php endif; ?>
									<?php if ( $bonus ) : ?>
									<div class="job-detail__dl-row">
										<dt>賞与</dt>
										<dd><?php echo nl2br( esc_html( $bonus ) ); ?></dd>
									</div>
									<?php endif; ?>
									<?php if ( $working_hours ) : ?>
									<div class="job-detail__dl-row">
										<dt>勤務時間</dt>
										<dd><?php echo nl2br( esc_html( $working_hours ) ); ?></dd>
									</div>
									<?php endif; ?>
									<?php if ( $holidays ) : ?>
									<div class="job-detail__dl-row">
										<dt>休日休暇</dt>
										<dd><?php echo nl2br( esc_html( $holidays ) ); ?></dd>
									</div>
									<?php endif; ?>
									<?php if ( $probation ) : ?>
									<div class="job-detail__dl-row">
										<dt>試用期間</dt>
										<dd><?php echo nl2br( esc_html( $probation ) ); ?></dd>
									</div>
									<?php endif; ?>
									<?php if ( $benefits ) : ?>
									<div class="job-detail__dl-row">
										<dt>福利厚生</dt>
										<dd><?php echo nl2br( esc_html( $benefits ) ); ?></dd>
									</div>
									<?php endif; ?>
								</dl>
							</td>
						</tr>
						<?php if ( $location ) : ?>
						<tr>
							<th>■勤務地</th>
							<td><?php echo nl2br( esc_html( $location ) ); ?></td>
						</tr>
						<?php endif; ?>
					</table>
				</div>

				<!-- 会社概要 -->
				<div class="job-detail__section">
					<h2 class="job-detail__section-title">会社概要</h2>
					<table class="job-detail__table">
						<?php if ( $company_about ) : ?>
						<tr>
							<th>■会社について</th>
							<td><?php echo nl2br( esc_html( $company_about ) ); ?></td>
						</tr>
						<?php endif; ?>
						<tr>
							<th>■企業情報</th>
							<td>
								<dl class="job-detail__dl">
									<?php if ( $company_name ) : ?>
									<div class="job-detail__dl-row">
										<dt>会社名</dt>
										<dd><?php echo esc_html( $company_name ); ?></dd>
									</div>
									<?php endif; ?>
									<?php if ( $founded ) : ?>
									<div class="job-detail__dl-row">
										<dt>設立</dt>
										<dd><?php echo esc_html( $founded ); ?></dd>
									</div>
									<?php endif; ?>
									<?php if ( $employees ) : ?>
									<div class="job-detail__dl-row">
										<dt>従業員数</dt>
										<dd><?php echo esc_html( $employees ); ?></dd>
									</div>
									<?php endif; ?>
									<?php if ( $capital ) : ?>
									<div class="job-detail__dl-row">
										<dt>資本金</dt>
										<dd><?php echo esc_html( $capital ); ?></dd>
									</div>
									<?php endif; ?>
									<?php if ( $business ) : ?>
									<div class="job-detail__dl-row">
										<dt>事業内容</dt>
										<dd><?php echo nl2br( esc_html( $business ) ); ?></dd>
									</div>
									<?php endif; ?>
								</dl>
							</td>
						</tr>
					</table>
				</div>

			</div><!-- .job-detail__main -->

			<!-- サイドバー -->
			<aside class="job-detail__sidebar">
				<div class="job-detail__sidebar-card">

					<div class="job-detail__sidebar-logo">
						<?php if ( $company_logo ) : ?>
							<img src="<?php echo esc_url( $company_logo['url'] ); ?>" alt="<?php echo esc_attr( $company_logo['alt'] ); ?>">
						<?php else : ?>
							<div class="job-detail__logo-placeholder">ロゴ</div>
						<?php endif; ?>
					</div>

					<p class="job-detail__sidebar-title"><?php the_title(); ?></p>
					<p class="job-detail__sidebar-company"><?php echo esc_html( $company_name ); ?></p>

					<ul class="job-detail__sidebar-meta">
						<?php if ( $employment_label ) : ?>
						<li class="job-detail__sidebar-meta-item">
							<div class="job-detail__sidebar-meta-label">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icons/business.svg" alt="">
								<span class="job-detail__sidebar-meta-label">雇用形態</span>
              </div>
              <p class="job-detail__sidebar-meta-value"><?php echo esc_html( $employment_label ); ?></p>
						</li>
						<?php endif; ?>
						<?php if ( $salary ) : ?>
						<li class="job-detail__sidebar-meta-item">
							<div class="job-detail__sidebar-meta-label">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icons/money.svg" alt="">
								<span class="job-detail__sidebar-meta-label">給与</span>
              </div>
              <p class="job-detail__sidebar-meta-value"><?php echo esc_html( $salary ); ?></p>
						</li>
						<?php endif; ?>
						<?php if ( $location ) : ?>
						<li class="job-detail__sidebar-meta-item">
							<div class="job-detail__sidebar-meta-label">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icons/pin.svg" alt="">
								<span class="job-detail__sidebar-meta-label">勤務地</span>
              </div>
              <p class="job-detail__sidebar-meta-value"><?php echo esc_html( $location ); ?></p>
						</li>
						<?php endif; ?>
						<?php if ( $working_hours ) : ?>
						<li class="job-detail__sidebar-meta-item">
							<div class="job-detail__sidebar-meta-label">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icons/time.svg" alt="">
								<span class="job-detail__sidebar-meta-label">勤務時間</span>
							</div>
              <p class="job-detail__sidebar-meta-value"><?php echo esc_html( $working_hours ); ?></p>
						</li>
						<?php endif; ?>
					</ul>

					<a href="<?php echo esc_url( home_url( '/apply/?company=' . urlencode( $company_name ) ) ); ?>" class="btn btn--main job-detail__apply-btn">
						応募する
					</a>

				</div>
			</aside>

		</div><!-- .job-detail__inner -->
	</div><!-- .job-detail -->

	<!-- SP固定応募ボタン -->
	<div class="job-detail__sp-apply">
		<a href="<?php echo esc_url( home_url( '/apply/?company=' . urlencode( $company_name ) ) ); ?>" class="btn btn--primary job-detail__sp-apply-btn">
			この会社に応募する
		</a>
	</div>

<?php endwhile; ?>
</main>

<!-- 動画モーダル -->
<div class="video-modal" id="videoModal" aria-hidden="true">
	<div class="video-modal__overlay js-video-close"></div>
	<div class="video-modal__content">
		<button class="video-modal__close js-video-close" aria-label="閉じる">✕</button>
		<div class="video-modal__iframe-wrap">
			<iframe id="videoModalIframe" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
</div>

<?php get_footer(); ?>
