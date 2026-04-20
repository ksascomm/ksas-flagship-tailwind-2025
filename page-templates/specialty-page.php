<?php
/**
 * Template Name: Speciality Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

get_header();
?>

<?php
$extra_classes = array();

// Check if the current post/page has a parent.
if ( ! empty( $post->post_parent ) ) {
	$extra_classes[] = 'child-page';
}

// Pass the array into the function. Check CSS for specific styles.
?>
	<main id="primary" class="w-full site-main">
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( $extra_classes ); ?>>
					<div class="mx-auto prose lg:prose-xl entry-content">

						<?php
						the_content();

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

				<?php
			endwhile;

		endif;
		?>

	</main><!-- #main -->


<?php
get_footer();
