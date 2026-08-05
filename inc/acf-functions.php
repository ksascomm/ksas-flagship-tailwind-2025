<?php
/**
 * Custom functions using ACF (Advanced Custom Fields) for the Flagship Tailwind theme.
 *
 * @package Flagship_Tailwind
 */

/**
 * ACF Options Page
 */

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

}

/**
 * Minify page/post specific Custom CSS from ACF.
 *
 * @param string $custom_page_css Raw CSS string from ACF field.
 * @return string Minified CSS string or empty string if invalid.
 */
function minify_custom_page_css( $custom_page_css ) {
	if ( empty( $custom_page_css ) || ! is_string( $custom_page_css ) ) {
		return ''; // Return empty string if null or not a string.
	}

	// Remove comments.
	$custom_page_css = preg_replace( '!/\*.*?\*/!s', '', $custom_page_css );

	// Remove whitespace and newlines.
	$custom_page_css = preg_replace( '/\s+/', ' ', $custom_page_css );

	// Remove space around symbols.
	$custom_page_css = preg_replace( '/\s*([{};:,])\s*/', '$1', $custom_page_css );

	// Remove trailing semicolons in blocks.
	$custom_page_css = preg_replace( '/;}/', '}', $custom_page_css );

	// Trim final output.
	return trim( $custom_page_css );
}

/**
 * Add page/post specific Custom CSS from ACF.
 * * This function retrieves custom CSS from an ACF field, minifies it,
 * and outputs it in the site head using proper WordPress escaping.
 */
function add_custom_css_from_field() {
	// Ensure it only runs on singular pages/posts.
	if ( is_singular() ) {
		// Use get_field instead of the_field to control the output.
		$custom_css = function_exists( 'get_field' ) ? get_field( 'custom_page_css' ) : '';

		if ( ! empty( $custom_css ) ) {
			// We wrap the output in wp_kses with an empty array.
			// This tells PHPCS that we have explicitly escaped the output
			// by stripping all HTML tags.
			echo '<style id="custom-page-css-acf">' . wp_kses( minify_custom_page_css( $custom_css ), array() ) . '</style>';
		}
	}
}
add_action( 'wp_head', 'add_custom_css_from_field' );
