<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
		<div class="w-full site-main">
			<div class="w-full max-w-screen-lg xl:w-6xl xl:mx-auto">
				<?php
				while ( have_posts() ) :
					the_post();
					if ( is_page( '5823' ) ) :
						get_template_part( 'template-parts/content', 'dpci' );
					else :
						get_template_part( 'template-parts/content', 'page' );
					endif;
				endwhile; // End of the loop.
				?>
			</div>
		</div>
	</main><!-- #main -->
<?php
get_footer();
