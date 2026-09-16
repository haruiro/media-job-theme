<?php
/**
 * カスタム投稿タイプとタクソノミーの登録
 *
 * @package media-job-theme
 */

// =============================================
// カスタム投稿タイプ：求人
// =============================================
function homecareer_register_post_types() {
	register_post_type(
		'job',
		array(
			'labels' => array(
				'name'               => '求人',
				'singular_name'      => '求人',
				'add_new'            => '新規追加',
				'add_new_item'       => '求人を追加',
				'edit_item'          => '求人を編集',
				'new_item'           => '新しい求人',
				'view_item'          => '求人を表示',
				'search_items'       => '求人を検索',
				'not_found'          => '求人が見つかりません',
				'not_found_in_trash' => 'ゴミ箱に求人はありません',
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'jobs' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'menu_icon'    => 'dashicons-businessman',
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'homecareer_register_post_types' );


// =============================================
// タクソノミー登録
// =============================================
function homecareer_register_taxonomies() {

	// 雇用形態
	register_taxonomy(
		'employment_type',
		'job',
		array(
			'labels' => array(
				'name'          => '雇用形態',
				'singular_name' => '雇用形態',
				'search_items'  => '雇用形態を検索',
				'all_items'     => 'すべての雇用形態',
				'edit_item'     => '雇用形態を編集',
				'update_item'   => '雇用形態を更新',
				'add_new_item'  => '雇用形態を追加',
				'new_item_name' => '新しい雇用形態',
				'menu_name'     => '雇用形態',
			),
			'hierarchical'      => true,
			'public'            => true,
			'rewrite'           => array( 'slug' => 'employment-type' ),
			'show_in_rest'      => true,
			'show_admin_column' => true,
		)
	);

	// 職種
	register_taxonomy(
		'job_type',
		'job',
		array(
			'labels' => array(
				'name'              => '職種',
				'singular_name'     => '職種',
				'search_items'      => '職種を検索',
				'all_items'         => 'すべての職種',
				'parent_item'       => '親の職種',
				'parent_item_colon' => '親の職種:',
				'edit_item'         => '職種を編集',
				'update_item'       => '職種を更新',
				'add_new_item'      => '職種を追加',
				'new_item_name'     => '新しい職種',
				'menu_name'         => '職種',
			),
			'hierarchical'      => true,
			'public'            => true,
			'rewrite'           => array( 'slug' => 'job-type' ),
			'show_in_rest'      => true,
			'show_admin_column' => true,
		)
	);

	// 動画カテゴリー
	register_taxonomy(
		'video_category',
		'job',
		array(
			'labels' => array(
				'name'          => '動画カテゴリー',
				'singular_name' => '動画カテゴリー',
				'search_items'  => '動画カテゴリーを検索',
				'all_items'     => 'すべての動画カテゴリー',
				'edit_item'     => '動画カテゴリーを編集',
				'update_item'   => '動画カテゴリーを更新',
				'add_new_item'  => '動画カテゴリーを追加',
				'new_item_name' => '新しい動画カテゴリー',
				'menu_name'     => '動画カテゴリー',
			),
			'hierarchical'      => true,
			'public'            => true,
			'rewrite'           => array( 'slug' => 'video-category' ),
			'show_in_rest'      => true,
			'show_admin_column' => true,
		)
	);

	// 地域
	register_taxonomy(
		'area',
		'job',
		array(
			'labels' => array(
				'name'          => '地域',
				'singular_name' => '地域',
				'search_items'  => '地域を検索',
				'all_items'     => 'すべての地域',
				'edit_item'     => '地域を編集',
				'update_item'   => '地域を更新',
				'add_new_item'  => '地域を追加',
				'new_item_name' => '新しい地域',
				'menu_name'     => '地域',
			),
			'hierarchical'      => true,
			'public'            => true,
			'rewrite'           => array( 'slug' => 'area' ),
			'show_in_rest'      => true,
			'show_admin_column' => true,
		)
	);
}
add_action( 'init', 'homecareer_register_taxonomies' );


// =============================================
// タクソノミーの初期データ投入（未登録の場合のみ）
// =============================================
function homecareer_insert_default_terms() {

	// 雇用形態
	$employment_types = array(
		'正社員',
		'契約社員',
		'パート・アルバイト',
		'派遣社員',
		'業務委託',
		'インターン',
	);
	foreach ( $employment_types as $term ) {
		if ( ! term_exists( $term, 'employment_type' ) ) {
			wp_insert_term( $term, 'employment_type' );
		}
	}

	// 職種
	$job_types = array(
		'IT・エンジニア',
		'営業・販売',
		'事務・管理',
		'医療・介護',
		'製造・物流',
		'飲食・サービス',
		'建設・不動産',
		'教育・保育',
		'クリエイティブ・デザイン',
		'その他',
	);
	foreach ( $job_types as $term ) {
		if ( ! term_exists( $term, 'job_type' ) ) {
			wp_insert_term( $term, 'job_type' );
		}
	}

	// 動画カテゴリー
	$video_categories = array(
		array( 'name' => '社員インタビュー',     'slug' => 'interview' ),
		array( 'name' => '座談会',               'slug' => 'zadankai' ),
		array( 'name' => '密着ドキュメンタリー', 'slug' => 'documentary' ),
		array( 'name' => '代表インタビュー',     'slug' => 'president_interview' ),
		array( 'name' => '説明動画',             'slug' => 'explanation' ),
	);
	foreach ( $video_categories as $term ) {
		if ( ! term_exists( $term['name'], 'video_category' ) ) {
			wp_insert_term( $term['name'], 'video_category', array( 'slug' => $term['slug'] ) );
		}
	}

	// 地域（47都道府県）
	$areas = array(
		'北海道',
		'青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
		'茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
		'新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県',
		'三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県',
		'鳥取県', '島根県', '岡山県', '広島県', '山口県',
		'徳島県', '香川県', '愛媛県', '高知県',
		'福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県',
	);
	foreach ( $areas as $term ) {
		if ( ! term_exists( $term, 'area' ) ) {
			wp_insert_term( $term, 'area' );
		}
	}
}
add_action( 'init', 'homecareer_insert_default_terms' );
