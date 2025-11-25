<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Flagship_Tailwind
 */

get_header();
?>
	<div class="w-full text-white bg-heritage-blue bg-gradient-to-r from-heritage-blue to-medium-blue">
		<div class="section-inner">
				<h1 class="tracking-tight leading-10 sm:leading-none text-4xl xl:text-[44px] lg:pl-2 xl:pl-0 py-4 mb-0">
					<?php esc_html_e( 'Oops!', 'flagship-tailwind' ); ?>
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
	<main id="primary" class="w-full site-main">
		<div class="w-full xl:w-6xl max-w-screen-lg xl:mx-auto">
			<div class="prose prose-sm lg:prose-lg mx-auto error-404 not-found lg:shadow-lg lg:bg-white lg:border-2 lg:border-medium-blue lg:border-solid lg:px-[calc(var(--spacing)_*_5)] lg:max-w-[calc(1640px+17.0731707317%)] lg:mx-[-4.5rem] lg:mb-8 lg:pt-4">
				<header class="page-header">
					<h2 class="text-medium-blue xl:!mt-0 pt-2"><?php esc_html_e( 'Sorry! That page can&rsquo;t be found.', 'flagship-tailwind' ); ?></h2>
				</header><!-- .page-header -->

				<div class="entry-content text-2xl">
					<p><?php esc_html_e( 'The page you are looking for might have been removed, was renamed, or is temporarily unavailable. We apologize for the inconvenience.', 'flagship-tailwind' ); ?></p>
					<p><?php _e( 'Please try the following:', 'flagship-tailwind' ); ?></p>
					<ul>
						<li>
							<?php
								/* translators: %s: home page url */
								printf(
									__(
										'Return to the <a href="%s">home page</a>',
										'flagship-tailwind'
									),
									home_url()
								);
								?>
						</li>
						<li>
							<form method="GET" action="<?php echo esc_html( site_url( '/search' ) ); ?>" role="search" aria-label="Mobile Menu Search">
								<input type="text" value="<?php echo get_search_query(); ?>" name="q" class="pl-2 text-primary border-grey" id="mobile-search" placeholder="Search this site" aria-label="search"/>
								<label for="mobile-search" class="screen-reader-text">
									Search This Website
								</label>
								<button type="submit" class="px-4 py-2 font-sans font-normal bg-grey-lightest hover:bg-heritage-blue text-primary hover:text-white" aria-label="search">Search <span class="fa-solid fa-magnifying-glass"></span></button>
							</form>
						</li>
					</ul>
				</div><!-- .entry-content -->
			</div><!-- .error-404 -->
		</div>
	</main><!-- #main -->
<?php
get_footer();
