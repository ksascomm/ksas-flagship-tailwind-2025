<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'prose prose-sm lg:prose-lg mx-auto' ); ?>>
	<?php if ( get_post_meta( $post->ID, 'ecpt_image', true ) ) : ?>
		<img src="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_image', true ) ); ?>" alt="<?php the_title(); ?>">
	<?php endif; ?>
	<div class="flex flex-wrap">
		<?php if ( get_post_meta( $post->ID, 'ecpt_homepage', true ) ) : ?>
		<div class="pr-4">
			<span class="fa-solid fa-earth-americas"></span>
			<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_homepage', true ) ); ?>">
				<?php the_title(); ?> Website
			</a>
		</div>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_emailaddress', true ) ) : ?>
			<div class="pr-4">
				<span class="fa-solid fa-envelope"></span>
				<a href="mailto:<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_emailaddress', true ) ); ?>">
					<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_emailaddress', true ) ); ?>
				</a>
			</div>
		<?php endif; ?>

		<?php if ( get_post_meta( $post->ID, 'ecpt_location', true ) ) : ?>
			<div class="pr-4">
				<span class="fa-solid fa-location-dot"></span>
				<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_location', true ) ); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="flex flex-wrap">
		<?php if ( get_post_meta( $post->ID, 'ecpt_majors', true ) || get_post_meta( $post->ID, 'ecpt_minors', true ) ) : ?>
			<div class="mt-4 pr-4">
				<span>Students can:</span>
				<?php if ( get_post_meta( $post->ID, 'ecpt_majors', true ) ) : ?>
					<span class="inline-block text-primary bg-spirit-blue font-heavy font-bold text-lg px-2 mx-1">Major</span>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_minors', true ) ) : ?>
					<span class="inline-block text-primary bg-spirit-blue font-heavy font-bold text-lg px-2 mx-1">Minor</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_degreesoffered', true ) ) : ?>
			<div class="mt-4 pr-4">
				<span>Degrees Offered:</span> <span class="inline-block text-primary bg-spirit-blue font-heavy font-bold text-lg px-2 mx-1"><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_degreesoffered', true ) ); ?></span>
			</div>
		<?php endif; ?>
	</div>

	<div class="entry-content">
		<?php
		if ( get_post_meta( $post->ID, 'ecpt_section1', true ) ) :
			$content = get_post_meta( $post->ID, 'ecpt_section1', true );
				printf( $content );
		endif;
		?>

	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'flagship-tailwind' ),
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
</article><!-- #post-<?php the_ID(); ?> -->
