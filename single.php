<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Flagship_Tailwind
 */

get_header();
?>
	<main id="primary">
		<div class="w-full text-white bg-heritage-blue bg-gradient-to-r from-heritage-blue to-medium-blue">
			<div class="section-inner"> 
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="tracking-tight leading-10 sm:leading-none text-3xl lg:text-4xl xl:text-[44px] lg:pl-2 xl:pl-0 py-4 mb-0">', '</h1>' );
			else :
				the_title( '<h2 class="font-bold entry-title font-heavy"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>
			</div>
		</div>
		<!-- Decorative Bar Below the Image -->
		<div class="w-full h-3 text-white bg-heritage-blue bg-gradient-to-l from-heritage-blue to-medium-blue"></div>
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
		<div class="w-full site-main">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			endwhile; // End of the loop.
			?>
		</div>
	</main><!-- #main -->
<?php
get_footer();
