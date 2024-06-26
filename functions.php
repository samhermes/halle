<?php
/**
 * Halle functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Halle
 */

if ( ! function_exists( 'halle_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function halle_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Halle, use a find and replace
		* to change 'halle' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'halle', get_template_directory() . '/languages' );

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
		add_image_size( 'halle-post-3x2', 1500, 1000, true );
		add_image_size( 'halle-post-3x2-small', 750, 500, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'halle' ),
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
			)
		);

		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'halle' ),
					'shortName' => __( 'S', 'halle' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'halle' ),
					'shortName' => __( 'M', 'halle' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'halle' ),
					'shortName' => __( 'L', 'halle' ),
					'size'      => 30,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'halle' ),
					'shortName' => __( 'XL', 'halle' ),
					'size'      => 40,
					'slug'      => 'huge',
				),
			)
		);

		add_theme_support( 'editor-styles' );

		/**
		 * Add support for wide and full block alignments.
		 */
		add_theme_support( 'align-wide' );

		/**
		 * Add support for responsive embeds.
		 */
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'halle_setup' );

/**
 * Register sidebar for the site footer.
 */
function halle_footer_widget_area() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'halle' ),
			'id'            => 'footer',
			'description'   => __( 'Widgets in this area will be shown in the site footer.', 'halle' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'halle_footer_widget_area' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function halle_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'halle_content_width', 640 );
}
add_action( 'after_setup_theme', 'halle_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function halle_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'halle-style', get_stylesheet_uri(), array(), $theme_version );

	wp_enqueue_script( 'halle-scripts', get_template_directory_uri() . '/js/scripts.js', array(), $theme_version, true );

	wp_localize_script(
		'halle-scripts',
		'halleL10n',
		array(
			'menu'          => esc_html__( 'Menu', 'halle' ),
			'close'         => esc_html__( 'Close', 'halle' ),
			'comments_show' => esc_html__( 'Show Comments', 'halle' ),
			'comments_hide' => esc_html__( 'Hide Comments', 'halle' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'halle_scripts' );

/**
 * Add editor styles.
 */
function halle_editor_styles() {
	add_editor_style( 'https://fonts.googleapis.com/css?family=Work+Sans:400,500,700|Poly:400,400i' );
	add_editor_style();
}
add_action( 'after_setup_theme', 'halle_editor_styles' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function halle_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'halle_pingback_header' );

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
 *
 * @param integer $length Excerpt length.
 */
function halle_custom_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 35;
}
add_filter( 'excerpt_length', 'halle_custom_excerpt_length', 999 );

/**
 * Filter the "read more" excerpt string to link to the post.
 *
 * @param string $more Read more anchor tag.
 */
function halle_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return sprintf(
		'... <a class="read-more" href="%1$s">%2$s %3$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		__( 'Read more', 'halle' ),
		'<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
	);
}
add_filter( 'excerpt_more', 'halle_excerpt_more' );

/**
 * Add class to the_excerpt.
 *
 * @param string $excerpt Excerpt tag.
 */
function halle_excerpt_class( $excerpt ) {
	return str_replace( '<p', '<p class="entry-excerpt"', $excerpt );
}
add_action( 'the_excerpt', 'halle_excerpt_class' );

/**
 * Set up arguments for featured stories.
 */
function halle_get_featured_args() {
	$featured_category_id = get_cat_ID( 'Featured' );

	if ( $featured_category_id && get_category( $featured_category_id )->category_count > 3 ) {
		$args = array(
			'posts_per_page'      => 4,
			'meta_query'          => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key' => '_thumbnail_id',
				),
			),
			'ignore_sticky_posts' => 1,
			'cat'                 => $featured_category_id,
		);
	} else {
		$args = array(
			'posts_per_page'      => 4,
			'meta_query'          => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key' => '_thumbnail_id',
				),
			),
			'ignore_sticky_posts' => 1,
		);
	}

	return $args;
}

/**
 * Determine which stories to feature on homepage.
 */
function halle_get_featured_stories() {
	global $post;
	$featured_stories = array();
	$featured_query   = new WP_Query( halle_get_featured_args() );

	while ( $featured_query->have_posts() ) :
		$featured_query->the_post();

		$featured_stories[] = $post->ID;
	endwhile;

	wp_reset_postdata();

	return $featured_stories;
}

/**
 * Set global variable with IDs of featured posts
 */
global $halle_featured_ids;
$halle_featured_ids = halle_get_featured_stories();

/**
 * Remove featured stories from homepage query.
 *
 * @param WP_Query $query Query object.
 */
function halle_remove_featured_from_query( $query ) {
	global $halle_featured_ids;
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'post__not_in', $halle_featured_ids );
	}
}
add_action( 'pre_get_posts', 'halle_remove_featured_from_query' );
