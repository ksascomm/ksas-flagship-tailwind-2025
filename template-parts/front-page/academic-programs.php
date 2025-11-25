<?php
/**
 * Template part for displaying two rows of academic offerings in page template front.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flagship_Tailwind
 */

?>
<section class="container px-5 py-3 mx-auto mb-10 bg-white xl:py-12 xl:px-20 h-fit xl:mb-0">
	<!-- Start Undergraduate Path -->
	<div class="pt-10 lg:pt-20"></div>
	<div class="flex flex-wrap px-5 xl:px-20">
		<div class="w-full lg:w-1/3">
			<figure><img loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/path-undergraduate.svg" alt="image of a path with a map and a marker" class="mx-auto w-xs xl:w-full"/></figure>
		</div>
		<div class="w-full lg:w-2/3 lg:px-8">
			<h2 class="text-3xl font-serif-bold text-medium-blue">
				<span class="fa-stack fa-md" style="font-size: 1rem;">
					<i class="fa-solid fa-circle fa-stack-2x"></i>
					<i class="fa-solid fa-arrow-down fa-stack-1x fa-inverse"></i>
				</span>
				Choose your undergraduate path
				<small class="text-[90%]"><br>60+ degree programs</span></small>
			</h2>
			<p class="py-4 text-lg xl:text-2xl">Undergraduate students at the Krieger School major or double major in biology, physics, writing, economics, history, and more. Our programs encourage lifelong learning, foster independent and original research, and connect students with faculty doing groundbreaking work.</p>
			<div class="my-4">
				<ul class="prose uppercase">
					<li><a class="!text-sais-blue hover:!text-primary font-heavy font-bold " href="<?php echo esc_url( site_url( '/academics/fields/#program_type=undergrad_program' ) ); ?>"><i class="fa-solid fa-square"></i> Undergraduate Programs</a></li>
					<li><a class="!text-sais-blue hover:!text-primary font-heavy font-bold"  href="<?php echo esc_url( site_url( '/academics/majors-minors/' ) ); ?>"><i class="fa-solid fa-square"></i> Majors and minors</a></li>
					<li><a class="!text-sais-blue hover:!text-primary font-heavy font-bold"  href="https://undergrad.krieger.jhu.edu/"><i class="fa-solid fa-square"></i> Krieger undergraduate experience <i class="icon-new-tab2"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- End Undergradute Path -->
	<div class="py-10 lg:py-20"></div>
	<!-- Start Graduate Path -->
	<div class="flex flex-wrap xl:px-20">
		<div class="order-2 w-full lg:w-2/3 lg:px-8 lg:order-1">
			<h2 class="text-3xl font-serif-bold text-medium-blue">
				<span class="fa-stack fa-md" style="font-size: 1rem;">
					<i class="fa-solid fa-circle fa-stack-2x"></i>
					<i class="fa-solid fa-arrow-down fa-stack-1x fa-inverse"></i>
				</span>
				Discovery-focused graduate work
				<small class="text-[90%]"><br>30+ master’s and doctoral programs</small>
			</h2>
			<p class="py-4 text-lg xl:text-2xl">Master’s and doctoral students at the Krieger School work closely with key faculty to build their own research, improve teaching skills, and contribute to pioneering work. Our graduate students are a vital part of our academic programs.</p>
			<div class="my-4">
				<ul class="font-bold prose uppercase font-heavy">
					<li><a class="!text-sais-blue hover:!text-primary font-heavy font-bold " href="<?php echo esc_url( site_url( '/academics/masters-doctorates' ) ); ?>"><i class="fa-solid fa-square"></i> Full-time master’s and doctoral programs </a></li>
					<li><a class="!text-sais-blue hover:!text-primary font-heavy font-bold "  href="<?php echo esc_url( site_url( '/academics/departments-programs-and-centers/' ) ); ?>"><i class="fa-solid fa-square"></i> Academic departments</a></li>
					<li><a class="!text-sais-blue hover:!text-primary font-heavy font-bold "  href="<?php echo esc_url( site_url( '/our-community/research/' ) ); ?>"><i class="fa-solid fa-square"></i> Research at the Krieger School</a></li>
					<li><a class="!text-sais-blue hover:!text-primary font-heavy font-bold "  href="https://advanced.jhu.edu/"><i class="fa-solid fa-square"></i> Professional master's programs <i class="icon-new-tab2"></i></a></li>
					
				</ul>
			</div>
		</div>
		<div class="order-1 w-full lg:w-1/3 lg:order-2">
			<figure><img loading="lazy" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/path-graduate.svg" alt="image of multicolored, interconnected puzzles" class="mx-auto w-xs xl:w-full"/></figure>
		</div>
	</div>
</section>
