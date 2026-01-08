<?php
/**
 * Template Name: Dean's Directory
 *
 * The template for displaying People custom post type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

get_header();
?>
	<main id="primary">
	<?php get_template_part( 'template-parts/featured-image' ); ?>
	<div class="w-full pt-4 pb-8 lg:pl-0 wayfinding">
		<div class="section-inner">
			<?php get_template_part( 'template-parts/sidebar-menu' ); ?>
		<?php
		if ( function_exists( 'bcn_display' ) ) :
			?>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php bcn_display(); ?>
			</div>
		<?php endif; ?>
		</div>
	</div>
	<div class="w-full overflow-x-hidden site-main">
		
		<div class="w-full max-w-5xl xl:w-6xl xl:mx-auto">

		<?php
		if ( have_posts() ) :
			?>

			<?php


			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
		endif;
		?>

		<?php
			$flagship_leadership_query = new WP_Query(
				array(
					'post_type'      => 'people',
					'role'           => 'leadership',
					'meta_key'       => 'ecpt_people_alpha',
					'orderby'        => 'meta_value',
					'order'          => 'ASC',
					'posts_per_page' => 50,
				)
			);

			while ( $flagship_leadership_query->have_posts() ) :
				$flagship_leadership_query->the_post();

				get_template_part( 'template-parts/content', 'people' );

		endwhile; // End of the loop.
			?>
		<?php
		// Return to main loop.
		wp_reset_postdata();
		?>
	</div>
	</div>
	</main><!-- #main -->
<?php
get_footer();
