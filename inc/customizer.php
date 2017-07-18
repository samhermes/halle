<?php
/**
 * Harper Theme Customizer.
 *
 * @package Harper
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function harper_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->remove_control( 'display_header_text' );

	// Add field that accepts an image file to replace the site title in header
	$wp_customize->add_setting( 'harper_logo' );

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		$wp_customize,
			'harper_logo',
			array(
				'label'      => __( 'Site Logo', 'harper' ),
				'description' => 'Replaces the site title in the header with an image.',
				'section'    => 'title_tagline',
				'settings'   => 'harper_logo',
			)
		)
	);
}
add_action( 'customize_register', 'harper_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function harper_customize_preview_js() {
	wp_enqueue_script( 'harper_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'harper_customize_preview_js' );
