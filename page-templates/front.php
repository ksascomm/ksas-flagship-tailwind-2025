<?php
/**
 * Template Name: Front
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

get_header();
?>

<?php if ( have_rows( 'homepage_hero_images' ) ) : ?>
	<?php
	$random_images = get_field( 'homepage_hero_images' );
	shuffle( $random_images );
	// print("<pre>".print_r($random_images,true)."</pre>");
	$random_img_url   = $random_images[0]['homepage_hero_image']['url'];
	$random_img_alt   = $random_images[0]['homepage_hero_image']['alt'];
	$random_img_title = $random_images[0]['homepage_hero_image']['title'];
	?>
			
<?php endif; ?>
<main>
	<div class="relative grid w-full h-100 xl:h-[90vh] grid-cols-3 border-heritage-blue bg-cover bg-center hero front-featured-image-area" style="background-image:url('<?php echo esc_url( $random_img_url ); ?>')">
		<div class="absolute inset-0 z-0 bg-linear-to-b from-primary/70 via-transparent to-primary/90 xl:to-primary/70"></div>
		<!-- Left Content (Heading/Text) -->
		<div class="relative z-10 self-end col-span-3 pb-4 pl-8 pr-8 xl:pr-4 xl:pb-16 xl:col-span-2 xl:w-5/7">
			<h1 class="text-2xl font-bold text-white xl:text-3xl 2xl:text-4xl font-serif-bold">
					<?php if ( have_rows( 'heading' ) ) : ?>
						<?php
						$repeater = get_field( 'heading' ); // Get the repeater field.
						$rand     = wp_rand( 0, ( count( $repeater ) - 1 ) ); // Randomize the rows.
						$message  = get_field( 'heading_text' );
						?>
						<?php echo esc_html( $repeater[ $rand ]['heading_text'] ); ?>
					<?php else : ?>
						<?php the_title(); ?>
					<?php endif; ?>
				</h1>
			<div class="mt-2 text-lg font-bold leading-tight tracking-tight text-white lg:text-xl 2xl:text-2xl font-heavy">
				<?php the_content(); ?>
			</div>
		</div>
		<!-- Right Content (News Callout) -->
		<?php get_template_part( 'template-parts/front-page/news-callout' ); ?>

		<!-- Nav Cue Chevron -->
		<a href="#main-content-start" class="absolute hidden no-underline -translate-x-1/2 cursor-pointer xl:block bottom-6 left-1/2 z-100 group">
		<svg 
			class="w-8 h-8 text-white group-hover:text-[#ffc72c] group-focus:text-[#ffc72c] animate-bounce transition-colors duration-300 animate-soft-bounce" 
			fill="none" 
			stroke="currentColor" 
			viewBox="0 0 24 24" 
			xmlns="http://www.w3.org/2000/svg">
			<path 
				stroke-linecap="round" 
				stroke-linejoin="round" 
				stroke-width="2" 
				d="M19 9l-7 7-7-7">
			</path>
		</svg>
		</a>
	</div>

	<section class="bg-white border-b-2 calls-to-action border-grey" id="primary">
		<div id="main-content-start">
			<?php get_template_part( 'template-parts/front-page/academic-programs' ); ?>
		</div>
	</section>

	<section class="relative">
		<?php get_template_part( 'template-parts/front-page/video-section' ); ?>
		<?php get_template_part( 'template-parts/front-page/collage' ); ?>
	</section>

</main>
<?php
get_footer();
