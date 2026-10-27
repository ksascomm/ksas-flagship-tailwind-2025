<?php
/**
 * Script and style enqueue functions with production tracking tags.
 *
 * @package Flagship_Tailwind
 */

/**
 * Enqueue scripts and styles for the theme.
 */
function flagship_tailwind_scripts() {
	$css_path = get_template_directory() . '/dist/css/style.css';
	$js_path  = get_template_directory() . '/dist/js/bundle.min.js';

	$css_version = file_exists( $css_path ) ? filemtime( $css_path ) : FLAGSHIP_TAILWIND_VERSION;
	$js_version  = file_exists( $js_path ) ? filemtime( $js_path ) : FLAGSHIP_TAILWIND_VERSION;

	// Compiled Tailwind CSS
	wp_enqueue_style(
		'flagship-tailwind-style',
		get_template_directory_uri() . '/dist/css/style.css',
		array(),
		$css_version
	);

	// Compiled JS Bundle
	wp_enqueue_script(
		'flagship-tailwind-script',
		get_template_directory_uri() . '/dist/js/bundle.min.js',
		array( 'jquery' ),
		$js_version,
		true
	);

	// External third-party scripts.
	wp_enqueue_script(
		'font-awesome',
		'https://kit.fontawesome.com/72c92fef89.js',
		array(),
		'7.3.1',
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

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

	// Localize script for AJAX calls.
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
 * Output Google Tag Manager head snippet on production environments.
 */
function flagship_tailwind_gtm_head() {
	if ( 'production' !== wp_get_environment_type() ) {
		return;
	}
	?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5VTN64C');</script>
	<!-- End Google Tag Manager -->
	<?php
}
add_action( 'wp_head', 'flagship_tailwind_gtm_head', 1 );

/**
 * Output Google Tag Manager noscript fallback on production environments.
 */
function flagship_tailwind_gtm_body() {
	if ( 'production' !== wp_get_environment_type() ) {
		return;
	}
	?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5VTN64C"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php
}
add_action( 'wp_body_open', 'flagship_tailwind_gtm_body', 1 );

/**
 * Add preconnect resource hints for JHU assets domain.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are queued for.
 * @return array Filtered resource hints.
 */
function ksas_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://assets.jhu.edu',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'ksas_resource_hints', 10, 2 );

/**
 * Enqueue JHU Fonts (Hopkins Slab & Work Sans).
 *
 * @return void
 */
function ksas_enqueue_jhu_fonts() {
	// Hopkins Slab.
	wp_enqueue_style(
		'jhu-hopkins-slab',
		'https://assets.jhu.edu/fonts/latest/hopkins-slab/hopkins-slab.css',
		array(),
		'1.0.0'
	);

	// Work Sans.
	wp_enqueue_style(
		'jhu-work-sans',
		'https://assets.jhu.edu/fonts/latest/work-sans/work-sans.css',
		array(),
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'ksas_enqueue_jhu_fonts' );