<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Flagship_Tailwind
 */

get_header();
?>
	<div class="w-full text-white bg-heritage-blue bg-gradient-to-r from-heritage-blue to-medium-blue">
		<div class="section-inner"> 
			<h1 class="tracking-tight leading-10 sm:leading-none text-3xl lg:text-4xl xl:text-[44px] lg:pl-2 xl:pl-0 py-4 mb-0">
				<?php
				/* translators: %s: search query. */
				_e( 'Search Results', 'flagship-tailwind' );
				?>
			</h1>
		</div>
	</div>
	<!-- Decorative Bar Below the Image -->
	<div class="w-full h-3 text-white bg-heritage-blue bg-gradient-to-l from-heritage-blue to-medium-blue"></div>
	<div class="pt-4 pb-8 lg:pl-0 wayfinding w-full">
		<div class="section-inner">
		<?php
		if ( function_exists( 'bcn_display' ) ) :
			?>
			<div class="breadcrumbs !bg-white" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php bcn_display(); ?>
			</div>
		<?php endif; ?>
		</div>
	</div>
	<main id="primary" class="w-full site-main ">
		<div class="w-full xl:w-6xl max-w-screen-lg xl:mx-auto mb-8">
			<div class="not-prose lg:shadow-lg lg:bg-white lg:border-2 lg:border-medium-blue lg:border-solid lg:px-[calc(var(--spacing)_*_5)] lg:max-w-[calc(1640px+17.0731707317%)] lg:mx-[-4.5rem]">
				<gcse:search></gcse:search>
			</div>
		</div> 
	</main><!-- #main -->
<?php
get_footer();
