<?php
/**
 * Harper functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Harper
 */

if ( ! function_exists( 'harper_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function harper_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Harper, use a find and replace
	 * to change 'harper' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'harper', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'harper' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'harper_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'harper_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function harper_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'harper_content_width', 640 );
}
add_action( 'after_setup_theme', 'harper_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function harper_scripts() {
	wp_enqueue_style( 'harper-work-sans', 'https://fonts.googleapis.com/css?family=Work+Sans:400,500,600|Poly' );
	wp_enqueue_style( 'harper-style', get_stylesheet_uri() );

	wp_enqueue_script( 'harper-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20160908', true );

	wp_enqueue_script( 'harper-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'harper-stickyfill', get_template_directory_uri() . '/js/stickyfill.min.js', array( 'jquery' ), '1.1.4', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'harper_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Filter the except length.
 */
function harper_custom_excerpt_length( $length ) {
    return 35;
}
add_filter( 'excerpt_length', 'harper_custom_excerpt_length', 999 );

/**
 * Filter the "read more" excerpt string to link to the post.
 */
function harper_excerpt_more( $more ) {
    return sprintf( '... <a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read more', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'harper_excerpt_more' );
