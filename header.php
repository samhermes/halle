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
			<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44"><path d="M32.1 26.8c1.7-2.7 2.7-5.9 2.7-9.4C34.9 7.8 27.1 0 17.4 0 7.8 0 0 7.8 0 17.5S7.8 35 17.4 35c3.5 0 6.7-1 9.5-2.8l.8-.5L40.1 44l3.9-3.9-12.4-12.5.5-.8zM27.2 7.7c2.6 2.6 4 6.1 4 9.7s-1.4 7.1-4 9.7-6.1 4-9.7 4-7.1-1.4-9.7-4-4-6.1-4-9.7 1.4-7.1 4-9.7 6.1-4 9.7-4 7.1 1.4 9.7 4z"/></svg>
		</button>
	</nav>


	<div id="content" class="site-content">
