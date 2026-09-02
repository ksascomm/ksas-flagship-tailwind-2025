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
		return '';
	}

	// Remove comments.
	$custom_page_css = preg_replace( '!/\*.*?\*/!s', '', $custom_page_css );

	// Remove whitespace and newlines.
	$custom_page_css = preg_replace( '/\s+/', ' ', $custom_page_css );

	// Remove space around symbols.
	$custom_page_css = preg_replace( '/\s*([{};:,])\s*/', '$1', $custom_page_css );

	// Remove trailing semicolons in blocks.
	$custom_page_css = preg_replace( '/;}/', '}', $custom_page_css );

	return trim( $custom_page_css );
}

/**
 * Output page/post dynamic ACF CSS.
 * Targets Front-end (wp_head) and Block Editor iframe canvas (enqueue_block_assets).
 */
function add_custom_css_from_field() {
	$post_id = false;

	if ( is_admin() ) {
		// Handle Gutenberg iframe editor post detection
		if ( isset( $_GET['post'] ) ) {
			$post_id = (int) $_GET['post'];
		} elseif ( isset( $_POST['post_id'] ) ) {
			$post_id = (int) $_POST['post_id'];
		}
	} elseif ( is_singular() ) {
		$post_id = get_the_ID();

		if ( is_preview() ) {
			$preview_id = wp_get_post_autosave( $post_id );
			if ( $preview_id ) {
				$post_id = $preview_id->ID;
			}
		}
	}

	if ( ! $post_id || ! function_exists( 'get_field' ) ) {
		return;
	}

	$custom_css = get_field( 'custom_page_css', $post_id );

	if ( ! empty( $custom_css ) ) {
		$minified_css = minify_custom_page_css( $custom_css );
		// Use wp_strip_all_tags() or esc_html() to prevent stripping CSS rules while removing HTML tags
		echo '<style id="custom-page-css-acf">' . wp_strip_all_tags( $minified_css ) . '</style>' . "\n";
	}
}
// Outputs CSS on front-end
add_action( 'wp_head', 'add_custom_css_from_field' );

// Injects CSS directly into the Gutenberg editor iframe
add_action( 'enqueue_block_assets', 'add_custom_css_from_field' );

/**
 * Enqueue JavaScript bridge for live updating ACF CSS in the Block Editor.
 */
function enqueue_acf_live_css_script() {
	$script_path = get_stylesheet_directory() . '/dist/js/live-acf-css.js';

	if ( file_exists( $script_path ) ) {
		wp_enqueue_script(
			'acf-live-css',
			get_stylesheet_directory_uri() . '/dist/js/live-acf-css.js',
			array( 'wp-blocks', 'wp-data', 'wp-dom-ready', 'wp-edit-post' ),
			filemtime( $script_path ),
			true
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'enqueue_acf_live_css_script' );
