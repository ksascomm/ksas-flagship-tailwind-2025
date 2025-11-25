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
		?>

<div class="relative z-10 col-span-1 self-end hidden short:hidden xl:block mb-24 ml-8 h-80 w-80 bg-heritage-blue/70">
	<div class="p-4 rounded-2xl">
		<span class="text-xl font-bold tracking-wide uppercase font-serif-bold text-gold">
			Spotlight
		</span>
			<?php
			the_post_thumbnail(
				'full',
				[
					'class' => 'h-56 w-full object-cover py-4',
				]
			);
			?>
		<div class="tracking-[0.03rem] text-xl font-heavy font-bold text-white ">
			<?php if ( get_post_meta( $post->ID, 'ecpt_location', true ) ) : ?>
				<a class="hover:text-grey underline decoration-dotted hover:decoration-solid" href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_location', true ) ); ?>" target="_blank"><?php the_title(); ?> <i class="fa-regular fa-arrow-up-right-from-square"></i></a>
			<?php else : ?>
				<a class="hover:text-grey underline decoration-dotted hover:decoration-solid" href="<?php the_permalink(); ?>"><?php the_title(); ?> <i class="fa-solid fa-circle-chevron-right fa-sm"></i></a>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
	endwhile;
endif;
?>