<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flagship_Tailwind
 */

?>

	<footer style="background-image:url('<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/ksas-footer.jpg');" class="relative h-auto lg:h-[35rem] text-white site-footer bg-heritage-blue flex items-center justify-center bg-cover
	<?php
	if ( ! is_front_page() ) :
		?>
		mt-20
	<?php endif; ?>
	">
	<div class="max-w-[95vw] w-full px-6 mx-auto xl:mx-20">
		<div class="grid grid-cols-1 gap-6 pt-8 site-info lg:grid-cols-2">
			<div class="flex justify-center lg:justify-start">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/krieger.logo.cropped.svg" class="w-[55%] md:w-[40%] lg:w-[60%] xl:w-[45%] 2xl:w-[35%] h-auto xl:p-5" alt="KSAS Shield, to the homepage">
			</div>
			<!-- Shield -->
			<div class="flex flex-wrap justify-center pt-6 lg:justify-end lg:ml-40">
				<a class="pr-4" href="https://facebook.com/JHUArtsSciences"><span class="fa-brands fa-facebook fa-2x hover:text-spirit-blue"></span><span class="screen-reader-text">Follow us on Facebook</span></a>
				<a class="pr-4" href="https://www.instagram.com/JHUArtsSciences/"><span class=" fab fa-instagram fa-2x hover:text-spirit-blue"></span><span class="screen-reader-text">Follow us on Instagram</span></a>
				<a class="pr-4" href="https://bsky.app/profile/jhuartssciences.bsky.social"><span class="fa-brands fa-bluesky fa-2x hover:text-spirit-blue"></span><span class="screen-reader-text">Follow us on Bluesky</span></a>
				<a class="pr-4" href="https://www.youtube.com/user/jhuksas"><span class="fa-brands fa-youtube fa-2x hover:text-spirit-blue"></span><span class="screen-reader-text">Follow us on YouTube</span></a>
				<a class="xl:pr-4" href="https://www.tiktok.com/@jhuartssciences"><span class="fa-brands fa-tiktok fa-2x hover:text-spirit-blue"></span><span class="screen-reader-text">Follow us on TikTok</span></a>
			</div>
			<!--Address -->
			<div class="p-4 text-center lg:text-left">
				<p class="font-bold font-heavy">Johns Hopkins University<br>Zanvyl Krieger School of Arts & Sciences<br>3400 N. Charles Street<br>Baltimore, MD 21218</p>
			</div>
			<!-- Quicklinks -->
			<div class="flex text-center lg:text-left flex-wrap justify-center pt-6 lg:justify-end lg:ml-40">
				<ul class="font-bold font-heavy">
					<li><a href="https://apply.jhu.edu/">Apply</a> <span class="fa fa-external-link"></span></li>
					<li><a href="https://jhu.edu">Johns Hopkins University</a> <span class="fa fa-external-link"></span></li>
					<li><a href="https://www.jhu.edu/contact/">Contact Us</a> <span class="fa fa-external-link"></span></li>

				</ul>
			</div>
			<!-- Divider full-width row 
			<div class="my-4 border-t border-white col-span-full w-[78%] xl:ml-12 mx-auto lg:mx-0"></div>-->
			<!-- Legal Stuff -->
			<div class="mt-8 mx-auto text-center col-span-full">
			<h2 class="sr-only">Legal Navigation</h2>
			<ul class="flex flex-wrap justify-center" role="menu" aria-label="University Policies" id="footer-quicklinks-2">
				<li class="pl-3 pr-2" role="menuitem"><a class="text-white font-sans font-regular" href="https://accessibility.jhu.edu/">Accessibility</a> <i class="fa-solid fa-arrow-up-right-from-square"></i></li>
				<li class="px-2" role="menuitem"><a class="text-white font-sans font-regular" href="https://it.johnshopkins.edu/policies/privacystatement">Privacy Statement</a> <i class="fa-solid fa-arrow-up-right-from-square"></i></li>
				<li class="px-2" role="menuitem"><a class="text-white font-sans font-regular" href="https://policies.jhu.edu/">University Policies</a> <i class="fa-solid fa-arrow-up-right-from-square"></i></li>
			</ul>
			<!-- Copyright -->
			<p>	&copy; <?php print gmdate( 'Y' ); ?> Johns Hopkins University. All rights reserved.</p>
			</div>
	</div><!-- .site-info -->
	</div>
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
