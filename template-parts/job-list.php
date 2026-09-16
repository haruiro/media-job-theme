<?php
/**
 * 求人カード一覧 + ページネーション
 *
 * @package media-job-theme
 */

$title = $args['title'] ?? '求人情報一覧';

global $wp_query;
?>
<div class="job-archive">
	<div class="job-archive__inner">

		<div class="job-archive__header">
			<h1 class="job-archive__title"><?php echo esc_html( $title ); ?></h1>
			<?php if ( have_posts() ) : ?>
				<p class="job-archive__count">
					該当求人数<strong><?php echo $wp_query->found_posts; ?></strong>件中
					<?php
					$paged    = max( 1, get_query_var( 'paged' ) );
					$per_page = get_option( 'posts_per_page' );
					$from     = ( $paged - 1 ) * $per_page + 1;
					$to       = min( $paged * $per_page, $wp_query->found_posts );
					echo $from . '〜' . $to;
					?>件を表示
				</p>
			<?php endif; ?>
		</div>

		<?php if ( have_posts() ) : ?>

			<div class="job-list">
				<?php while ( have_posts() ) : the_post();
					$company_name     = get_field( 'company_name' );
					$salary           = get_field( 'salary' );
					$location         = get_field( 'location' );
					$employment_types = get_the_terms( get_the_ID(), 'employment_type' );
					$job_types        = get_the_terms( get_the_ID(), 'job_type' );
					$video_url  = get_field( 'video_url_1' );
					$youtube_id = '';
					if ( $video_url ) {
						preg_match( '/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video_url, $matches );
						$youtube_id = $matches[1] ?? '';
					}
				?>
				<article class="job-card">
					<a href="<?php the_permalink(); ?>" class="job-card__link">
						<div class="job-card__thumb">
							<?php if ( $youtube_id ) : ?>
								<img src="https://img.youtube.com/vi/<?php echo esc_attr( $youtube_id ); ?>/hqdefault.jpg" alt="<?php the_title_attribute(); ?>" class="job-card__img">
							<?php elseif ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium', array( 'class' => 'job-card__img' ) ); ?>
							<?php else : ?>
								<div class="job-card__img-placeholder"></div>
							<?php endif; ?>
						</div>
						<div class="job-card__body">
							<div>
								<h2 class="job-card__title"><?php the_title(); ?></h2>
								<?php if ( $company_name ) : ?>
									<p class="job-card__company"><?php echo esc_html( $company_name ); ?></p>
								<?php endif; ?>
							</div>
							<ul class="job-card__meta">
								<?php if ( $location ) : ?>
								<li class="job-card__meta-item">
									<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icons/pin.svg" alt="" class="job-card__meta-icon">
									<span><?php echo esc_html( $location ); ?></span>
								</li>
								<?php endif; ?>
								<?php if ( $job_types && ! is_wp_error( $job_types ) ) : ?>
								<li class="job-card__meta-item">
									<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icons/business.svg" alt="" class="job-card__meta-icon">
									<span><?php echo esc_html( $job_types[0]->name ); ?></span>
								</li>
								<?php endif; ?>
								<?php if ( $salary ) : ?>
								<li class="job-card__meta-item">
									<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icons/money.svg" alt="" class="job-card__meta-icon">
									<span><?php echo esc_html( $salary ); ?></span>
								</li>
								<?php endif; ?>
							</ul>
							<?php if ( $employment_types && ! is_wp_error( $employment_types ) ) : ?>
							<div class="job-card__tags">
								<?php foreach ( $employment_types as $tag ) : ?>
									<span class="job-card__tag"><?php echo esc_html( $tag->name ); ?></span>
								<?php endforeach; ?>
								<?php if ( $job_types && ! is_wp_error( $job_types ) ) : ?>
									<?php foreach ( $job_types as $tag ) : ?>
										<span class="job-card__tag"><?php echo esc_html( $tag->name ); ?></span>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</div>
					</a>
				</article>
				<?php endwhile; ?>
			</div>

			<!-- ページネーション -->
			<div class="job-archive__pagination">
				<?php
				$total_pages  = $wp_query->max_num_pages;
				if ( $total_pages > 1 ) :
					$current_page = max( 1, get_query_var( 'paged' ) );
				?>
				<nav class="pagination" aria-label="ページナビゲーション">
					<?php if ( $current_page > 1 ) : ?>
						<a href="<?php echo esc_url( get_pagenum_link( $current_page - 1 ) ); ?>" class="pagination__prev">‹ 前へ</a>
					<?php endif; ?>

					<?php for ( $i = 1; $i <= $total_pages; $i++ ) : ?>
						<?php if ( $i === $current_page ) : ?>
							<span class="pagination__item pagination__item--current"><?php echo $i; ?></span>
						<?php else : ?>
							<a href="<?php echo esc_url( get_pagenum_link( $i ) ); ?>" class="pagination__item"><?php echo $i; ?></a>
						<?php endif; ?>
					<?php endfor; ?>

					<?php if ( $current_page < $total_pages ) : ?>
						<a href="<?php echo esc_url( get_pagenum_link( $current_page + 1 ) ); ?>" class="pagination__next">次へ ›</a>
					<?php endif; ?>
				</nav>
				<?php endif; ?>
			</div>

		<?php else : ?>
			<div class="job-archive__empty">
				<p>該当する求人が見つかりませんでした。</p>
				<p>条件を変えて再度検索してみてください。</p>
			</div>
		<?php endif; ?>

	</div>
</div>
