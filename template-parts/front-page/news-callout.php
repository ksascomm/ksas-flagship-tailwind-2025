<?php
/**
 * Template part for displaying News posts in page template front.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */
?>
<?php
$homepage_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => '1',
	)
);
if (
$homepage_query->have_posts() ) :
	while ( $homepage_query->have_posts() ) :
		$homepage_query->the_post();
		$external_link = get_post_meta( get_the_ID(), 'ecpt_external_link', true );
		?>

<div class="relative z-10 self-end hidden col-span-1 mb-16 ml-8 short:hidden xl:block w-80 bg-heritage-blue/70">
	<div class="p-4 rounded-2xl">
		<span class="text-xl font-bold tracking-wide uppercase font-serif-bold text-gold">
			Spotlight
		</span>
			<?php
			the_post_thumbnail(
				'full',
				array(
					'class' => 'h-56 w-full object-cover py-4',
				)
			);
			?>
		<div class="tracking-[0.03rem] text-xl font-sans-bold font-bold text-white">
			<?php if ( $external_link ) : ?>
				<a class="underline hover:text-grey decoration-dotted hover:decoration-solid" 
					href="<?php echo esc_url( $external_link ); ?>" 
					target="_blank"
					data-gtm-element="spotlight-link"
					data-gtm-type="external"
					data-post-id="<?php the_ID(); ?>"
					data-post-title="<?php echo esc_attr( get_the_title() ); ?>">
					<?php the_title(); ?> <i class="fa-regular fa-square-up-right"></i>
				</a>
			<?php else : ?>
				<a class="underline hover:text-grey decoration-dotted hover:decoration-solid" 
					href="<?php the_permalink(); ?>"
					data-gtm-element="spotlight-link"
					data-gtm-type="internal"
					data-post-id="<?php the_ID(); ?>"
					data-post-title="<?php echo esc_attr( get_the_title() ); ?>">
					<?php the_title(); ?> <i class="fa-solid fa-circle-chevron-right fa-sm"></i>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>

		<?php
	endwhile;
	wp_reset_postdata();
endif;
?>