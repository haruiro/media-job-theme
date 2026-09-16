<?php
/**
 * 検索結果ページ
 *
 * @package media-job-theme
 */

get_header();

$employment_terms   = get_terms( array( 'taxonomy' => 'employment_type', 'hide_empty' => false ) );
$job_type_terms     = get_terms( array( 'taxonomy' => 'job_type',        'hide_empty' => false ) );
$area_terms         = homecareer_get_area_terms();
$current_employment = get_query_var( 'employment_type' );
$current_job_type   = get_query_var( 'job_type' );
$current_area       = get_query_var( 'area' );
$current_keyword    = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
?>

<main id="primary" class="site-main">

	<div class="breadcrumb">
		<div class="breadcrumb__inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a>
			<span class="breadcrumb__sep">›</span>
			<span>検索結果</span>
		</div>
	</div>

	<div class="page-body">
		<?php get_template_part( 'template-parts/search-form', null, array(
			'employment_terms'   => $employment_terms,
			'job_type_terms'     => $job_type_terms,
			'area_terms'         => $area_terms,
			'current_employment' => $current_employment,
			'current_job_type'   => $current_job_type,
			'current_area'       => $current_area,
			'current_keyword'    => $current_keyword,
		) ); ?>

		<?php get_template_part( 'template-parts/job-list', null, array(
			'title' => '求人情報の検索結果一覧',
		) ); ?>
	</div>

</main>

<?php get_footer(); ?>
