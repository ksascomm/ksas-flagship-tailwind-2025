<?php
/**
 * Template part for displaying posts on blog page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Department_Tailwind
 */

?>
<article id="post-<?php the_ID(); ?>" 
<?php
post_class(
	'article-excerpt prose prose-sm lg:prose-lg border-b border-solid border-offset-2 border-grey pt-4 xl:-ml-4 mb-4 xl:pl-[2%] xl:pr-[2%] xl:transition-[margin] xl:duration-300 xl:ease-in-out xl:hover:ml-[2%] xl:hover:mr-[2%] hover:bg-grey-lightest max-w-[80ch] lg:max-w-[90ch] xl:max-w-[100ch]'
);
?>
aria-label="<?php the_title(); ?>">
	<div class="grid h-full grid-cols-1 gap-4 xl:grid-cols-5">
			<div class="order-2 
			<?php
			if ( has_post_thumbnail() ) :
				?>
				xl:col-span-3 
				<?php
				else :
					?>
					xl:col-span-5 <?php endif; ?> xl:order-1">
				<header class="entry-header">
					<?php
					if ( 'post' === get_post_type() ) :
						?>
						<div class="entry-meta">
							<?php
							if ( ! is_sticky() ) :
								flagship_tailwind_posted_on();
								endif;
							?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
					<?php 
					// Fetch the custom field value.
					$external_link = get_post_meta( get_the_ID(), 'ecpt_external_link', true );

					// Set the URL and the icon conditional.
					if ( ! empty( $external_link ) ) {
						$link_url = esc_url( $external_link );
						$icon     = ' <span class="fa-solid fa-square-up-right"></span>';
					} else {
						$link_url = esc_url( get_permalink() );
						$icon     = '';
					}

					// Output the title with the icon appended inside the link.
					the_title( '<h2 class="entry-title mt-2!"><a class="archive-post" href="' . $link_url . '" rel="bookmark">', $icon . '</a></h2>' );
					?>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<?php
						the_excerpt();
					?>
				</div><!-- .entry-content -->
			</div>
	<?php
	/**
	 * This differs from theme's post_thumbnail()
	 *
	 * See inc/template-tags.php for that function
	 */
	if ( has_post_thumbnail() ) :
		?>
			<div class="order-1 not-prose xl:order-2 xl:col-span-2">
				<?php
					the_post_thumbnail(
						'large',
						array(
							'class' => 'mb-4 lg:mt-0 xl:pl-4 xl:pr-4 max-w-lg',
							'alt'   => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</div>
		</div>
		<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
