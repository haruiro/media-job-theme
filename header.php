<?php
/**
 * The header for our theme
 *
 * @package media-job-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class( is_page() ? 'page-' . get_post_field( 'post_name', get_queried_object_id() ) : '' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="site-header__inner">

			<!-- ロゴ -->
			<div class="site-header__logo">
				<?php
				if ( has_custom_logo() ) :
					the_custom_logo();
				else :
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- ナビゲーション -->
			<nav id="site-navigation" class="site-header__nav" data-nav>
        <div class="sp-only site-header__logo-sp">
          <?php
          if ( has_custom_logo() ) :
            the_custom_logo();
          endif; ?>
        </div>

        <?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'site-header__menu',
					)
				);
				?>
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--main">
					求人広告掲載
				</a>
			</nav>

			<!-- ハンバーガーメニュー（SP用） -->
			<button class="menu-toggle" data-menu-toggle aria-controls="primary-menu" aria-expanded="false">
				<span></span>
				<span></span>
				<span></span>
			</button>

		</div><!-- .site-header__inner -->
	</header><!-- #masthead -->
