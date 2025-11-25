<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

get_header();
?>


		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<div class="w-full text-white bg-heritage-blue bg-gradient-to-r from-heritage-blue to-medium-blue">
					<div class="section-inner"> 
						<h1 class="tracking-tight leading-10 sm:leading-none text-3xl lg:text-4xl xl:text-[44px] lg:pl-2 xl:pl-0 py-4 mb-0">
							<?php single_post_title(); ?>
						</h1>
					</div>
				</div>
				<!-- Decorative Bar Below the Image -->
				<div class="w-full h-3 text-white bg-heritage-blue bg-gradient-to-l from-heritage-blue to-medium-blue"></div>
				<?php
			endif; ?>
			<div class="pt-4 pb-8 lg:pl-0 wayfinding w-full">
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
			<main id="primary" class="w-full px-4">
					<div class="w-full xl:w-7xl max-w-screen-3xl xl:mx-auto">
					<?php 
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						if ( is_home() ) :
							get_template_part( 'template-parts/content', 'post-excerpt' );
						else :
							get_template_part( 'template-parts/content', get_post_type() );
						endif;
					endwhile;

					if ( function_exists( 'flagship_tailwind_pagination' ) ) :

						flagship_tailwind_pagination();

					else :

						the_posts_navigation();

					endif;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
		</div>
	</main><!-- #main -->


<?php
get_footer();
