<?php
/**
 * Template part for displaying a photo collage  in page template front.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

?>
<div class="w-full overflow-hidden">
	<picture>
		<source 
			media="(min-width: 1024px)" 
			srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/collage-row.jpg"
		>
		<source 
			srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/collage-row-mobile.jpg"
		>
		<img 
			loading="lazy" 
			class="object-cover w-full h-40 transition-opacity duration-1000 ease-in-out opacity-0 lg:h-auto" 
			onload="this.classList.add('opacity-100')" 
			src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/collage-row.jpg" 
			alt="collage of students and faculty"
		>
	</picture>
</div>