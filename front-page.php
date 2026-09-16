<?php
/**
 * The front page template
 *
 * @package media-job-theme
 */

get_header();
?>

<main id="primary" class="site-main">

	<!-- ヒーローセクション -->
	<section class="hero">
		<div class="hero__collage">
      <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/top/first_view.jpg" class="pc-only">
      <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/top/first_view_sp.jpg" class="sp-only">
		</div>
		<div class="hero__content">
			<h1 class="hero__title hero__content-item">
				<span class="hero__title-highlight">動画</span>で知る、<span class="hero__title-highlight">地域</span>のシゴト
			</h1>
			<div class="hero__logo-mark hero__content-item">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="メディキャリ">
			</div>
		</div>
	</section>

	<!-- 検索フォームセクション -->
	<?php
	$employment_terms = get_terms( array( 'taxonomy' => 'employment_type', 'hide_empty' => false ) );
	$job_type_terms   = get_terms( array( 'taxonomy' => 'job_type',        'hide_empty' => false ) );
	$area_terms       = homecareer_get_area_terms();
	?>
	<section class="search-section search-section--top">
		<div class="search-section__inner">
			<form class="search-form" action="<?php echo esc_url( home_url( '/jobs/' ) ); ?>" method="get">
				<div class="search-form__filters">
					<div class="search-form__select-wrap">
						<select name="employment_type" class="search-form__select">
							<option value="">雇用形態</option>
							<?php foreach ( $employment_terms as $term ) : ?>
								<option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<span class="search-form__separator pc-only">×</span>
					<div class="search-form__select-wrap">
						<select name="job_type" class="search-form__select">
							<option value="">職種・業種</option>
							<?php foreach ( $job_type_terms as $term ) : ?>
								<option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<span class="search-form__separator pc-only">×</span>
					<div class="search-form__select-wrap search-form__select-wrap--last">
						<select name="area" class="search-form__select">
							<option value="">地域（都道府県）</option>
							<?php foreach ( $area_terms as $term ) : ?>
								<option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="search-form__keyword-row">
					<input type="text" name="s" class="search-form__keyword" placeholder="キーワードを入力">
					<button type="submit" class="btn btn--main search-form__submit">求人を検索する</button>
				</div>
			</form>
		</div>
	</section>

	<!-- おすすめ企業セクション -->
	<section class="section section--white">
		<div class="section__inner">
			<div class="section__header">
				<h2 class="section__title">おすすめ企業</h2>
				<a href="<?php echo esc_url( home_url( '/jobs/?recommended=1' ) ); ?>" class="btn btn--main pc-only">もっと見る</a>
			</div>
			<div class="card-grid">
				<?php
				$recommended_query = new WP_Query( array(
					'post_type'      => 'job',
					'posts_per_page' => 3,
					'post_status'    => 'publish',
					'meta_query'     => array(
						array(
							'key'   => 'is_recommended',
							'value' => '1',
						),
					),
					'meta_key' => 'priority',
					'orderby'  => 'meta_value_num',
					'order'    => 'DESC',
				) );
				if ( $recommended_query->have_posts() ) :
					while ( $recommended_query->have_posts() ) :
						$recommended_query->the_post();
						$company_name  = get_field( 'company_name' );
						$company_about = get_field( 'company_about' );
						?>
						<article class="card card--company">
							<a href="<?php the_permalink(); ?>" class="card__link">
								<div class="card__thumb">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'medium_large', array( 'class' => 'card__image' ) ); ?>
									<?php else : ?>
										<div class="card__thumb--placeholder"></div>
									<?php endif; ?>
								</div>
								<div class="card__body">
									<h3 class="card__title"><?php echo esc_html( $company_name ?: get_the_title() ); ?></h3>
									<?php if ( $company_about ) : ?>
										<?php $about_text = str_replace( array( "\r\n", "\r", "\n" ), ' ', $company_about ); ?>
										<p class="card__excerpt"><?php echo esc_html( mb_substr( $about_text, 0, 40 ) ); ?><?php if ( mb_strlen( $about_text ) > 40 ) echo '…'; ?></p>
									<?php endif; ?>
								</div>
							</a>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
        <div class="sp-only text-center">
          <a href="<?php echo esc_url( home_url( '/jobs/?recommended=1' ) ); ?>" class="btn btn--main">もっと見る</a>
        </div>
			</div>
		</div>
	</section>

	<!-- 新着動画セクション -->
	<section class="section section--sub">
		<div class="section__inner">
			<div class="section__header">
				<h2 class="section__title">新着動画</h2>
				<a href="<?php echo esc_url( home_url( '/jobs/?orderby=new' ) ); ?>" class="btn btn--main pc-only">もっと見る</a>
			</div>
			<div class="card-grid">
				<?php
				$new_video_query = new WP_Query( array(
					'post_type'      => 'job',
					'posts_per_page' => 3,
					'post_status'    => 'publish',
					'orderby'        => 'date',
					'order'          => 'DESC',
					'meta_query'     => array(
						array(
							'key'     => 'video_url_1',
							'value'   => '',
							'compare' => '!=',
						),
					),
				) );
				if ( $new_video_query->have_posts() ) :
					while ( $new_video_query->have_posts() ) :
						$new_video_query->the_post();
						$video_url    = get_field( 'video_url_1' );
						$video_title  = get_field( 'video_title' );
						$company_name = get_field( 'company_name' );
						$youtube_id   = '';
						if ( $video_url ) {
							preg_match( '/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video_url, $matches );
							$youtube_id = $matches[1] ?? '';
						}
						?>
						<article class="card card--video">
							<a href="<?php the_permalink(); ?>" class="card__link">
								<div class="card__thumb">
									<?php if ( $youtube_id ) : ?>
										<img
											src="https://img.youtube.com/vi/<?php echo esc_attr( $youtube_id ); ?>/hqdefault.jpg"
											alt="<?php echo esc_attr( $video_title ?: get_the_title() ); ?>"
											class="card__image"
										>
										<div class="card__play-btn">
											<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
												<circle cx="24" cy="24" r="24" fill="white" fill-opacity="0.9"/>
												<path d="M19 15L35 24L19 33V15Z" fill="#D10000"/>
											</svg>
										</div>
									<?php elseif ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'medium_large', array( 'class' => 'card__image' ) ); ?>
									<?php else : ?>
										<div class="card__thumb--placeholder"></div>
									<?php endif; ?>
								</div>
								<div class="card__body">
									<h3 class="card__title"><?php echo esc_html( $video_title ?: get_the_title() ); ?></h3>
									<?php if ( $company_name ) : ?>
										<p class="card__company"><?php echo esc_html( $company_name ); ?></p>
									<?php endif; ?>
								</div>
							</a>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>

        <div class="sp-only text-center">
          <a href="<?php echo esc_url( home_url( '/jobs/?orderby=new' ) ); ?>" class="btn btn--main">もっと見る</a>
        </div>
			</div>
		</div>
	</section>


	<!-- カテゴリー別に探すセクション -->
	<section class="section section--white">
		<div class="section__inner">
			<div class="section__header">
				<h2 class="section__title">カテゴリー別に探す</h2>
			</div>
			<div class="category-grid">
				<?php
				$video_cats = get_terms( array( 'taxonomy' => 'video_category', 'hide_empty' => false ) );
				foreach ( $video_cats as $cat ) :
					$archive_url = add_query_arg( 'video_category', $cat->slug, home_url( '/jobs/' ) );
				?>
				<a href="<?php echo esc_url( $archive_url ); ?>" class="category-card">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/top/category_<?php echo esc_attr( $cat->slug ); ?>.jpg" alt="<?php echo esc_attr( $cat->name ); ?>">
					<div class="category-card__overlay"></div>
					<span class="category-card__name"><?php echo esc_html( $cat->name ); ?></span>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

</main><!-- #main -->

<?php get_footer(); ?>
