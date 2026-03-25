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
						<!--End normal part of the loop.-->
						
						<!-- Start of ACF flexible content loop for images. -->
						<?php if ( have_rows( 'flex_content' ) ) : ?>
							<?php
							while ( have_rows( 'flex_content' ) ) :
								the_row();
								?>
					
								<?php if ( get_row_layout() === 'content' ) : ?>
									<?php
									// 1. Get the sub-field and ensure it's an array for PHP 8
									$image_rows   = get_sub_field( 'images' );
									$images       = is_array( $image_rows ) ? $image_rows : array();
									$total_images = count( $images );
									?>

									<?php if ( $total_images > 0 ) : ?>
									<div class="hidden xl:flex xl:flex-col gap-6 xl:-mt-5 xl:pl-[6%]">
												<?php
												$row_index = 0;
												foreach ( $images as $image_data ) :
													$image = $image_data['image'] ?? null;
													if ( ! $image ) {
														continue;
													}
													?>
											
													<?php if ( 0 === $row_index ) : ?>
												<div class="w-full">
													<img class="object-cover w-full h-auto rounded" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>" />
												</div>
												
														<?php if ( $total_images > 1 ) : ?>
													<div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
												<?php endif; ?>

											<?php elseif ( 1 === $row_index || 2 === $row_index ) : ?>
												<div>
													<img class="object-cover w-full h-auto rounded" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>" />
												</div>
											<?php endif; ?>

													<?php ++$row_index; ?>
												<?php endforeach; ?>

												<?php if ( $total_images > 1 ) : ?>
											</div> <?php endif; ?>
										
									</div> <?php endif; ?>

							<?php endif; ?>

							<?php endwhile; ?>
						<?php endif; ?>
						<!-- End of ACF flexible content loop for images. -->
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
			<form class="w-full max-w-6xl p-4 mt-4 mb-4 text-left border-2 border-solid lg:mt-0 study-fields bg-grey-lightest border-grey" id="filters">
				
				<div class="flex flex-wrap items-end gap-8 mb-8">
					<div class="flex flex-col">
						<label class="mt-4 mb-2 text-2xl font-bold font-heavy" for="filter-program">Program Type:</label>
						<select class="mb-2 mr-4 border-2 border-solid form-select border-grey h-11" name="program_type" id="filter-program">
							<option value="">All Program Types</option>
							<?php
							$program_types = get_terms(
								array(
									'taxonomy'   => 'program_type',
									'hide_empty' => true,
									'orderby'    => 'name',
									'order'      => 'ASC',
								)
							);

							if ( ! is_wp_error( $program_types ) && ! empty( $program_types ) ) :
								foreach ( $program_types as $program_type ) :
									printf( '<option value=".%s">%s</option>', esc_attr( $program_type->slug ), esc_html( $program_type->name ) );
								endforeach;
							endif;
							?>
						</select>
					</div>

					<div class="flex flex-col">
						<label class="mt-4 mb-2 text-2xl font-bold font-heavy" for="filter-interest">Interest Area:</label>
						<select class="mb-2 mr-4 border-2 border-solid form-select border-grey h-11" name="interest_area" id="filter-interest">
							<option value="">All Interest Areas</option>
							<?php
							$interest_areas = get_terms(
								array(
									'taxonomy'   => 'interest-area',
									'hide_empty' => true,
									'orderby'    => 'name',
									'order'      => 'ASC',
								)
							);

							if ( ! is_wp_error( $interest_areas ) && ! empty( $interest_areas ) ) :
								foreach ( $interest_areas as $interest_area ) :
									$capitalized_name = ucwords( strtolower( $interest_area->name ) );
									printf( '<option value=".%s">%s</option>', esc_attr( $interest_area->slug ), esc_html( $capitalized_name ) );
								endforeach;
							endif;
							?>
						</select>
					</div>

					<div class="pb-2">
						<button class="p-2 mx-1 mt-2 mb-2 text-lg font-bold leading-tight text-white capitalize border-b-0 font-heavy all button bg-heritage-blue hover:bg-spirit-blue" type="button" id="clear-filters">
							Clear Filters
						</button>
					</div>
				</div>

				<fieldset class="w-full mt-8 border-none !p-0 !m-0">
					<legend class="mb-2 text-xl font-bold font-heavy">Or, search by major/minor name, area of study, or description</legend>
					<div class="flex items-center">
						<label class="sr-only" for="id_search">Search Fields of Study</label>
						<input class="w-full h-10 p-2 bg-white border rounded-lg outline-none border-grey lg:w-7/12 quicksearch focus:ring-2 focus:ring-heritage-blue"" 
								type="text" 
								name="search" 
								id="id_search" 
								placeholder="Enter major/minor name, area of study, or description keyword..." />
					</div>
				</fieldset>
			</form>

		<?php
			$flagship_studyfields_query = new WP_Query(
				array(
					'post_type'      => 'studyfields',
					'orderby'        => 'title',
					'order'          => 'ASC',
					'posts_per_page' => 100,
					'post__not_in'   => array( 18540 ), // ID of CompThoughtLit-Dept.
				)
			);

			if ( $flagship_studyfields_query->have_posts() ) :
				?>
			<div class="w-full fields-of-study loading" id="isotope-list" aria-live="polite">

				<div class="flex flex-wrap w-full isotope-container">
						<?php
						while ( $flagship_studyfields_query->have_posts() ) :
							$flagship_studyfields_query->the_post();

							get_template_part( 'template-parts/content', 'studyfields-cards' );

						endwhile;
						?>
				</div>
				<div id="noResult" class="hidden py-12 mt-4 text-center border-2 border-dashed border-grey-light">
					<p class="text-2xl font-bold text-heritage-blue font-heavy">No Programs Found</p>
					<p class="text-lg">Try adjusting your filters or search terms.</p>
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
