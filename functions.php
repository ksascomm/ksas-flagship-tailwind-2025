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
	define( 'FLAGSHIP_TAILWIND_VERSION', '5.1.0' );
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

function ksas_enqueue_vite_assets() {
	$is_vite_running = false;

	// Build a stream context that allows self-signed local certificates for dev
	$context = stream_context_create(
		array(
			'ssl' => array(
				'verify_peer'      => false,
				'verify_peer_name' => false,
			),
		)
	);

	// Use stream_socket_client to check if Vite server is running on port 5174
	$socket = @stream_socket_client(
		'ssl://localhost:5174',
		$errno,
		$errstr,
		0.2, // Timeout in seconds
		STREAM_CLIENT_CONNECT,
		$context
	);

	if ( $socket ) {
		$is_vite_running = true;
		fclose( $socket );
	}

	if ( $is_vite_running ) {
		$vite_host = 'https://localhost:5174';

		// 1. Inject Vite Client for HMR
		wp_enqueue_script( 'vite-client', $vite_host . '/@vite/client', array(), null, true );

		// 2. Add type="module" attribute to the Vite client script tag
		add_filter(
			'script_loader_tag',
			function ( $tag, $handle, $src ) {
				if ( 'vite-client' === $handle ) {
					return '<script type="module" src="' . esc_url( $src ) . '"></script>';
				}
				return $tag;
			},
			10,
			3
		);

		// 3. Inject styles and scripts directly from Vite
		wp_enqueue_style( 'ksas-main-style', $vite_host . '/resources/css/style.css', array(), null );
		wp_enqueue_script( 'ksas-bundle', $vite_host . '/dist/js/bundle.min.js', array( 'jquery' ), null, true );

		// Gutenberg Editor Assets
		wp_enqueue_script( 'ksas-editor-js', $vite_host . '/gutenberg-editor/editor.js', array( 'wp-blocks', 'wp-dom', 'wp-element', 'wp-edit-post' ), null, true );
		wp_enqueue_script( 'ksas-live-acf-css', $vite_host . '/gutenberg-editor/live-acf-css.js', array( 'jquery' ), null, true );
		add_editor_style( $vite_host . '/gutenberg-editor/editor-style.css' );
	} else {
		// --- PRODUCTION FALLBACK ---
		$dist_url = get_template_directory_uri() . '/dist/';
		$dist_dir = get_template_directory() . '/dist/';
		if ( file_exists( $dist_dir . 'css/style.css' ) ) {
			wp_enqueue_style( 'ksas-main-style', $dist_url . 'css/style.css', array(), filemtime( $dist_dir . 'css/style.css' ) );
		}
		if ( file_exists( $dist_dir . 'js/bundle.min.js' ) ) {
			wp_enqueue_script( 'ksas-bundle', $dist_url . 'js/bundle.min.js', array( 'jquery' ), filemtime( $dist_dir . 'js/bundle.min.js' ), true );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'ksas_enqueue_vite_assets' );
