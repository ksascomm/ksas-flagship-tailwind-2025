<?php
/**
 * Template part for displaying KSAS at a Glance content in page template front.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

?>
<section class="bg-heritage-blue bg-topography">
	<div class="container px-5 py-12 mx-auto xl:px-20">
		<div class="flex flex-col w-full mx-auto mb-4">
			<h1 class="mb-4 font-serif-bold font-bold text-3xl text-white">Faculty & Student Voices</h1>
		</div>
		<div class="grid grid-cols-1 xl:grid-cols-5 xl:gap-x-24">
			<div class="xl:col-span-3">
				<div class="aspect-video">
					<?php
					// 'Home' post ID
					$post_id = 807;

					// Get main video ID
					$mainid = get_field( 'main_video_id', $post_id );

					// Initialize array for video IDs
					$video_ids = array();

					if ( have_rows( 'youtube_video_ids', $post_id ) ) :
						while ( have_rows( 'youtube_video_ids', $post_id ) ) :
							the_row();
							$video_id = get_sub_field( 'individual_youtube_video_id' );
							if ( ! empty( $video_id ) ) {
								$video_ids[] = $video_id;
							}
						endwhile;
					endif;

					// Turn into comma-separated string
					$vdid = implode( ',', $video_ids );

					// Build and run the shortcode
					echo do_shortcode( '[yt_playlist mainid="' . esc_attr( $mainid ) . '" vdid="' . esc_attr( $vdid ) . '"]' );
					?>
				</div>
			</div>
			<div class="xl:col-span-2">
				<p class="py-12 text-2xl font-bold font-serif-bold prose text-white">
					Everyone from first-year students to tenured professors engages in hands-on research at the Krieger School: in labs, libraries, museums, and communities. See what kind of discoveries you can make.
				</p>
				<div class="my-4"><a href="<?php echo esc_url( site_url( '/our-community/research/' ) ); ?>" class="p-4 text-base font-bold bg-white border-none rounded-md text-heritage-blue font-heavy lg:text-lg hover:bg-spirit-blue hover:text-primary">Find Out More</a></div>
			</div>
		</div>
	</div>
</section>