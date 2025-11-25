<?php
/**
 * Flagship Tailwind Theme Customizer
 *
 * @package Flagship_Tailwind
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function flagship_tailwind_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'flagship_tailwind_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'flagship_tailwind_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'flagship_tailwind_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function flagship_tailwind_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function flagship_tailwind_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flagship_tailwind_customize_preview_js() {
	wp_enqueue_script( 'flagship-tailwind-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), FLAGSHIP_TAILWIND_VERSION, true );
}
add_action( 'customize_preview_init', 'flagship_tailwind_customize_preview_js' );

/** Minify the customizer css output */
add_action( 'wp_head', 'minify_customizer_css_head' );
function minify_customizer_css_head() {

	remove_action( 'wp_head', 'wp_custom_css_cb', 101 ); // remove the default customizer css output.

	$buffer = wp_get_custom_css(); // get the customizer css.

	// search and replace strings.
	$buffer = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer );
	$buffer = str_replace( ': ', ':', $buffer );
	$buffer = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $buffer );

	// add the minified css in wp_head.
	echo '<style id="wp-custom-css">' . esc_html( $buffer ) . '</style>';
}
