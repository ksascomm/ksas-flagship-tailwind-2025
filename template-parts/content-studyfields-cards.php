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
<div class="p-2 w-full md:w-1/3 <?php echo esc_html( $program_type_name ); ?> 

		<?php
		$terms = get_the_terms( get_the_ID(), 'interest-area' );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				echo esc_html( $term->slug ) . ' ';
			}
		}
		?>

item">
	<div class="h-full overflow-hidden border rounded-md field border-grey bg-gradient-to-b from-white to-grey-lightest">
		<div class="p-4">
			<h2 class="mb-3 text-2xl font-bold font-serif-bold">
				<?php if ( 'Pre-Med' === $post->post_title ) : ?>
					<a class="field-text-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				<?php else : ?>
					<a class="field-text-link" href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_homepage', true ) ); ?>"><?php the_title(); ?></a>
				<?php endif; ?>
			</h2>
			<div class="items-center offerings">
				<?php if ( get_post_meta( $post->ID, 'ecpt_majors', true ) ) : ?>
					<span class="inline-block pr-1 text-lg font-bold text-medium-blue border-primary font-heavy offering">Major <?php
						$undergraduate_degree_type_checked_labels = get_field( 'undergraduate_degree_type' );
						if ( $undergraduate_degree_type_checked_labels ) {
							echo '(';
							foreach ( $undergraduate_degree_type_checked_labels as $undergraduate_degree_type_label ) {
								echo '<span class="comma">' . esc_html( $undergraduate_degree_type_label ) . '</span>';
							}
							echo ')';
						}
					?></span>
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
					<span class="block pr-1 text-lg font-bold text-medium-blue border-primary font-heavy offering"><?php
						if ( is_array( $graduate_degree_type_checked_labels ) && in_array( 'Certificate', $graduate_degree_type_checked_labels ) ) {
							echo 'Graduate Certificate';
						} else {
							echo 'Graduate Degree (';
							foreach ( $graduate_degree_type_checked_labels as $graduate_degree_type_label ) {
								echo '<span class="comma">' . esc_html( $graduate_degree_type_label ) . '</span>';
							}
							echo ')';
						}
					?></span>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_pcitext', true ) ) : ?>
					<p class="pt-2 text-base"><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pcitext', true ) ); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<span class="hidden"><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_keywords', true ) ); ?></span>
	</div>
</div>
