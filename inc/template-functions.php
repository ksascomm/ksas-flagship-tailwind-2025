<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Flagship_Tailwind
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function flagship_tailwind_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'flagship_tailwind_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function flagship_tailwind_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'flagship_tailwind_pingback_header' );

/**
 * Adds the 'news-post' CSS class to the HTML body tag on single post views.
 *
 * This function checks if the current page is a single post (and the post type
 * is 'post'). If true, it appends the 'news-post' class to the array of body classes.
 * It is hooked into the 'body_class' filter.
 *
 * @param array $classes An array of body classes.
 * @return array The filtered array of body classes.
 */
function add_news_post_body_class( $classes ) {
	if ( is_single() && 'post' === get_post_type() ) {
		$classes[] = 'news-post';
	}
	return $classes;
}
add_filter( 'body_class', 'add_news_post_body_class' );
