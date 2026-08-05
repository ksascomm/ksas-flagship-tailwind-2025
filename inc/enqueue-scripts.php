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

	// Safe cache-busting: Fall back to theme version if build assets are missing.
	$css_version = file_exists( $css_path ) ? filemtime( $css_path ) : FLAGSHIP_TAILWIND_VERSION;
	$js_version  = file_exists( $js_path ) ? filemtime( $js_path ) : FLAGSHIP_TAILWIND_VERSION;

	// Enqueue primary stylesheet.
	wp_enqueue_style(
		'flagship-tailwind-style',
		get_template_directory_uri() . '/dist/css/style.css',
		array(),
		$css_version
	);

	wp_style_add_data( 'flagship-tailwind-style', 'rtl', 'replace' );

	// Threaded comments script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// External third-party scripts with deferred/async loading strategies.
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

	wp_enqueue_script(
		'google-cse',
		'https://cse.google.com/cse.js?cx=012258670098148303364:zptrsb24qaq',
		array(),
		FLAGSHIP_TAILWIND_VERSION,
		array(
			'strategy'  => 'async',
			'in_footer' => true,
		)
	);

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

	// Enqueue main bundled JS.
	wp_enqueue_script(
		'flagship-tailwind-script',
		get_template_directory_uri() . '/dist/js/bundle.min.js',
		array( 'jquery' ),
		$js_version,
		true
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