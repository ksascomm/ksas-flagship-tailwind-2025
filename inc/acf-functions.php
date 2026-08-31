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
 * Works for published pages, drafts, and published previews.
 */
function add_custom_css_from_field() {
	if ( is_singular() ) {
		// Get the current post ID (handles standard posts & drafts).
		$post_id = get_the_ID();

		// If previewing a published post revision, get the revision ID instead.
		if ( is_preview() ) {
			$preview_id = wp_get_post_autosave( $post_id );
			if ( $preview_id ) {
				$post_id = $preview_id->ID;
			}
		}

		// Pass the explicit $post_id to ACF.
		$custom_css = function_exists( 'get_field' ) ? get_field( 'custom_page_css', $post_id ) : '';

		if ( ! empty( $custom_css ) ) {
			echo '<style id="custom-page-css-acf">' . wp_kses( minify_custom_page_css( $custom_css ), array() ) . '</style>';
		}
	}
}
add_action( 'wp_head', 'add_custom_css_from_field' );
