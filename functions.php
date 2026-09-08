<?php
/**
 * homecareer-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package homecareer-theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.1' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function homecareer_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on homecareer-theme, use a find and replace
		* to change 'homecareer-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'homecareer-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'homecareer-theme' ),
			'footer' => 'フッター',
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'homecareer_theme_setup' );


/**
 * Enqueue scripts and styles.
 */
function homecareer_theme_scripts() {
	// Google Fonts
	wp_enqueue_style(
		'google-fonts',
		'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap',
		array(),
		null
	);

	// メインスタイルシート
	wp_enqueue_style(
		'homecareer-theme-style',
		get_template_directory_uri() . '/assets/css/main.css',
		array( 'google-fonts' ),
		_S_VERSION
	);

	wp_enqueue_script( 'homecareer-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular( 'job' ) ) {
		wp_enqueue_script( 'homecareer-theme-video-modal', get_template_directory_uri() . '/js/video-modal.js', array(), _S_VERSION, true );
	}

	if ( is_page_template( 'page-contact.php' ) || is_page_template( 'page-contact-confirm.php' ) || is_page_template( 'page-apply.php' ) || is_page_template( 'page-apply-confirm.php' ) ) {
		wp_enqueue_script( 'homecareer-theme-contact', get_template_directory_uri() . '/js/contact.js', array(), _S_VERSION, true );
	}


}
add_action( 'wp_enqueue_scripts', 'homecareer_theme_scripts' );

add_filter( 'wpcf7_autop_or_not', '__return_false' );

add_filter( 'wpcf7_ajax_json_echo', function( $items, $result ) {
	if ( isset( $result['status'] ) && $result['status'] === 'mail_sent' ) {
		$form = WPCF7_ContactForm::get_current();
		if ( $form && $form->title() === '応募フォーム（確認）' ) {
			$items['redirect_to'] = home_url( '/contact-thanks/' );
		}
	}
	return $items;
}, 10, 2 );

add_filter( 'wpcf7_posted_data', function( $posted_data ) {
	if ( isset( $_POST['company-name'] ) ) {
		$posted_data['company-name'] = sanitize_text_field( $_POST['company-name'] );
	}
	return $posted_data;
} );


/**
 * カスタム投稿タイプ・タクソノミー登録
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * 管理画面を含め area タクソノミーのタームを都道府県順にする
 */
add_filter( 'get_terms', function( $terms, $taxonomies, $args ) {
	if ( ! in_array( 'area', (array) $taxonomies, true ) ) return $terms;
	if ( ! is_array( $terms ) ) return $terms;

	$order = array_flip( array(
		'北海道',
		'青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
		'茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
		'新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県',
		'三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県',
		'鳥取県', '島根県', '岡山県', '広島県', '山口県',
		'徳島県', '香川県', '愛媛県', '高知県',
		'福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県',
	) );

	if ( ! isset( $terms[0] ) || ! is_object( $terms[0] ) ) return $terms;

	usort( $terms, function( $a, $b ) use ( $order ) {
		$pos_a = isset( $order[ $a->name ] ) ? $order[ $a->name ] : 999;
		$pos_b = isset( $order[ $b->name ] ) ? $order[ $b->name ] : 999;
		return $pos_a - $pos_b;
	} );

	return $terms;
}, 10, 3 );

/**
 * 地域タームを都道府県順で返す
 */
function homecareer_get_area_terms( $args = array() ) {
	$terms = get_terms( array_merge( array( 'taxonomy' => 'area', 'hide_empty' => false ), $args ) );
	if ( is_wp_error( $terms ) ) return array();

	return $terms;
}

/**
 * 求人アーカイブの検索フィルター処理
 */
function homecareer_job_search_filter( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( ! $query->is_post_type_archive( 'job' ) && ! $query->is_search() ) {
		return;
	}

	if ( $query->is_search() ) {
		$query->set( 'post_type', 'job' );
	}

	$tax_query = array();

	$employment_type = isset( $_GET['employment_type'] ) ? sanitize_text_field( $_GET['employment_type'] ) : '';
	$job_type        = isset( $_GET['job_type'] ) ? sanitize_text_field( $_GET['job_type'] ) : '';
	$area            = isset( $_GET['area'] ) ? sanitize_text_field( $_GET['area'] ) : '';

	if ( $employment_type ) {
		$tax_query[] = array(
			'taxonomy' => 'employment_type',
			'field'    => 'slug',
			'terms'    => $employment_type,
		);
	}

	if ( $job_type ) {
		$tax_query[] = array(
			'taxonomy' => 'job_type',
			'field'    => 'slug',
			'terms'    => $job_type,
		);
	}

	if ( $area ) {
		$tax_query[] = array(
			'taxonomy' => 'area',
			'field'    => 'slug',
			'terms'    => $area,
		);
	}

	$video_category = isset( $_GET['video_category'] ) ? sanitize_text_field( $_GET['video_category'] ) : '';
	if ( $video_category ) {
		$tax_query[] = array(
			'taxonomy' => 'video_category',
			'field'    => 'slug',
			'terms'    => $video_category,
		);
	}

	if ( ! empty( $tax_query ) ) {
		$query->set( 'tax_query', $tax_query );
	}

	$keyword = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
	if ( $keyword ) {
		$query->set( 's', $keyword );
	}

	$orderby = isset( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : '';
	if ( $orderby === 'new' ) {
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'DESC' );
	}

	$recommended = isset( $_GET['recommended'] ) ? sanitize_text_field( $_GET['recommended'] ) : '';
	if ( $recommended === '1' ) {
		$query->set( 'meta_query', array(
			array(
				'key'     => 'is_recommended',
				'value'   => '1',
				'compare' => '=',
			),
		) );
	}
}
add_action( 'pre_get_posts', 'homecareer_job_search_filter' );

