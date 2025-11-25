<?php
/**
 * Template part for displaying a photo collage  in page template front.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

?>
<div class="w-full">
	<img loading="lazy" class=" transition-opacity duration-1000 ease-in-out opacity-0 h-40 object-cover xl:h-auto" onload="this.classList.add('opacity-100')" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/collage-row.jpg" alt="collage of students and faculty">
</div>
