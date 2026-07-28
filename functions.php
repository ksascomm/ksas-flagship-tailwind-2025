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
	define( 'FLAGSHIP_TAILWIND_VERSION', '4.0.0' );
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
function flagship_tailwind_scripts() {
	$css_path = get_template_directory() . '/dist/css/style.css';
	$js_path  = get_template_directory() . '/dist/js/bundle.min.js';

	// Use filemtime for both to force-refresh browsers on every save.
	wp_enqueue_style( 'flagship-tailwind-style', get_template_directory_uri() . '/dist/css/style.css', array(), filemtime( $css_path ) );

	wp_style_add_data( 'flagship-tailwind-style', 'rtl', 'replace' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/72c92fef89.js', array(), '6.5.2', false );

	wp_enqueue_script( 'google-cse', 'https://cse.google.com/cse.js?cx=012258670098148303364:zptrsb24qaq', array(), FLAGSHIP_TAILWIND_VERSION, false );

	wp_enqueue_script(
		'siteimprove',
		'https://siteimproveanalytics.com/js/siteanalyze_11464.js',
		array(),
		'1.0.0',
		array(
			'strategy'  => 'async',
			'in_footer' => true,
		)
	);

	wp_enqueue_script( 'flagship-tailwind-script', get_template_directory_uri() . '/dist/js/bundle.min.js', array( 'jquery' ), filemtime( $js_path ), true );

	// Localize for AJAX (Pass the nonce to your JS).
	wp_localize_script(
		'flagship-tailwind-script',
		'fsu_ajax',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'studyfields_filter_nonce' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'flagship_tailwind_scripts' );

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
 * ACF Options Page
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

}

/**
 * Minify page/post specific Custom CSS from ACF.
 *
 * @param string $custom_page_css Raw CSS string from ACF field.
 * @return string Minified CSS string or empty string if invalid.
 */
function minify_custom_page_css( $custom_page_css ) {
	if ( empty( $custom_page_css ) || ! is_string( $custom_page_css ) ) {
		return ''; // Return empty string if null or not a string.
	}

	// Remove comments.
	$custom_page_css = preg_replace( '!/\*.*?\*/!s', '', $custom_page_css );

	// Remove whitespace and newlines.
	$custom_page_css = preg_replace( '/\s+/', ' ', $custom_page_css );

	// Remove space around symbols.
	$custom_page_css = preg_replace( '/\s*([{};:,])\s*/', '$1', $custom_page_css );

	// Remove trailing semicolons in blocks.
	$custom_page_css = preg_replace( '/;}/', '}', $custom_page_css );

	// Trim final output.
	return trim( $custom_page_css );
}

/**
 * Add page/post specific Custom CSS from ACF.
 * * This function retrieves custom CSS from an ACF field, minifies it,
 * and outputs it in the site head using proper WordPress escaping.
 */
function add_custom_css_from_field() {
	// Ensure it only runs on singular pages/posts.
	if ( is_singular() ) {
		// Use get_field instead of the_field to control the output.
		$custom_css = function_exists( 'get_field' ) ? get_field( 'custom_page_css' ) : '';

		if ( ! empty( $custom_css ) ) {
			// We wrap the output in wp_kses with an empty array.
			// This tells PHPCS that we have explicitly escaped the output
			// by stripping all HTML tags.
			echo '<style id="custom-page-css-acf">' . wp_kses( minify_custom_page_css( $custom_css ), array() ) . '</style>';
		}
	}
}
add_action( 'wp_head', 'add_custom_css_from_field' );

/**
 * Adds the 'news-post' CSS class to the HTML body tag on single post views.
 *
 * This function checks if the current page is a single post (and the post type
 * is 'post'). If true, it appends the 'news-post' class to the array of body classes.
 * It is hooked into the 'body_class' filter.
 *
 * @param array $classes An array of body classes.
 * @return array The filtered array of body classes.
 */
function add_news_post_body_class( $classes ) {
	if ( is_single() && 'post' === get_post_type() ) {
		$classes[] = 'news-post';
	}
	return $classes;
}
add_filter( 'body_class', 'add_news_post_body_class' );
