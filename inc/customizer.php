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
}
add_action( 'customize_register', 'harper_customize_register' );

/**
 * Add custom logo field to customizer, replaces site title in header.
 */
function harper_site_logo() {
	$defaults = array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'harper_site_logo' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function harper_customize_preview_js() {
	wp_enqueue_script( 'harper_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'harper_customize_preview_js' );
