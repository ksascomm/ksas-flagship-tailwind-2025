<?php
/**
 * Template part for displaying study fields cards
 *
 * @package Flagship_Tailwind
 */

// 1. Gather Data at the top
$ksas_current_id = get_the_ID();
$program_types   = get_the_terms( $ksas_current_id, 'program_type' );
$interest_areas  = get_the_terms( $ksas_current_id, 'interest-area' );
$homepage_url    = get_post_meta( $ksas_current_id, 'ecpt_homepage', true );
$pci_text        = get_post_meta( $ksas_current_id, 'ecpt_pcitext', true );
$keywords        = get_post_meta( $ksas_current_id, 'ecpt_keywords', true );
$has_majors      = get_post_meta( $ksas_current_id, 'ecpt_majors', true );
$has_minors      = get_post_meta( $ksas_current_id, 'ecpt_minors', true );

// 2. Prepare Taxonomy Classes
$program_slugs    = ( ! is_wp_error( $program_types ) && $program_types ) ? wp_list_pluck( $program_types, 'slug' ) : array();
$interest_slugs   = ( ! is_wp_error( $interest_areas ) && $interest_areas ) ? wp_list_pluck( $interest_areas, 'slug' ) : array();
$all_item_classes = implode( ' ', array_merge( $program_slugs, $interest_slugs ) );

// 3. Logic for conditional colors
$is_aap   = in_array( 'aap', $program_slugs, true );
$bg_class = $is_aap ? 'bg-homewood-green hover:bg-mint-green' : 'bg-heritage-blue hover:bg-medium-blue';
?>

<div class="w-full p-6 box-border md:w-1/2 lg:w-1/3 lg:h-72 item <?php echo esc_attr( $all_item_classes ); ?>">
	<a class="field-text-link group focus:outline-none" 
		href="<?php echo esc_url( $homepage_url ); ?>" 
		aria-labelledby="title-<?php echo esc_attr( $ksas_current_id ); ?>">
		
		<div class="relative z-10 flex flex-col justify-between transition shadow-md group lg:h-full <?php echo esc_attr( $bg_class ); ?>">
			
			<div class="flex flex-col p-2 pb-10 transition-all duration-300 ease-out -translate-x-4 -translate-y-4 bg-white border shadow-md grow group-hover:-translate-y-6 group-hover:-translate-x-6 group-focus-within:-translate-y-6 group-focus-within:-translate-x-6 border-grey field group-focus-within:ring-4 group-focus-within:ring-medium-blue">
				<div class="p-2">
					<h2 id="title-<?php echo esc_attr( $ksas_current_id ); ?>" class="mb-3 text-xl font-weight-semibold font-serif-semibold">
						<?php the_title(); ?>
					</h2>

					<div class="items-center grow offerings">
						
						<?php if ( $has_majors ) : ?>
							<span class="inline-block pr-1 text-lg text-medium-blue border-primary font-serif-semibold offering">
								Major 
								<?php
								$undergrad_degrees = get_field( 'undergraduate_degree_type' );
								if ( $undergrad_degrees ) {
									echo '(' . esc_html( implode( ', ', $undergrad_degrees ) ) . ')'; }
								?>
							</span>
						<?php endif; ?>

						<?php if ( $has_majors && $has_minors ) : ?>
							<span class="inline-block pr-1 text-lg font-weight-semibold text-medium-blue font-serif-semibold offering" aria-hidden="true">&bull;</span>
						<?php endif; ?>

						<?php if ( $has_minors ) : ?>
							<span class="inline-block pr-1 text-lg font-weight-semibold text-medium-blue font-serif-semibold offering">Minor</span>
						<?php endif; ?>

						<?php $combined_degrees = get_field( 'combined_degree_type' ); ?>
						<?php if ( $combined_degrees ) : ?>
							<span class="block pr-1 text-lg font-weight-semibold text-medium-blue font-serif-semibold offering">
								Combined Degree (<?php echo esc_html( implode( ', ', $combined_degrees ) ); ?>)
							</span>
						<?php endif; ?>
						
						<?php $grad_degrees = get_field( 'graduate_degree_type' ); ?>
						<?php
						// 1. Define/Initialize the variable first
						$graduate_degree_type_checked_labels = get_field( 'graduate_degree_type' );

						// 2. Ensure it's an array so in_array() doesn't crash
						$graduate_degrees = is_array( $graduate_degree_type_checked_labels ) ? $graduate_degree_type_checked_labels : array();

						// 3. Now perform the strict check
						if ( in_array( 'Certificate', $graduate_degrees, true ) ) :
							?>
							<span class="block pr-1 text-lg font-weight-semibold text-medium-blue border-primary font-serif-semibold offering">
								Graduate Certificate
							</span>
						<?php elseif ( ! empty( $graduate_degrees ) ) : ?>
							<span class="block pr-1 text-lg font-weight-semibold text-medium-blue border-primary font-serif-semibold offering">
								Graduate Degree (<?php echo esc_html( implode( ', ', $graduate_degrees ) ); ?>)
							</span>
						<?php endif; ?>

						<?php if ( $pci_text ) : ?>
							<p class="hidden pt-2 text-base lg:block"><?php echo esc_html( $pci_text ); ?></p>
						<?php endif; ?>
					</div>
				</div>

				<div class="absolute bottom-0 w-full text-lg text-right transition-all duration-500 ease-in-out transform translate-y-4 opacity-0 font-weight-semibold -left-4 group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:translate-y-0 group-focus-within:opacity-100 font-serif-semibold">
					<span class="px-4 text-sm lg:text-base">
						<?php echo $is_aap ? 'Advanced Academic Programs' : 'View Website'; ?>
						<i class="transition-transform duration-300 icon-new-tab2 group-hover:translate-x-1 group-focus-within:translate-x-1" aria-hidden="true"></i>
					</span>
				</div>

				<span class="hidden"><?php echo esc_html( $keywords ); ?></span>
			</div>
		</div>
	</a>
</div>