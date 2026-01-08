<?php
/**
 * Template part for displaying People CPT with 'ecpt_bio' in
 * people-direcory.php and single-people.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'people' ); ?>>

	<!-- Hero container with headshot & contact info -->
	<div class="w-screen relative left-[50%] right-[50%] ml-[-50vw] mr-[-50vw] mt-0 bg-heritage-blue bg-topography overflow-hidden " id="contact-hero">
		<div class="container flex flex-wrap justify-start px-10 lg:mx-auto contact-info xl:px-20">
			<div class="grid grid-cols-3 py-8 lg:gap-8">
				<?php
				if ( has_post_thumbnail() ) :
					?>
					<div class="col-span-3 lg:col-span-1">
					<?php
					the_post_thumbnail(
						'full',
						array(
							'class' => 'mb-4 lg:mb-0 filter brightness-100 contrast-100 saturate-100 blur-0 [hue-rotate:0deg] [box-shadow:9px_0px_10px_0px_rgba(0,0,0,0.5)]',
							'alt'   => the_title_attribute( array( 'echo' => false ) ),
						)
					);
					?>
					</div>
					<?php
					endif;
				?>
				<div class="col-span-3 lg:col-span-2">
					<header class="pl-0 pr-2 entry-header">
						<h1 class="tracking-tight leading-10 sm:leading-none pt-2 pb-4 mb-0! text-4xl  text-white">
							<?php the_title(); ?> 
						</h1>
					</header>
					<div class="position not-prose">
						<h2 class="pr-2 my-4 text-2xl font-bold leading-normal text-white font-heavy">
						<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
							<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?>
						<?php else : ?>
							<span class="capitalize"><?php echo wp_strip_all_tags( get_the_term_list( $post->ID, 'role', '', ', ' ) ); ?></span>
						<?php endif; ?>	
						</h2>
					</div>
				
					<h3 class="sr-only">Contact Information</h3>

					<ul class="not-prose">
					<?php
					if ( get_post_meta( $post->ID, 'ecpt_email', true ) ) :
						$email = get_post_meta( $post->ID, 'ecpt_email', true );
						?>
							<li class="pb-4 text-xl font-bold text-white font-heavy"><span class="fa-solid fa-envelope" aria-hidden="true"></span>
								<a class="text-white underline hover:text-primary" href="<?php echo esc_url( 'mailto:' . antispambot( $email ) ); ?>">
							<?php echo esc_html( $email ); ?>
								</a>
							</li>
						<?php endif; ?>

						
					<?php if ( get_post_meta( $post->ID, 'ecpt_phone', true ) ) : ?>
						<li class="text-xl font-bold text-white font-heavy"><span class="fa-solid fa-phone-office" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_phone', true ) ); ?></li>
					<?php endif; ?>

					<?php if ( get_post_meta( $post->ID, 'ecpt_office', true ) ) : ?>
						<li class="text-xl text-white"><span class="fa-solid fa-location-dot" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_office', true ) ); ?></li>
					<?php endif; ?>


					</ul>
				</div>
			</div>
		</div>
		<div class="w-full h-6 text-white bg-heritage-blue bg-gradient-to-r from-heritage-blue to-medium-blue"></div>
	</div>
	<!--End Hero container with headshot & contact info -->

	<!-- Biography Section -->
	<div class="w-full max-w-screen-lg xl:w-6xl xl:mx-auto" id="biography">
	<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
		<!--Wayfinding section -->
		<div class="w-full pt-4 pb-8 lg:pl-0 wayfinding">
			<div class="section-inner">
				<?php get_template_part( 'template-parts/sidebar-menu' ); ?>
			<?php
			if ( function_exists( 'bcn_display' ) ) :
				?>
				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					<?php bcn_display(); ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
		<!--End wayfinding section -->
	<?php endif; ?>
	<div class="mx-auto prose-sm prose lg:prose-lg">
		<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
			<div class="text-xl leading-normal entry-content">
				<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_bio', true ) ); ?>
			</div>
		<?php endif; ?>
		</div>
		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="sr-only">%s</span>', 'ksas-department-tailwind' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div>
	<!-- End Biography Section -->
</article><!-- #post-<?php the_ID(); ?> -->
