<?php
/**
 * The template for displaying all single People custom post types
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Flagship_Tailwind
 */

get_header();
?>

	<main id="primary" class="w-full overflow-x-hidden site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-people-full' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	
<?php
get_footer();
