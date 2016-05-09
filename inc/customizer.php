<?php
/**
 * _businessportfolio Theme Customizer.
 *
 * @package _businessportfolio
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function _businessportfolio_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', '_businessportfolio_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _businessportfolio_customize_preview_js() {
	wp_enqueue_script( '_businessportfolio_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', '_businessportfolio_customize_preview_js' );

/**
 * Add the theme configuration
 */
_businessportfolio_Kirki::add_config( '_businessportfolio_theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add the typography section
 */
_businessportfolio_Kirki::add_section( 'typography', array(
	'title'      => esc_attr__( 'Typography', 'businessportfolio' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_customization',
) );

/**
 * Add the body-typography control
 */
_businessportfolio_Kirki::add_field( '_businessportfolio_theme', array(
	'type'        => 'typography',
	'settings'    => 'body_typography',
	'label'       => esc_attr__( 'Body Typography', 'businessportfolio' ),
	'description' => esc_attr__( 'Select the main typography options for your site.', 'businessportfolio' ),
	'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'businessportfolio' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '400',
		'font-size'      => '16px',
		'line-height'    => '1.5',
		// 'letter-spacing' => '0',
		'color'          => '#fff',
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
_businessportfolio_Kirki::add_field( '_businessportfolio_theme', array(
	'type'        => 'typography',
	'settings'    => 'headers_typography',
	'label'       => esc_attr__( 'Headers Typography', 'businessportfolio' ),
	'description' => esc_attr__( 'Select the typography options for your headers.', 'businessportfolio' ),
	'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'businessportfolio' ),
	'section'     => 'theme_customization',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '400',
		// 'font-size'      => '16px',
		// 'line-height'    => '1.5',
		// 'letter-spacing' => '0',
	 'color'          => '#fff',
	),
	'output' => array(
		array(
			'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6' ),
		),
	),
) );

_businessportfolio_Kirki::add_panel( 'theme_customization', array(
    'priority'    => 10,
    'title'       => __( 'Theme Customization', 'businessportfolio' ),
    'description' => __( 'Add various theme customization', 'businessportfolio' ),
) );

_businessportfolio_Kirki::add_section( 'theme_whitelabel', array(
    'title'          => __( 'Admin White Label' ),
    'description'    => __( 'Customize your admin' ),
    'panel'          => 'theme_customization',
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

Kirki::add_field( 'use_logo_in_admin_login', array(
	'type'        => 'toggle',
	'settings'    => 'use_logo_in_admin_login',
	'label'    => __( 'Use Logo in admin Login & hide WP logo', 'businessportfolio' ),
	'section'     => 'theme_whitelabel',
	'default'     => '1',
	'priority'    => 10,
) );

_businessportfolio_Kirki::add_field( 'admin_footer_text_replace', array(
	'settings' => 'admin_footer_text_replace',
	'label'    => __( 'Replace Admin Text', 'businessportfolio' ),
	'section'  => 'theme_whitelabel',
	'type'     => 'text',
	'priority' => 12,
	'default'  => 'Business Portfolio Theme',
) );

_businessportfolio_Kirki::add_section( 'bootstrap_settings', array(
    'title'          => __( 'Bootstrap Settings' ),
    'panel'          => 'theme_customization',
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

Kirki::add_field( 'fluid_toggle', array(
	'type'        => 'toggle',
	'settings'    => 'fluid_toggle',
	'label'    => __( 'Turns on full width', 'businessportfolio' ),
	'section'     => 'bootstrap_settings',
	'default'     => '1',
	'priority'    => 10,
) );

Kirki::add_field( 'fluid_toggle', array(
	'type'        => 'toggle',
	'settings'    => 'fluid_toggle',
	'label'    => __( 'Turns on full width', 'businessportfolio' ),
	'section'     => 'bootstrap_settings',
	'default'     => '1',
	'priority'    => 10,
) );

Kirki::add_field( 'logo_align', array(
	'type'        => 'radio',
	'settings'    => 'logo_align',
	'label'       => __( 'Logo Alignment', 'businessportfolio' ),
	'section'     => 'bootstrap_settings',
	'default'     => 'left',
	'priority'    => 15,
	'choices'     => array(
		'left'   => 'left',
		'center' => 'center',
		'right'  => 'right',
	),
) );

_businessportfolio_Kirki::add_section( 'social_links', array(
    'title'          => __( 'Social Links' ),
    'panel'          => 'theme_customization',
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

_businessportfolio_Kirki::add_field( 'social_links', array(
	'settings' => 'social_link_fb',
	'label'    => __( 'Facebook', 'businessportfolio' ),
	'section'  => 'social_links',
	'type'     => 'text',
	'priority' => 10,
	'default'  => 'twitter.com',
) );

_businessportfolio_Kirki::add_field( 'social_links', array(
	'settings' => 'social_link_twitter',
	'label'    => __( 'Twitter', 'businessportfolio' ),
	'section'  => 'social_links',
	'type'     => 'text',
	'priority' => 10,
	'default'  => 'fb.com',
) );
