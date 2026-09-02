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
	define( 'FLAGSHIP_TAILWIND_VERSION', '4.3.0' );
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
 * ACF Functions
 */
require get_template_directory() . '/inc/acf-functions.php';

/**
 * Functions for Vite development server integration. This allows for hot module replacement and live reloading during development.
 */
function enqueue_vite_development_assets() {
	$vite_server = 'http://localhost:5173';
	$is_dev      = false;

	// Check if Vite server is running on port 5173.
	$connection = @fsockopen( '127.0.0.1', 5173, $errno, $errstr, 0.05 );
	if ( $connection ) {
		$is_dev = true;
		fclose( $connection );
	}

	if ( $is_dev ) {
		// 1. Convert enqueued script tag to type="module".
		add_filter(
			'script_loader_tag',
			function ( $tag, $handle, $src ) {
				if ( $handle === 'vite-client' ) {
					return '<script type="module" src="' . esc_url( $src ) . '"></script>';
				}
				return $tag;
			},
			10,
			3
		);

		// 2. Enqueue the Vite client script.
		wp_enqueue_script( 'vite-client', $vite_server . '/@vite/client', array(), null, false );

		// 3. Enqueue Tailwind CSS directly through Vite
		wp_enqueue_style( 'theme-tailwind-dev', $vite_server . '/resources/css/style.css', array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'enqueue_vite_development_assets' );

/**
 * Add type="module" to Vite scripts in dev mode.
 */
function flagship_add_vite_module_type( $tag, $handle, $src ) {
	if ( in_array( $handle, array( 'vite-client', 'theme-tailwind-dev-js' ), true ) ) {
		return sprintf( '<script type="module" src="%s"></script>', esc_url( $src ) );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'flagship_add_vite_module_type', 10, 3 );

/**
 * Force /search requests to use search.php.
 */
function flagship_custom_search_rewrite() {
	add_rewrite_rule( '^search/?$', 'index.php?pagename=search', 'top' );
}
add_action( 'init', 'flagship_custom_search_rewrite' );

function flagship_custom_search_template( $template ) {
	if ( is_page( 'search' ) ) {
		$search_template = locate_template( 'search.php' );
		if ( ! empty( $search_template ) ) {
			return $search_template;
		}
	}
	return $template;
}
add_filter( 'template_include', 'flagship_custom_search_template' );
