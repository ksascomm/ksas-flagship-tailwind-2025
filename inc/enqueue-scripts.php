<?php
/**
 * Script and style enqueue functions with production tracking tags.
 *
 * @package Flagship_Tailwind
 */

/**
 * Check if Vite development server is actively running.
 */
function is_vite_dev_server_active() {
	static $is_active = null;

	if ( null !== $is_active ) {
		return $is_active;
	}

	// Ping the Vite dev server with a short timeout.
	$handle = @fsockopen( 'localhost', 5173, $errno, $errstr, 0.2 );
	if ( $handle ) {
		fclose( $handle );
		$is_active = true;
	} else {
		$is_active = false;
	}

	return $is_active;
}

/**
 * Enqueue scripts and styles for the theme.
 */
function flagship_tailwind_scripts() {
	$is_dev      = is_vite_dev_server_active();
	$vite_server = 'http://localhost:5173';

	if ( $is_dev ) {
		// --- VITE DEV MODE ---
		// 1. Enqueue Vite client core
		wp_enqueue_script(
			'vite-client',
			$vite_server . '/@vite/client',
			array(),
			null,
			false
		);

		// 2. Enqueue Dev CSS via Vite HMR
		wp_enqueue_style(
			'theme-tailwind-dev',
			$vite_server . '/resources/css/style.css',
			array(),
			null
		);

		// 3. Enqueue Dev JS via Vite HMR (if applicable)
		wp_enqueue_script(
			'theme-tailwind-dev-js',
			$vite_server . '/resources/js/main.js', // Adjust path to your JS entrypoint
			array( 'jquery' ),
			null,
			true
		);

	} else {
		// --- PRODUCTION BUILD MODE ---
		$css_path = get_template_directory() . '/dist/css/style.css';
		$js_path  = get_template_directory() . '/dist/js/bundle.min.js';

		$css_version = file_exists( $css_path ) ? filemtime( $css_path ) : FLAGSHIP_TAILWIND_VERSION;
		$js_version  = file_exists( $js_path ) ? filemtime( $js_path ) : FLAGSHIP_TAILWIND_VERSION;

		// Production CSS
		wp_enqueue_style(
			'flagship-tailwind-style',
			get_template_directory_uri() . '/dist/css/style.css',
			array(),
			$css_version
		);

		// Production JS Bundle
		wp_enqueue_script(
			'flagship-tailwind-script',
			get_template_directory_uri() . '/dist/js/bundle.min.js',
			array( 'jquery' ),
			$js_version,
			true
		);
	}

	// External third-party scripts (Load regardless of Dev or Prod)
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

	// Localize script for AJAX calls
	$script_handle = $is_dev ? 'theme-tailwind-dev-js' : 'flagship-tailwind-script';
	wp_localize_script(
		$script_handle,
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