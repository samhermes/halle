<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Harper
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'harper' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
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
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'harper' ); ?></button>
		
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		
		<button class="search-toggle">
			<svg xmlns="http://www.w3.org/2000/svg" width="42.8" height="42.8" viewBox="0 0 42.8 42.8"><path fill="#FFF" d="M16.7 32C8.3 32 1.5 25.1 1.5 16.7S8.3 1.5 16.7 1.5C25.1 1.5 32 8.3 32 16.7 32 25.1 25.1 32 16.7 32z"/><path d="M16.7 3c7.6 0 13.7 6.2 13.7 13.7s-6.2 13.7-13.7 13.7S3 24.3 3 16.7 9.2 3 16.7 3m0-3C7.5 0 0 7.5 0 16.7s7.5 16.7 16.7 16.7S33.5 26 33.5 16.7 26 0 16.7 0z"/><path fill="none" stroke="#000" stroke-width="3" stroke-miterlimit="10" d="M27.9 27.9l13.8 13.8"/></svg>
		</button>
	</nav>


	<div id="content" class="site-content">
