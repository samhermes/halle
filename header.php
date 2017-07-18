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

	<?php if ( get_header_image() ) :
		$header_background = get_header_image();
		$header_style = ' style="background-image:url(' . $header_background . ');"';
	endif; ?>

	<header id="masthead" class="site-header" role="banner"<?php echo $header_style; ?>>
		<div class="site-branding">
			<?php
			if ( get_theme_mod( 'harper_logo' ) ) : ?>
				<div class='site-logo'>
					<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img class="site-logo-image" src='<?php echo esc_url( get_theme_mod( 'harper_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
				</div>
			<?php else :
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
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'harper' ); ?></button>
		
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		
		<button class="search-toggle">
			<img src="<?php echo get_template_directory_uri() . '/img/search.svg'; ?>" alt="Search">
		</button>
	</nav>

	<div class="search-overlay">
		<?php get_search_form(); ?>
	</div>

	<div id="content" class="site-content">
