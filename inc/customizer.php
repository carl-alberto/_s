<?php
/**
 * _s Theme Customizer.
 *
 * @package _s
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function _s_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', '_s_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', '_s_customize_preview_js' );

/**
 * Add the theme configuration
 */
_s_Kirki::add_config( '_s_theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add the typography section
 */
_s_Kirki::add_section( 'typography', array(
	'title'      => esc_attr__( 'Typography', '_s' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
) );

/**
 * Add the body-typography control
 */
_s_Kirki::add_field( '_s_theme', array(
	'type'        => 'typography',
	'settings'    => 'body_typography',
	'label'       => esc_attr__( 'Body Typography', '_s' ),
	'description' => esc_attr__( 'Select the main typography options for your site.', '_s' ),
	'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', '_s' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '400',
		'font-size'      => '16px',
		'line-height'    => '1.5',
		// 'letter-spacing' => '0',
		'color'          => '#333333',
	),
	'output' => array(
		array(
			'element' => 'body',
		),
	),
) );

/**
 * Add the body-typography control
 */
_s_Kirki::add_field( '_s_theme', array(
	'type'        => 'typography',
	'settings'    => 'headers_typography',
	'label'       => esc_attr__( 'Headers Typography', '_s' ),
	'description' => esc_attr__( 'Select the typography options for your headers.', '_s' ),
	'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', '_s' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '400',
		// 'font-size'      => '16px',
		// 'line-height'    => '1.5',
		// 'letter-spacing' => '0',
		// 'color'          => '#333333',
	),
	'output' => array(
		array(
			'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6' ),
		),
	),
) );