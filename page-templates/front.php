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

	<div class="relative grid w-full h-[25rem] xl:h-screen grid-cols-3 border-heritage-blue bg-cover bg-center hero front-featured-image-area" style="background-image:url('<?php echo esc_url( $random_img_url ); ?>')">
		<div class="absolute inset-0 z-0 bg-gradient-to-b from-primary/70 via-transparent to-primary/90 xl:to-primary/70"></div>
		<!-- Left Content (Heading/Text) -->
		<div class="relative z-10 self-end col-span-3 pb-4 pl-8 pr-8 xl:pr-4 xl:pb-24 xl:col-span-2 xl:w-5/7">
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
			<div class="mt-2 text-lg lg:text-xl 2xl:text-2xl font-bold leading-tight tracking-tight text-white font-heavy">
				<?php the_content(); ?>
			</div>
		</div>
		<!-- Right Content (News Callout) -->
		<?php get_template_part( 'template-parts/front-page/news-callout' ); ?>
	</div>
<main>
	<section class="bg-white border-b-2 calls-to-action border-grey" id="primary">
		<?php get_template_part( 'template-parts/front-page/academic-programs' ); ?>
	</section>

	<section class="relative">
		<?php get_template_part( 'template-parts/front-page/video-section' ); ?>
		<?php get_template_part( 'template-parts/front-page/collage' ); ?>
	</section>

</main>
<?php
get_footer();
