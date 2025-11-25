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

<?php if ( have_rows( 'flip_cards' ) ) : ?>
	<div class="alignwide">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
			<?php while ( have_rows( 'flip_cards' ) ) : the_row(); ?>
				<div class="relative mb-4 focus-within:shadow-lg focus-visible:ring">
						<div class="p-12 block w-full h-full bg-<?php the_sub_field( 'card_front_color' ); ?>">
							<h2 class="font-heavy font-serif-bold text-white text-center">
								<div class="block">
									<?php the_sub_field( 'card_icon' ); ?>
								</div>
								<?php the_sub_field( 'card_title' ); ?>
							</h2>
							<p class="text-lg text-center text-white tracking-tight font-heavy font-bold">
								<?php the_sub_field( 'card_front' ); ?>
							</p>
						</div>
						<div class="absolute top-0 bottom-0 left-0 right-0 h-full w-full opacity-0 transition ease-in duration-200 flex flex-col justify-center bg-<?php the_sub_field( 'card_back_color' ); ?> hover:opacity-100 focus:opacity-100" id="<?php the_sub_field( 'card_title' ); ?>" tabindex="0">
							<div class="py-6 px-4 text-white text-base font-heavy font-bold">
								<?php the_sub_field( 'card_back' ); ?>
							</div>
						</div>
				</div>
				<?php endwhile; ?>
			<?php else : ?>
				<?php // No rows found ?>
		</div>
	</div>
<?php endif;?>
</div>
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
