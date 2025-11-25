<?php
/**
 * Custom Post Types functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flagship_Tailwind
 */

add_action( 'wp_enqueue_scripts', 'ksas_flagship_custom_posts_scripts' );
	/**
	 * Conditionally add isotope scripts to Research Projects page
	 *
	 * Note that this function is hooked into the wp_enqueue_scripts
	 */
function ksas_flagship_custom_posts_scripts() {
	if ( is_page_template( 'page-templates/fields-of-study.php' ) ) :
		wp_enqueue_script( 'isotope-packaged', 'https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js', array(), '3.0.6', true );
	endif;
}

/*
add_filter('tablepress_use_default_css', 'custom_load_tablepress_css');
add_filter('tablepress_custom_css_url', 'custom_load_tablepress_css');
function custom_load_tablepress_css( $load_css ) {
  if ( ! is_page( array( 'departments-programs-and-centers', 'majors-minors', 'faculty-directory', 'masters-doctorates', 'administrative-offices' ) ) ) {
    $load_css = false;
  }
  return $load_css;
}*/