<?php
/**
 * mitlib-courtyard Theme Customizer.
 *
 * @package mitlib-courtyard
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function courtyard_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Implements ability to hide navbar.
	$wp_customize->add_section('navbar_section', array(
		'title' => 'Navbar',
	));

	$wp_customize->add_setting( 'hide_nav', array(
		'type' => 'theme_mod',
	));
	$wp_customize->add_control( 'hide_nav', array(
		'type' => 'checkbox',
		'priority' => '10',
		'section' => 'navbar_section',
		'label' => __( 'Hide navbar' ),
	));
}
add_action( 'customize_register', 'courtyard_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function courtyard_customize_preview_js() {
	wp_enqueue_script( 'courtyard_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'courtyard_customize_preview_js' );
