<?php
/**
 * Custom functions for the block editor
 *
 * @package Flagship_Tailwind
 * @since  Flagship_Tailwind 1.2.0
 */

/** Disable custom colors & font sizes. Allow align-wide */
function ksas_disable_gutenberg_colour_settings() {
	// Disable custom colors.
	add_theme_support( 'disable-custom-colors' );
	// Add foundation color palette to the editor.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Heritage Blue', 'flagship-tailwind' ),
				'slug'  => 'heritage-blue',
				'color' => '#002d72',
			),
			array(
				'name'  => __( 'Medium Blue', 'flagship-tailwind' ),
				'slug'  => 'medium-blue',
				'color' => '#0077d8',
			),
			array(
				'name'  => __( 'SAIS Blue', 'flagship-tailwind' ),
				'slug'  => 'sais-blue',
				'color' => '#005EB8',
			),
			array(
				'name'  => __( 'Spirit Blue', 'flagship-tailwind' ),
				'slug'  => 'spirit-blue',
				'color' => '#68ace5',
			),
			array(
				'name'  => __( 'Grey', 'flagship-tailwind' ),
				'slug'  => 'grey',
				'color' => '#e5e2e0',
			),
			array(
				'name'  => __( 'Cool Grey', 'flagship-tailwind' ),
				'slug'  => 'cool',
				'color' => '#bfccd9',
			),
			array(
				'name'  => __( 'Purple', 'flagship-tailwind' ),
				'slug'  => 'purple',
				'color' => '#A45C98',
			),
			array(
				'name'  => __( 'Plum', 'flagship-tailwind' ),
				'slug'  => 'plum',
				'color' => '#51284F',
			),
			array(
				'name'  => __( 'Mint Green', 'flagship-tailwind' ),
				'slug'  => 'mint-green',
				'color' => '#86C8BC',
			),
			array(
				'name'  => __( 'Homewood Green', 'flagship-tailwind' ),
				'slug'  => 'homewood-green',
				'color' => '#008767',
			),
			array(
				'name'  => __( 'Black', 'flagship-tailwind' ),
				'slug'  => 'black',
				'color' => '#31261D',
			),
			array(
				'name'  => __( 'White', 'flagship-tailwind' ),
				'slug'  => 'white',
				'color' => '#fefefe',
			),
		)
	);

	// Set normal font size.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => __( 'Normal', 'ksasacademic' ),
				'shortName' => __( 'N', 'ksasacademic' ),
				'size'      => 18,
				'slug'      => 'normal',
			),
		)
	);

	// Disable custom font sizing.
	add_theme_support( 'disable-custom-font-sizes' );

	// Enable widge alignments.
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'ksas_disable_gutenberg_colour_settings' );

/**
 * Load Gutenberg Editor Assets from /dist/
 */
function custom_gutenberg_assets() {
	// Compiled editor JavaScript.
	wp_enqueue_script(
		'custom-editor',
		get_stylesheet_directory_uri() . '/dist/js/editor.js',
		array( 'wp-blocks', 'wp-dom', 'wp-edit-post' ),
		filemtime( get_stylesheet_directory() . '/dist/js/editor.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'custom_gutenberg_assets' );

/**
 * Load external JHU fonts directly into both frontend and Gutenberg Block Editor iframe.
 */
function flagship_tailwind_enqueue_block_fonts() {
	wp_enqueue_style(
		'jhu-hopkins-slab',
		'https://assets.jhu.edu/fonts/latest/hopkins-slab/hopkins-slab.css',
		array(),
		null
	);

	wp_enqueue_style(
		'jhu-work-sans',
		'https://assets.jhu.edu/fonts/latest/work-sans/work-sans.css',
		array(),
		null
	);
}
// 'enqueue_block_assets' loads styles in both the frontend and the block editor canvas
add_action( 'enqueue_block_assets', 'flagship_tailwind_enqueue_block_fonts' );

/**
 * Keep editor-styles for your compiled local Tailwind editor stylesheet.
 */
function custom_gutenberg_editor_styles() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'dist/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'custom_gutenberg_editor_styles' );

add_filter( 'wp_kses_allowed_html', 'allow_script_tags_for_administrators_only', 10, 2 );

/**
 * Allows administrators to save script tags in post meta and ACF contexts.
 *
 * @param array  $allowed_tags Allowed tags and attributes.
 * @param string $context      The context where sanitization is happening.
 * @return array Filtered allowed tags and attributes.
 */
function allow_script_tags_for_administrators_only( $allowed_tags, $context ) {
	// Check if the current user is an Administrator.
	if ( current_user_can( 'manage_options' ) ) {
		// Apply allowed script tags specifically during post/meta saving or ACF contexts.
		if ( 'post' === $context || 'pre_safe_post' === $context || 'acf' === $context ) {
			$allowed_tags['script'] = array(
				'type'  => true,
				'src'   => true,
				'defer' => true,
				'async' => true,
			);
		}
	}

	return $allowed_tags;
}
