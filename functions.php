<?php
/**
 * Flagship Tailwind functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flagship_Tailwind
 */

if ( ! defined( 'FLAGSHIP_TAILWIND_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'FLAGSHIP_TAILWIND_VERSION', '4.1.0' );
}

if ( ! function_exists( 'flagship_tailwind_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function flagship_tailwind_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Flagship Tailwind, use a find and replace
		 * to change 'flagship-tailwind' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'flagship-tailwind', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'flagship-tailwind' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'flagship_tailwind_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flagship_tailwind_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'flagship-tailwind' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'flagship-tailwind' ),
			'before_widget' => '<section id="%1$s" class="widget prose %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'flagship_tailwind_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue-scripts.php';


/**
 * Custom post type functions.
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Pagination
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Block Patterns
 */
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Sidebar Navigation
 */
require get_template_directory() . '/inc/sidebar-walker.php';

/**
 * Handle SVG icons
 */
require get_template_directory() . '/inc/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

/**
 * Custom script loader class
 */
require get_template_directory() . '/inc/class-twentytwenty-script-loader.php';

/**
 * Gutenberg Editor
 */
require get_template_directory() . '/inc/gutenberg.php';

/**
 * Gutenberg Editor
 */
require get_template_directory() . '/inc/acf-functions.php';
