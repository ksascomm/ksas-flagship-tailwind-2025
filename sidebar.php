<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flagship_Tailwind
 */

?>

<aside id="secondary" class="w-full sidebar widget-area xl:w-[25%] xl:ml-[10%] xl:max-w-[30%]">
	<!-- Start Flexible Sidebar Content Conditional -->
	<?php if ( have_rows( 'flex_content' ) ): ?>
		<?php while ( have_rows( 'flex_content' ) ) : the_row(); ?>
			<?php if ( get_row_layout() == 'content' ) : ?>
				<!-- Image Conditional -->
				<?php if ( have_rows( 'images' ) ) : ?>
					<?php while ( have_rows( 'images' ) ) : the_row(); ?>
						<?php $image = get_sub_field( 'image' ); ?>
						<?php if ( $image ) : ?>
							<div class="my-8 sidebar-image-box">
								<img style="box-shadow: 20px 20px var(--color-medium-blue);" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php // No rows found ?>
				<?php endif; ?>
				<!-- End Image Conditional -->

				<!-- Pullquote Conditional -->
				<?php if ( have_rows( 'sidebar_quote' ) ) : ?>
					<?php
					$has_valid_quote = false;

					// Loop once to check for any non-empty fields
					while ( have_rows( 'sidebar_quote' ) ) : the_row();
						if ( get_sub_field( 'quotation' ) || get_sub_field( 'cite' ) ) {
							$has_valid_quote = true;
							break;
						}
					endwhile;

					// Rewind the rows to loop again if valid quote found
					if ( $has_valid_quote ) :
						reset_rows();
						?>
						<div class="my-8 bg-white sidebar-quote">
							<?php while ( have_rows( 'sidebar_quote' ) ) : the_row(); ?>
								<?php if ( get_sub_field( 'quotation' ) || get_sub_field( 'cite' ) ) : ?>
									<div class="prose">
										<blockquote class="relative border-s-[0] ps-[0] bg-white prose">
											<svg class="absolute top-0 opacity-20 -start-4 size-16 text-medium-blue" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
											<path d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z" fill="currentColor"></path>
											</svg>
											<div class="relative z-10">
												<?php if ( get_sub_field( 'quotation' ) ) : ?>
													<p class="pb-4 pr-4 pt-8 pl-8 font-heavy font-bold leading-6"><?php the_sub_field( 'quotation' ); ?></p>
												<?php endif; ?>
												<?php if ( get_sub_field( 'cite' ) ) : ?>
													<cite class="pb-4 pr-4 pt-8 pl-8 not-italic font-heavy font-bold text-medium-blue text-base"><?php the_sub_field( 'cite' ); ?></cite>
												<?php endif; ?>
											</div>
										</blockquote>
									</div>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<!-- End Pullquote Conditional -->

				<!-- Statistic Conditional -->
				<?php if ( have_rows( 'statistics' ) ) : ?>
					<div class="my-8 text-center statistics">
					<?php while ( have_rows( 'statistics' ) ) : the_row(); ?>
						<div class="statistic-icon">
							<?php $icon = get_sub_field( 'icon' ); ?>
							<?php if ( $icon ) : ?>
								<img class="mx-auto max-w-3xs" loading="lazy" src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>" />
							<?php endif; ?>
						</div>
						<?php if ( get_sub_field( 'number' ) ) : ?>
							<div class="text-6xl font-bold statistic-number font-serif-bold text-spirit-blue">
								<?php the_sub_field( 'number' ); ?>
							</div>
						<?php endif; ?>
						<?php if ( get_sub_field( 'statistic_head' ) ) : ?>
							<div class="text-3xl font-bold statistic-heading font-heavy text-homewood-green">
								<?php the_sub_field( 'statistic_head' ); ?>
							</div>
						<?php endif; ?>
						<?php if ( get_sub_field( 'statistic_id' ) ) : ?>
							<div class="statistic-id">
								<?php the_sub_field( 'statistic_id' ); ?>
							</div>
						<?php endif; ?>
						<?php if ( get_sub_field( 'statistic_description' ) ) : ?>
							<div class="text-xl statistic-description">
								<?php the_sub_field( 'statistic_description' ); ?>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
					</div>
					<?php else : ?>
					<?php // No rows found ?>
				<?php endif; ?>
			<?php endif; ?>
			<!-- End Statistic Conditional -->
		<?php endwhile; ?>
	<?php else: ?>
		<?php // No layouts found ?>
	<?php endif; ?>
	<!-- End Flexible Sidebar Content Conditional -->
</aside><!-- #secondary -->

