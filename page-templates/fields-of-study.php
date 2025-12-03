<?php
/**
 * Template Name: Fields of Study
 *
 * The template for displaying Fields of Study custom post type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

get_header();
?>
<?php // get_template_part( 'template-parts/featured-image' ); ?>
	<main id="primary" class="w-full">
		<?php
		if ( have_posts() ) :
			?>
			<div class="relative w-full bg-heritage-blue bg-topography alignfull h-min">
				<div class="w-full py-12 xl:w-6xl lg:mx-auto">
					<div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
						<div class="pl-[3%] xl:pl-0 pr-[6%] xl:pr-0">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', 'fos-page' );

						endwhile;
						?>
						</div>
						<?php if ( have_rows( 'flex_content' ) ) : ?>
							<?php
							while ( have_rows( 'flex_content' ) ) :
								the_row();
								?>
								<?php if ( get_row_layout() == 'content' ) : ?>
									<?php if ( have_rows( 'images' ) ) : ?>
										<?php $row_index = 0; ?>
										<div class="hidden xl:flex xl:flex-col gap-6 xl:-mt-5 xl:pl-[6%]">
											<?php
											while ( have_rows( 'images' ) ) :
												the_row();
												?>
												<?php $image = get_sub_field( 'image' ); ?>
												<?php if ( $image ) : ?>
													
													<?php if ( $row_index === 0 ) : ?>
														<!-- Full width first image -->
														
														<div class="w-full">
															<img class="object-cover w-full h-auto rounded" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
														</div>
														<div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
															<?php elseif ( $row_index === 1 || $row_index === 2 ) : ?>
															<!-- Two-column layout for next two images -->
															<div>
																<img class="object-cover w-full h-auto rounded" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
															</div>
																<?php if ( $row_index === 2 ) : ?>
															</div> <!-- Close .acf-image-columns after second image -->
														<?php endif; ?>
													<?php endif; ?>
													
												<?php endif; ?>
												<?php ++$row_index; ?>
											<?php endwhile; ?>
										</div> <!-- Close .acf-images-wrapper -->
									<?php endif; ?>
								<?php endif; ?>
							<?php endwhile; ?>
						<?php else : ?>
							<?php // No layouts found ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
		endif;
		?>
		<div class="w-full xl:w-6xl lg:mx-auto pl-[3%] xl:pl-0 pr-[6%] xl:pr-0">
			<div class="py-8 lg:pl-0 wayfinding xl:w-6xl xl:mx-auto">
				<?php get_template_part( 'template-parts/sidebar-menu' ); ?>
				<?php
				if ( function_exists( 'bcn_display' ) ) :
					?>
					<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
						<?php bcn_display(); ?>
					</div>
				<?php endif; ?>
			</div>
			<form class="w-full max-w-6xl p-4 mb-4 text-left border-2 border-solid study-fields bg-grey-lightest border-grey"" id="filters">
				<!-- Program Type -->
				<label class="mt-4 mb-2 text-2xl font-bold font-heavy" for="filter-1">Program Type:</label>
				<select class="mt-4 mb-2 mr-4 border-2 border-solid form-select border-grey"  name="program_type" id="filter-1">
					<option value="">All Program Types</option>
					<?php
					$program_types = get_terms(
						array(
							'taxonomy'   => 'program_type',
							'hide_empty' => true,
						)
					);
					foreach ( $program_types as $program_type ) {
						echo '<option value=".' . esc_attr( $program_type->slug ) . '">' . esc_html( $program_type->name ) . '</option>';
					}
					?>
				</select>
				<label class="mt-4 mb-2 text-2xl font-bold font-heavy" for="filter-2">Interest Area:</label>
				<select class="mt-4 mb-2 mr-4 border-2 border-solid form-select border-grey" name="interest_area" id="filter-2">
					<option value="">All Interest Areas</option>
					<?php
					$interest_areas = get_terms(
						array(
							'taxonomy'   => 'interest-area',
							'hide_empty' => true,
						)
					);
					foreach ( $interest_areas as $interest_area ) {
						$capitalized_interests = ucwords( strtolower( $interest_area->name ) );
						echo '<option value=".' . esc_attr( $interest_area->slug ) . '">' . esc_html( $capitalized_interests ) . '</option>';
					}
					?>
				</select>
				<!-- Clear Filters Button -->
				<button class="p-2 mx-1 mb-2 text-lg font-bold leading-tight text-white capitalize align-bottom border-b-0 font-heavy all button bg-heritage-blue hover:bg-spirit-blue hover:text-primary" type="button" id="clear-filters">Clear Filters</button>
				
				<fieldset class="w-auto px-4 xl:px-0 !m-0 search-form">
					<legend class="mt-4 mb-2 text-xl font-bold font-heavy">Or, search by major/minor name, area of study, or description</legend>
					<label class="sr-only" for="id_search">Enter term</label>
					<input class="w-3/4 h-10 p-2 bg-white border-t border-b border-r rounded-r-lg lg:w-7/12 quicksearch" type="text" name="search" id="id_search" aria-label="Search Fields of Study" placeholder="Enter major/minor name, area of study, or description keyword"/>
				</fieldset>
			</form>

		<?php
			$flagship_studyfields_query = new WP_Query(
				array(
					'post_type'      => 'studyfields',
					'orderby'        => 'title',
					'order'          => 'ASC',
					'posts_per_page' => 100,
				)
			);

			if ( $flagship_studyfields_query->have_posts() ) :
				?>
			<div class="w-full fields-of-study loading" id="isotope-list" >

				<div class="flex flex-wrap w-full isotope-container">
						<?php
						while ( $flagship_studyfields_query->have_posts() ) :
							$flagship_studyfields_query->the_post();

							get_template_part( 'template-parts/content', 'studyfields-cards-dropshadow-link' );

						endwhile;
						?>
				</div>
			</div>
				<?php
		endif;
			// End of the loop.
			?>
		<?php
		// Return to main loop.
		wp_reset_postdata();
		?>
		</div>
	</main><!-- #main -->
<?php
get_footer();
