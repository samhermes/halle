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

	/*
	 * Add custom image size for posts on homepage and archive pages.
	 */
	add_image_size( 'post-3x2', 1500, 1000, true );
	add_image_size( 'post-3x2-small', 750, 500, true );

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
}
endif;
add_action( 'after_setup_theme', 'harper_setup' );

/*
 * Register sidebar for the site footer.
 */
function harper_footer_widget_area() {
	register_sidebar( array(
		'name' => __( 'Footer', 'harper' ),
		'id' => 'footer',
		'description' => __( 'Widgets in this area will be shown in the site footer.', 'harper' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'harper_footer_widget_area' );

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
	wp_enqueue_style( 'harper-work-sans', 'https://fonts.googleapis.com/css?family=Work+Sans:400,500,700|Poly:400,400i' );
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
 * Add editor styles.
 */
function harper_editor_styles() {
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Work+Sans:400,500,700|Poly:400,400i' );
    add_editor_style( $font_url );
    add_editor_style();
}
add_action( 'after_setup_theme', 'harper_editor_styles' );

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
    __( 'Read more', 'harper' )
  );
}
add_filter( 'excerpt_more', 'harper_excerpt_more' );

/**
 * Add class to the_excerpt.
 */
function harper_excerpt_class( $excerpt ) {
	return str_replace( '<p', '<p class="entry-excerpt"', $excerpt );
}
add_action( 'the_excerpt', 'harper_excerpt_class' );

/**
 * Determine which stories to feature on homepage.
 */
function get_featured_stories() {
	global $post;
	$featured_stories = array();

	$args = array(
		'posts_per_page' => 4,
		'meta_query' => array(
			array(
				'key' => '_thumbnail_id'
			)
		),
	);
	$featured_query = new WP_Query($args);
	while ( $featured_query->have_posts() ) : $featured_query->the_post();
        $featured_stories[] = $post->ID;
    endwhile;

    return $featured_stories;
}

/**
 * Set global variable with IDs of featured posts
 */
global $harper_featured_ids;
$harper_featured_ids = get_featured_stories();

/**
 * Remove featured stories from homepage query.
 */
function remove_featured_from_query( $query ) {
	global $harper_featured_ids;
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'post__not_in', $harper_featured_ids );
	}
}
add_action('pre_get_posts', 'remove_featured_from_query');
