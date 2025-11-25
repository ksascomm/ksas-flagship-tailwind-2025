<?php
/**
 * Template part for displaying Magazine API content categorized as Cover Story in page template front.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

// Get the Feature taxonomy ID.
$latest_callout_url = 'https://magazine.krieger.jhu.edu/wp-json/wp/v2/pages?_fields=title,link,acf,categories&volume=369&categories=136&orderby=modified&order=asc';


$latest_callout = wp_remote_get( $latest_callout_url );

// Display a error nothing is returned.
if ( is_wp_error( $latest_callout ) ) {
	$callout_error_string = $latest_callout->get_error_message();
	echo '<script>console.log("Error:' . esc_html( $callout_error_string ) . '")</script>';
}

// Get the body.
$callouts = json_decode( wp_remote_retrieve_body( $latest_callout ) );
// Display a warning nothing is returned.
if ( empty( $callouts ) ) {
	echo '<script>console.log("Error: There is no Features content")</script>';
}
// If there are posts then display them!
if ( ! empty( $callouts ) ) :?>
<div class="relative z-10 self-end hidden col-span-1 mb-12 ml-8 xl:block h-80 w-80 bg-heritage-blue/70 short:hidden">
		<?php foreach ( $callouts as $callout ) : ?>
		
			<div class="p-4 rounded-2xl">
				<span class="text-xl font-bold tracking-wide uppercase font-serif-bold text-gold">
					Spotlight
				</span>
				<img class="w-full py-4" src="<?php echo esc_url( $callout->acf->ecpt_header_background ); ?>">
				<div class="text-2xl font-semi text-white font-semi">
					<?php echo esc_html( $callout->title->rendered ); ?>
				</div>
				<div>
					<a class="text-xl italic font-semi font-semi text-gold hover:underline hover:underline-offset-2" href="https://magazine.krieger.jhu.edu">
						Arts & Sciences Magazine <span class="pl-1 fa-regular fa-square-up-right"></span>
					</a>
				</div>
			</div>
		
		<?php endforeach; ?>
</div>
<?php endif; ?>
