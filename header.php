<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Halle
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'halle' ); ?></a>

	<?php
	$header_style = '';
	if ( get_header_image() ) :
		$header_background = get_header_image();
		$header_style = ' style="background-image:url(' . esc_url( $header_background ) . ');"';
	endif; ?>

	<header id="masthead" class="site-header" role="banner"<?php echo $header_style; ?>>
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) :
				the_custom_logo();
			else :
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; ?></p>
			<?php
			endif; ?>
		</div>
	</header>

	<?php
		$sticky_header_class = '';
		if ( ! is_admin_bar_showing() ) {
			$sticky_header_class = ' stick';
		}
	?>

	<nav id="site-navigation" class="main-navigation<?php echo $sticky_header_class; ?>" role="navigation">
		<button type="button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'halle' ); ?></button>
		
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'depth' => 1 ) ); ?>
		
		<button type="button" class="search-toggle">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/img/search.svg' ); ?>" alt="">
			<span class="screen-reader-text"><?php esc_html_e( 'Search', 'halle' ); ?></span>
		</button>
	</nav>

	<div class="search-overlay">
		<?php get_search_form(); ?>
		<button type="button" class="search-close">
			<span class="screen-reader-text"><?php esc_html_e( 'Close search', 'halle' ); ?></span>
		</button>
	</div>

	<div id="content" class="site-content">
