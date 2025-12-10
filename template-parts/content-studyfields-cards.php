<?php
/**
 * Template part for displaying study fields cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

?>

<?php
$program_types = get_the_terms( $post->ID, 'program_type' );
// print_r($program_types);
if ( $program_types && ! is_wp_error( $program_types ) ) :
	$program_type_names = array();
	foreach ( $program_types as $program_type ) {
		$program_type_names[] = $program_type->slug;
	}
	$program_type_name = join( ' ', $program_type_names );
endif;
?>
<div class="w-full md:w-1/2 lg:w-1/3 p-6 box-border lg:h-72 <?php echo esc_html( $program_type_name ); ?> 
	<?php
	$terms = get_the_terms( get_the_ID(), 'interest-area' );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			echo esc_html( $term->slug ) . ' ';
		}
	}
	?>
item">
	<a class="field-text-link " href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_homepage', true ) ); ?>" id="post-<?php the_ID(); ?>">
		<div class="relative z-10 flex flex-col justify-between lg:h-full transition shadow-md group
			<?php
			if ( $program_type_name == 'aap' ) :
					echo 'bg-homewood-green hover:bg-mint-green';
				else :
					echo 'bg-heritage-blue hover:bg-medium-blue';
				endif;
				?>
				">
			<div class="flex flex-col flex-grow p-2 pb-10 -translate-x-5 -translate-y-5 bg-white border shadow-md border-grey field">
				<div class="p-2">
					<h2 class="mb-3 text-xl font-bold font-serif-bold">
						<?php the_title(); ?>
					</h2>
					<div class="items-center flex-grow offerings">
						<?php if ( get_post_meta( $post->ID, 'ecpt_majors', true ) ) : ?>
							<span class="inline-block pr-1 text-lg font-bold text-medium-blue border-primary font-heavy offering">Major 
							<?php
								$undergraduate_degree_type_checked_labels = get_field( 'undergraduate_degree_type' );
							if ( $undergraduate_degree_type_checked_labels ) {
								echo '(';
								foreach ( $undergraduate_degree_type_checked_labels as $undergraduate_degree_type_label ) {
									echo '<span class="comma">' . esc_html( $undergraduate_degree_type_label ) . '</span>';
								}
								echo ')';
							}
							?>
							</span>
						<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'ecpt_majors', true ) && get_post_meta( $post->ID, 'ecpt_minors', true ) ) : ?>
							<span class="inline-block pr-1 text-lg font-bold text-medium-blue border-primary font-heavy offering">&bull;</span>
						<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'ecpt_minors', true ) ) : ?>
							<span class="inline-block pr-1 text-lg font-bold text-medium-blue border-primary font-heavy offering">Minor</span>
						<?php endif; ?>

						<?php $combined_degree_type_checked_labels = get_field( 'combined_degree_type' ); ?>
						<?php if ( $combined_degree_type_checked_labels ) : ?>
							<span class="block pr-1 text-lg font-bold text-medium-blue border-primary font-heavy offering">Combined Degree (<?php
							foreach ( $combined_degree_type_checked_labels as $combined_degree_type_label ) {
								echo '<span class="comma">' . esc_html( $combined_degree_type_label ) . '</span>';
							}
							?>)</span>
						<?php endif; ?>
						
						<?php $graduate_degree_type_checked_labels = get_field( 'graduate_degree_type' ); ?>
						<?php if ( $graduate_degree_type_checked_labels ) : ?>
							<span class="block pr-1 text-lg font-bold text-medium-blue border-primary font-heavy offering">
							<?php
							if ( is_array( $graduate_degree_type_checked_labels ) && in_array( 'Certificate', $graduate_degree_type_checked_labels ) ) {
								echo 'Graduate Certificate';
							} else {
								echo 'Graduate Degree (';
								foreach ( $graduate_degree_type_checked_labels as $graduate_degree_type_label ) {
									echo '<span class="comma">' . esc_html( $graduate_degree_type_label ) . '</span>';
								}
								echo ')';
							}
							?>
							</span>
						<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_pcitext', true ) ) : ?>
							<p class="hidden pt-2 text-base lg:block"><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pcitext', true ) ); ?></p>
						<?php endif; ?>
					</div>
				</div>
				<div class="absolute bottom-0 w-full text-lg font-bold text-right transition-all duration-300 transform translate-y-0 opacity-100 -left-4 md:translate-y-6 md:opacity-0 md:group-hover:translate-y-0 md:group-hover:opacity-100 font-heavy">
					<?php if ( ! empty( $program_type_names ) && in_array( 'aap', $program_type_names, true ) ) : ?>
						<span class="px-4 text-sm lg:text-base">Advanced Academic Programs <i class="icon-new-tab2"></i></span>
					<?php else: ?>
						View Website <i class="icon-new-tab2"></i>
					<?php endif; ?>
				</div>
				<span class="hidden"><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_keywords', true ) ); ?></span>
			</div>
		</div>
	</a>
</div>