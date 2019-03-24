<?php
/**
 * Understrap Theme Customizer
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'understrap_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function understrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'understrap_customize_register' );

if ( ! function_exists( 'understrap_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function understrap_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'ehri_theme_layout_options',
			array(
				'title' => __( 'Theme Layout Settings' ),
				'capability' => 'edit_theme_options',
				'description' => __( 'EHRI theme layout settings' ),
				'priority' => 160,
			)
		);

		$wp_customize->add_setting(
			'ehri_header_image',
			array(
				'default' => 'TODO',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'ehri_header_image',
				array(
					'label' => __( 'Hero header image', 'ehri' ),
					'description' => __( 'Choose a hero image for the front page', 'ehri' ),
					'section' => 'ehri_theme_layout_options',
					'settings' => 'ehri_header_image',
					'type' => 'input',
					'priority' => '10',
				)
			)
		);
	}
} // endif function_exists( 'understrap_theme_customize_register' ).
add_action( 'customize_register', 'understrap_theme_customize_register' );

if ( ! function_exists( 'ehri_theme_customize_register' ) ) {
	function ehri_theme_customize_register( $wp_customize ) {
		$wp_customize->add_section(
			'ehri_theme_footer_options',
			array(
				'title' => __( 'Theme Footer Settings' ),
				'capability' => 'edit_theme_options',
				'description' => __( 'EHRI theme footer settings' ),
				'priority' => 170,
			)
		);

		$wp_customize->add_setting(
			'ehri_mailinglist_url',
			array(
				'default' => '',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'ehri_mailinglist_url',
				array(
					'label' => __( 'Mailing List URL', 'ehri' ),
					'description' => __( 'Set the URL for signing up to the mailing list', 'ehri' ),
					'section' => 'ehri_theme_footer_options',
					'settings' => 'ehri_mailinglist_url',
					'type' => 'input',
					'priority' => '10',
				)

			)
		);
	}
}

add_action( 'customize_register', 'ehri_theme_customize_register' );
