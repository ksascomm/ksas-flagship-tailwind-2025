<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flagship_Tailwind
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="date" content="<?php the_modified_date(); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5VTN64C');</script>
	<!-- End Google Tag Manager -->
	<meta name="facebook-domain-verification" content="s1lj448peh4wqw24bgcc5f2t6n23tc" />
</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5VTN64C"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php wp_body_open(); ?>
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'flagship-tailwind' ); ?></a>
	<div class="relative z-[1000] w-full border-b-8 border-medium-blue">
		<?php
		if ( is_front_page() ) :
			?>
			<?php get_template_part( 'template-parts/jhu-150th-bar-white' ); ?>
			<?php
	else :
		?>
		<?php get_template_part( 'template-parts/jhu-150th-bar-white' ); ?>
	<?php endif; ?>
	</div>
	<header id="site-header" class="absolute top-0 left-0 content-center justify-between w-full header-footer-group sm:items-baseline md:flex-row sm:text-left
	<?php
	if ( is_front_page() ) :
		?>
		bg-transparent
		<?php
	else :
		?>
		bg-white 
		<?php endif; ?>" 
	role="banner">
		<div class="header-titles-wrapper">
			<div class="header-inner section-inner">
				<div class="header-titles sm:grid sm:grid-cols-1 sm:gap-x-12 lg:flex lg:justify-between">
					<div class="flex flex-col self-center md:flex-row">
						<div class="h-auto mx-auto mt-4 mb-8 shield lg:my-0">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"  aria-label="Krieger Home">
								<?php
								if ( is_front_page() ) :
									?>
									<div class="hidden lg:block">
										<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/krieger.logo.cropped.svg" class="w-full h-auto p-5" alt="KSAS Shield, to the homepage">
									</div>
									<div class="block p-5 lg:hidden">
										<?php echo file_get_contents( get_template_directory() . '/dist/images/krieger.logo.horizontal.blue.svg' ); ?>
									</div>
									<?php
								else :
									?>
									<div class="p-5">
										<span class="sr-only">Krieger Home</span>
										<?php echo file_get_contents( get_template_directory() . '/dist/images/krieger.logo.horizontal.blue.svg' ); ?>
									</div>
								<?php endif; ?>
							</a>
						</div>
					</div>
					<div class="self-center text-lg font-bold desktop-menu sm:mb-0 font-heavy">
						<div class="flex flex-col my-4 md:flex-row-reverse" id="header-quicklinks">
							<a class="px-3 py-2 text-xs text-center text-white uppercase hover:bg-medium-blue sm:my-4 md:my-0" href="https://magazine.krieger.jhu.edu">Arts & Sciences Magazine <i class="icon-new-tab2"></i></a>
							<i class="px-2 mt-2 text-white fa-solid fa-pipe"></i>
							<a class="px-3 py-2 text-xs text-center text-white uppercase hover:bg-medium-blue sm:my-4 md:my-0" href="<?php echo esc_url( site_url( '/about/giving/' ) ); ?>">Giving</a>
							<i class="px-2 mt-2 text-white fa-solid fa-pipe"></i>
							<a class="px-3 py-2 text-xs text-center text-white uppercase hover:bg-medium-blue sm:my-4 md:my-0" href="<?php echo esc_url( site_url( '/academics/apply/' ) ); ?>">Admissions</a>
						</div>
						<div class="flex flex-col my-4 md:flex-row-reverse">
							<div class="mr-3 rounded-md">
								<form method="GET" action="<?php echo esc_url( site_url( '/search' ) ); ?>" role="search" aria-label="Site Search" class="bg-white rounded-md shadow-md site-search sm:mb-2 lg:mb-0">
									<input type="text" value="<?php echo get_search_query(); ?>" name="q" class="!pl-[6px] text-sm text-primary w-60" id="mobile-search" placeholder="Search this site..." aria-label="search"/>
									<label for="mobile-search" class="screen-reader-text">
										Search This Website
									</label>
									<button type="submit" class="px-4 py-2 text-sm font-bold text-white border border-transparent shadow-md rounded-r-md font-heavy bg-medium-blue hover:bg-heritage-blue" aria-label="search"><span class="fa-solid fa-magnifying-glass"></span></button>
								</form>
							</div>
						</div>
						<div role="navigation" class="header-navigation-wrapper lg:mr-6 xl:-mr-[1.125rem] xl:overflow-x-hidden">
							<ul id="default-menu" class="flex flex-row mt-0 text-white " aria-label="<?php _e( 'Main Menu', 'textdomain' ); ?>">
								<li class="grow lg:mr-2">
									<a href="<?php echo esc_url( site_url( '/academics/departments-programs-and-centers/' ) ); ?>" class="block px-4 py-2 text-sm font-bold text-center uppercase font-heavy hover:bg-medium-blue ">Departments & Programs</a>
								</li>								
								<li class="grow lg:mr-2">
									<a href="<?php echo esc_url( site_url( '/academics/fields/' ) ); ?>" class="block px-4 py-2 text-sm font-bold text-center uppercase font-heavy hover:bg-medium-blue">Fields of Study</a>
								</li>
								<li class="grow lg:mr-2">
									<a href="<?php echo esc_url( site_url( '/academics/majors-minors/' ) ); ?>" class="block px-4 py-2 text-sm font-bold text-center uppercase font-heavy hover:bg-medium-blue">Majors & Minors</a>
								</li>
									<li class="grow lg:mr-2">
									<a href="<?php echo esc_url( site_url( '/our-community/research/' ) ); ?>" class="block px-4 py-2 text-sm font-bold text-center uppercase font-heavy hover:bg-medium-blue">Research</a>
								</li>
								<li class="grow">
									<div class="pb-1 header-toggles hide-no-js">
										<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">
											<button class="block text-center text-white toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
											<span class="toggle-inner">
												<span class="toggle-text pr-1.5 !font-heavy !font-bold"><?php esc_attr_e( 'Menu', 'twentytwenty' ); ?></span>
												<span class="fa-solid fa-bars -mt-0.5"></span>
											</span>
										</button><!-- .nav-toggle -->
									</div><!-- .nav-toggle-wrapper -->
									</div><!-- .header-toggles -->
								</li>
							</ul>
						</div>
					</div>
				</div><!-- .header-titles -->
				<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false" type="button">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php twentytwenty_the_theme_svg( 'search' ); ?>
						</span>
						<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'ksas-blocks' ); ?></span>
					</span>
				</button><!-- .search-toggle -->
				<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle" type="button">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
						</span>
						<span class="toggle-text"><?php _e( 'Menu', 'ksas-blocks' ); ?></span>
					</span>
				</button><!-- .nav-toggle -->
			</div><!-- .header-inner -->
		</div><!-- .header-titles-wrapper -->
		<?php
			get_template_part( 'inc/modal-search' );
		?>
	</header><!-- #site-header -->
	<?php
	get_template_part( 'inc/modal-menu' );
