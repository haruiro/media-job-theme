<?php
/**
 * 求人検索フォーム
 *
 * @package media-job-theme
 */

$employment_terms   = $args['employment_terms']   ?? array();
$job_type_terms     = $args['job_type_terms']     ?? array();
$area_terms         = $args['area_terms']         ?? array();
$current_employment = $args['current_employment'] ?? '';
$current_job_type   = $args['current_job_type']   ?? '';
$current_area       = $args['current_area']       ?? '';
$current_keyword    = $args['current_keyword']    ?? '';
$modifier           = $args['modifier']           ?? '';
?>
<section class="search-section <?php echo esc_attr( $modifier ); ?>">
	<div class="search-section__inner">
		<form class="search-form" action="<?php echo esc_url( home_url( '/jobs/' ) ); ?>" method="get">
			<div class="search-form__filters">

				<div class="search-form__select-wrap">
					<select name="employment_type" class="search-form__select">
						<option value="">雇用形態</option>
						<?php foreach ( $employment_terms as $term ) : ?>
							<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $current_employment, $term->slug ); ?>>
								<?php echo esc_html( $term->name ); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<span class="search-form__separator pc-only">×</span>

				<div class="search-form__select-wrap">
					<select name="job_type" class="search-form__select">
						<option value="">職種・業種</option>
						<?php foreach ( $job_type_terms as $term ) : ?>
							<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $current_job_type, $term->slug ); ?>>
								<?php echo esc_html( $term->name ); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<span class="search-form__separator pc-only">×</span>

				<div class="search-form__select-wrap search-form__select-wrap--last">
					<select name="area" class="search-form__select">
						<option value="">地域（市町村・駅名）</option>
						<?php foreach ( $area_terms as $term ) : ?>
							<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $current_area, $term->slug ); ?>>
								<?php echo esc_html( $term->name ); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

			</div>
			<div class="search-form__keyword-row">
				<input type="text" name="s" class="search-form__keyword" placeholder="キーワードを入力" value="<?php echo esc_attr( $current_keyword ); ?>">
				<button type="submit" class="btn btn--main search-form__submit">求人を検索する</button>
			</div>
		</form>
	</div>
</section>
