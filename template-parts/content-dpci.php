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

	<div class="entry-content">

		<?php
		the_content();
		?>

<?php if ( have_rows( 'section_area' ) ) : ?>
	<?php
		$total_rows = count( get_field( 'section_area' ) );
	while ( have_rows( 'section_area' ) ) :
		?>
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-16 alignwide section-<?php echo get_row_index(); ?>">
			<?php
			the_row();

			$section_title = strip_tags( get_sub_field( 'section_title' ) );
			$section_title = strtolower( $section_title );
			$section_title = preg_replace( '/[^a-z0-9\s]/', '', $section_title );
			$section_title = preg_replace( '/\s+/', '-', $section_title );
			$section_title = trim( $section_title, '-' );

			?>
				<div class="relative card-<?php echo get_row_index(); ?>">
					<div id="<?php echo esc_attr( $section_title ); ?>" class="clear-both py-5 lg:py-20 animated">
						<div class="relative z-10 max-w-3xl ">
							<div class="relative z-10 max-w-4xl mx-auto bg-white border-2 shadow-md border-medium-blue fx fadeIn">
								<div class="px-10 -translate-y-1/2">
									<div class="font-serif-bold font-heavy text-center uppercase text-xl leading-none px-[18px] py-3 border-2 border-medium-blue bg-white inline-block tracking-widest">
										<h2 class="not-prose"><?php the_sub_field( 'section_title' ); ?></h2>
									</div>
								</div>
								<div class="p-6 pt-0">
									<div class="text-base md:text-lg">
									<?php the_sub_field( 'section_content' ); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="place-self-center not-prose">
				<?php $section_collateral = get_sub_field( 'section_collateral' ); ?>
				<?php if ( $section_collateral ) : ?>
						<img loading="lazy" src="<?php echo esc_url( $section_collateral['url'] ); ?>" alt="<?php echo esc_attr( $section_collateral['alt'] ); ?>" />
					<?php endif; ?>
				</div>
			</div>

		<?php endwhile; ?>
<?php endif; ?>

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