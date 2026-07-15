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

/**
 * Fields of Study Stuff
 */
function filter_studyfields_ajax_handler() {
	// 1. Verify Nonce (Unslashed and Sanitized)
	$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'studyfields_filter_nonce' ) ) {
		wp_send_json_error( 'Bad Nonce', 403 );
	}

	// 2. Check Permissions (Optional but recommended)
	if ( ! current_user_can( 'read' ) ) {
		wp_send_json_error( 'Unauthorized', 403 );
	}
	$meta_query = array();
	$tax_query  = array();

	// Search field.
	if ( ! empty( $_POST['keyword'] ) ) {
		// 1. Unslash the raw input.
		// 2. Sanitize for use in a meta query.
		$keyword = sanitize_text_field( wp_unslash( $_POST['keyword'] ) );

		$meta_query[] = array(
			'key'     => 'ecpt_keywords',
			'value'   => $keyword,
			'compare' => 'LIKE',
		);
	}

	// Interest Area.
	if ( ! empty( $_POST['interest_area'] ) ) {
		$tax_query[] = array(
			'taxonomy' => 'interest-area',
			'field'    => 'slug',
			'terms'    => sanitize_text_field( wp_unslash( $_POST['interest_area'] ) ),
		);
	}

	// Program Type.
	if ( ! empty( $_POST['program_type'] ) ) {
		$tax_query[] = array(
			'taxonomy' => 'program_type',
			'field'    => 'slug',
			'terms'    => sanitize_text_field( wp_unslash( $_POST['program_type'] ) ),
		);
	}

	if ( count( $tax_query ) > 1 ) {
		$tax_query['relation'] = 'AND';
	}

	$args = array(
		'post_type'      => 'studyfields',
		'orderby'        => 'title',
		'order'          => 'ASC',
		'posts_per_page' => 100,
		'post_status'    => 'publish',
		'meta_query'     => $meta_query,
		'tax_query'      => $tax_query,
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			get_template_part( 'template-parts/content', 'studyfields-cards' );
		endwhile;
	else :
		echo '<div id="noResult" class="p-4 bg-spirit-blue"><h2>No matching results</h2></div>';
	endif;

	wp_reset_postdata();
	wp_die();
}
add_action( 'wp_ajax_filter_studyfields', 'filter_studyfields_ajax_handler' );
add_action( 'wp_ajax_nopriv_filter_studyfields', 'filter_studyfields_ajax_handler' );

/**
 * Add noindex, nofollow robots headers to a Study Fields post type.
 *
 * @param array $robots Associative array of robots directives.
 *
 * @return array Modified robots directives.
 */
function ksas_noindex_custom_post_type( $robots ) {
	// Check if we are viewing a single post or an archive.
	if ( is_singular( 'studyfields' ) || is_post_type_archive( 'studyfields' ) ) {
		return array(
			'noindex'  => true,
			'nofollow' => true,
		);
	}
	return $robots;
}
add_filter( 'wp_robots', 'ksas_noindex_custom_post_type' );
