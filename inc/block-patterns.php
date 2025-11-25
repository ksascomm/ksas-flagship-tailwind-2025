<?php
/**
 * Block Patterns
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_pattern/
 * @link https://developer.wordpress.org/reference/functions/register_block_pattern_category/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.5
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'ksas-flagship-blocks',
		array( 'label' => esc_html__( 'KSAS Flagship Blocks', 'ksas-flagship-blocks' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {

	// Simple Hero Section.
	register_block_pattern(
		'ksasblocks/simple-hero',
		array(
			'title'         => esc_html__( 'Simple Hero', 'ksas-flagship-blocks' ),
			'categories'    => array( 'ksas-flagship-blocks' ),
			'viewportWidth' => 1400,
			'content'       => '
			<!-- wp:columns {"verticalAlignment":"center"} -->
			<div class="px-2 wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
			<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"className":"mt-0"} -->
			<h2 class="mt-0">Study Living Systems from Unique Perspectives</h2>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p>The&nbsp;Thomas C. Jenkins Department of Biophysics&nbsp;has a long tradition of excellence in research and teaching and of developing leaders in the scientific community.</p>
			<!-- /wp:paragraph -->
			
			<!-- wp:button {"backgroundColor":"heritage-blue","style":{"border":{"radius":2}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-heritage-blue-background-color has-background" style="border-radius:2px">Get Started</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:column -->
			
			<!-- wp:column {"verticalAlignment":"center"} -->
			<div class="wp-block-column is-vertically-aligned-center"><!-- wp:cover {"url":"https://krieger.jhu.edu/wp-content/themes/ksas-department-tailwind/dist/images/campus3.jpg","id":1869,"dimRatio":0,"minHeight":500,"style":{"color":{}}} -->
			<div class="wp-block-cover" style="min-height:500px"><img class="wp-block-cover__image-background wp-image-1869" alt="" src="https://krieger.jhu.edu/wp-content/themes/ksas-department-tailwind/dist/images/campus3.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"></div></div>
			<!-- /wp:cover --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->',
		)
	);

	// Three Column Feature.
	register_block_pattern(
		'ksasblocks/three-column-feature',
		array(
			'title'         => esc_html__( 'Thee Column Feature', 'ksas-flagship-blocks' ),
			'categories'    => array( 'ksas-flagship-blocks' ),
			'viewportWidth' => 1400,
			'content'       => '<!-- wp:columns -->
			<div class="wp-block-columns three-column-feature"><!-- wp:column {"width":"66.66%"} -->
			<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:heading -->
			<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</h2>
			<!-- /wp:heading --></div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"33.33%"} -->
			<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:paragraph -->
			<p class="has-text-align-right"><a href="#">Explore More</a></p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->

			<!-- wp:columns -->
			<div class="wp-block-columns three-column-feature"><!-- wp:column -->
			<div class="px-6 py-8 mb-4 overflow-hidden bg-white rounded-md shadow-md wp-block-column"><!-- wp:heading -->
			<h2>Explore</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing Ac aliquam ac volutpat, viverra magna risus aliquam massa.</p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="px-6 py-8 mb-4 overflow-hidden bg-white rounded-md shadow-md wp-block-column"><!-- wp:heading -->
			<h2>Learn</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing Ac aliquam ac volutpat, viverra magna risus aliquam massa.</p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="px-6 py-8 mb-4 overflow-hidden bg-white rounded-md shadow-md wp-block-column"><!-- wp:heading -->
			<h2>Discover</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing Ac aliquam ac volutpat, viverra magna risus aliquam massa.</p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->',
		)
	);
	// Intro Paragraph.
	register_block_pattern(
		'ksasblocks/intro-paragraph',
		array(
			'title'       => __( 'Intro Paragraph', 'ksas-flagship-blocks' ),
			'description' => __( 'An introductory paragraph inside a constrained group.', 'ksas-flagship-blocks' ),
			'categories'    => array( 'ksas-flagship-blocks' ),
			'content'     => ' <!-- wp:group {"metadata":{"categories":["ksas-flagship-blocks"],"patternName":"ksasblocks/intro-paragraph","name":"Intro Paragraph"},"className":"intro-paragraph","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group intro-paragraph"><!-- wp:paragraph -->
			<p>The Krieger School is comprised of 22 departments and 33 centers, programs, and institutes, and home to students interested in the arts, humanities, natural sciences, and social sciences.</p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:group -->',
		)
	);

}
