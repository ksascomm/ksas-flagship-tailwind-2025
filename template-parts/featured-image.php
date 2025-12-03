<?php
/**
 * Template part for displaying featured images
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

?>
<?php if ( get_field( 'featured_image' ) == 1 ) : ?>
<!-- Featured Image Conditional Start -->
<div class="featured-image-area interior-featured-image-area h-auto mt-0! bg-white lg:bg-grey-lightest relative" role="banner">
	<div class="flex h-auto lg:max-h-[25.78rem] lg:h-96 relative w-full">
		<?php
		if ( has_post_thumbnail() ) :
			the_post_thumbnail(
				'full',
				array(
					'class' => 'h-56 w-full object-cover lg:max-h-[25.78rem] lg:h-96',
					'title' => 'Feature image',
				)
			);
			else :
					// Otherwise, randomly display one of the following images.
					$theme = get_template_directory_uri();
					$bg    = array(
						$theme . '/dist/images/headers/flagship_sub_01.jpg',
						$theme . '/dist/images/headers/flagship_sub_02.jpg',
						$theme . '/dist/images/headers/flagship_sub_03.jpg',
						$theme . '/dist/images/headers/flagship_sub_04.jpg',
						$theme . '/dist/images/headers/flagship_sub_05.jpg',
						$theme . '/dist/images/headers/flagship_sub_06.jpg',
					);

					$i              = wp_rand( 0, count( $bg ) - 1 ); // Generate random number size of the array.
					$selected_image = "$bg[$i]"; // Set variable equal to which random filename was chosen.
					?>
				<img src="<?php echo esc_url( $selected_image ); ?>" alt="Generic Hero Image" class="h-56 w-full object-cover lg:max-h-[25.78rem] lg:h-96">
						<?php
		endif;
			?>
	</div>
	<!-- Text Banner Overlay -->
	<div class="absolute bottom-0 left-0 w-full text-white bg-heritage-blue bg-gradient-to-r from-heritage-blue to-medium-blue">
		<div class="section-inner"> 
			<h1 class="tracking-tight leading-10 sm:leading-none text-[2rem] lg:text-[44px] -ml-0.5 lg:pl-2 xl:pl-0 py-4 mb-0">
				<?php the_title(); ?>
			</h1>
		</div>
	</div>
</div>
<!-- Decorative Bar Below the Image -->
<div class="w-full h-3 text-white bg-heritage-blue bg-gradient-to-l from-heritage-blue to-medium-blue"></div>
<!-- Featured Image Conditional End -->
<?php else : ?>
<!-- Print the Page Title -->
	<div class="w-full text-white bg-heritage-blue bg-gradient-to-r from-heritage-blue to-medium-blue">
		<div class="section-inner"> 
			<?php
				the_title( '<h1 class="tracking-tight leading-10 sm:leading-none text-[2rem] lg:text-[44px] lg:pl-2 xl:pl-0 py-4 mb-0 -ml-0.5">', '</h1>' );
			?>
		</div>
	</div>
	<!-- Decorative Bar Below the Image -->
	<div class="w-full h-3 text-white bg-heritage-blue bg-gradient-to-l from-heritage-blue to-medium-blue"></div>
<?php endif; ?>