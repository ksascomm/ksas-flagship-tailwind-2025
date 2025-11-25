<?php
/**
 * Template part for displaying People content in single-people.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

?>

<div class="xl:alignfull">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'mx-auto max-w-screen-xl border-grey border-solid border lg:border-none p-4 lg:px-0 lg:py-2 mt-4' ); ?>>
		<div class="grid grid-cols-3 lg:gap-8">
			<div class="col-span-3 lg:col-span-1">
				<div class="-mt-2 w-full">
				<?php if ( is_singular( 'people' ) ) : ?>
					<?php flagship_tailwind_post_thumbnail(); ?>
				<?php else : ?>
					<div class="hidden md:block lg:inline-block">
					<?php
						the_post_thumbnail(
							'full',
							array(
								'class' => 'w-full pt-4'
							)
						);
					?>
					</div>
				<?php endif; ?>
				</div>
			</div>
			<div class="col-span-3 lg:col-span-2">
			<?php if ( is_singular( 'people' ) ) : ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
					<h2 class="font-heavy font-bold"><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?></h2>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( is_page_template( 'page-templates/people-directory.php' ) ) : ?>
				<div class="prose prose-sm lg:prose-lg">
				<h2 class="font-heavy font-bold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<h3 class=""><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?></h3>
			<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_office', true ) ) : ?>
					<span class="fa-solid fa-location-dot" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_office', true ) ); ?><br>
				<?php endif; ?>

				<?php if ( get_post_meta( $post->ID, 'ecpt_phone', true ) ) : ?>
					<span class="fa-solid fa-phone-office" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_phone', true ) ); ?><br>
				<?php endif; ?>

				<?php
				if ( get_post_meta( $post->ID, 'ecpt_email', true ) ) :
					$email = get_post_meta( $post->ID, 'ecpt_email', true );
					?>
					<span class="fa-solid fa-envelope" aria-hidden="true"></span>
					<a href="<?php echo esc_url( 'mailto:' . antispambot( $email ) ); ?>">
						<?php echo esc_html( $email ); ?>
					</a>
				<?php endif; ?>
				</div>
			</div>
			<?php if ( is_singular( 'people' ) ) : ?>
			<div class="col-span-3">
				<?php echo get_post_meta( $post->ID, 'ecpt_bio', true ); ?>
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
</div>