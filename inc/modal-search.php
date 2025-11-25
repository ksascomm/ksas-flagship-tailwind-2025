<?php
/**
 * Displays the search icon and modal
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<div class="search-modal cover-modal header-footer-group" data-modal-target-string=".search-modal">

	<div class="search-modal-inner modal-inner">

		<div class="section-inner">

		<form method="GET" action="<?php echo esc_url( site_url( '/search' ) ); ?>" role="search" aria-label="Site Search" class="bg-white shadow-sm site-search sm:mb-2 lg:mb-0">
			<input type="text" value="<?php echo get_search_query(); ?>" name="q" class="text-primary pl-2 text-sm" id="mobile-search" placeholder="Search this site" aria-label="search"/>
			<label for="mobile-search" class="screen-reader-text">
				Search This Website
			</label>
			<button type="submit" class="bg-grey-lightest hover:bg-heritage-blue text-primary text-sm font-sans hover:text-white py-2 px-4 border border-transparent hover:border-solid hover:border-white" aria-label="search">Search <span class="fa-solid fa-magnifying-glass"></span></button>
		</form>

			<button class="toggle search-untoggle close-search-toggle fill-children-current-color" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field">
				<span class="sr-only"><?php _e( 'Close search', 'ksas-blocks' ); ?></span>
				<?php twentytwenty_the_theme_svg( 'cross' ); ?>
			</button><!-- .search-toggle -->

		</div><!-- .section-inner -->

	</div><!-- .search-modal-inner -->

</div><!-- .menu-modal -->
