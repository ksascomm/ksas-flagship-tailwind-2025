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

			<?php
			/*
			* Generate a unique ID for each form and a string containing an aria-label
			* if one was passed to get_search_form() in the args array.
			*/
			$twentytwenty_unique_id = twentytwenty_unique_id( 'search-form-' );

			$twentytwenty_aria_label = ! empty( $args['label'] ) ? 'aria-label="' . esc_attr( $args['label'] ) . '"' : '';
			?>
			<form role="search" <?php echo $twentytwenty_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form" action="<?php echo esc_url( home_url( '/search' ) ); ?>">
				<label for="<?php echo esc_attr( $twentytwenty_unique_id ); ?>">
					<span class="sr-only"><?php _e( 'Search for:', 'ksas-dept-tailwind' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></span>
					<input type="search" id="<?php echo esc_attr( $twentytwenty_unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search this site &hellip;', 'placeholder', 'ksas-dept-tailwind' ); ?>" value="<?php echo get_search_query(); ?>" name="q" />
				</label>
				<input type="submit" class="px-2 text-white search-submit bg-blue hover:bg-blue-light hover:text-primary" value="<?php echo esc_attr_x( 'Search', 'submit button', 'ksas-dept-tailwind' ); ?>" />
			</form>

			<button class="toggle search-untoggle close-search-toggle fill-children-current-color" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field">
				<span class="sr-only"><?php _e( 'Close search', 'ksas-blocks' ); ?></span>
				<?php twentytwenty_the_theme_svg( 'cross' ); ?>
			</button><!-- .search-toggle -->

		</div><!-- .section-inner -->

	</div><!-- .search-modal-inner -->

</div><!-- .menu-modal -->
