<?php
/**
 * Halle Theme Customizer.
 *
 * @package Halle
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function halle_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'header_bgcolor', array(
		'default' => null,
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bgcolor', array(
		'label' => __( 'Header Background Color', 'halle' ),
		'section' => 'colors',
		'settings' => 'header_bgcolor',
	) ) );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_bgcolor' )->transport   = 'postMessage';
}
add_action( 'customize_register', 'halle_customize_register' );

/**
 * Add custom logo field to customizer, replaces site title in header.
 */
function halle_site_logo() {
	$defaults = array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'halle_site_logo' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function halle_customize_preview_js() {
	wp_enqueue_script( 'halle_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'halle_customize_preview_js' );
