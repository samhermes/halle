<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Halle
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses halle_header_style()
 */
function halle_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'halle_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '404040',
				'width'              => 1400,
				'height'             => 200,
				'flex-height'        => true,
				'wp-head-callback'   => 'halle_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'halle_custom_header_setup' );

if ( ! function_exists( 'halle_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see halle_custom_header_setup().
	 */
	function halle_header_style() {
		$header_text_color       = get_header_textcolor();
		$header_background_color = get_option( 'header_bgcolor' );

		/*
		* If no custom options for text are set, let's bail.
		* get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		*/
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		<?php if ( $header_background_color ) { ?>
			.site-header {
				background-color: <?php echo esc_attr( $header_background_color ); ?>;
				border-bottom: none;
			}
		<?php } ?>
		</style>
		<?php
	}
endif;
