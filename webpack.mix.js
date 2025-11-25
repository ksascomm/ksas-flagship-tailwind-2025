const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const path = require("path");
const glob = require("glob-all");
const { PurgeCSSPlugin } = require("purgecss-webpack-plugin");

/* ==========================================================================
  Config
  ========================================================================== */


/* ==========================================================================
  Purge CSS Extractors
  ========================================================================== */
  const TailwindExtractor = (content) => {
	const defaultSelectors = content.match(/[A-Za-z0-9_-]+/g) || [];
	const extendedSelectors = content.match(/[^<>"=\s]+/g) || [];
	return defaultSelectors.concat(extendedSelectors);
  };
  
  /* ==========================================================================
	Laravel Mix Config
	========================================================================== */
  mix.setResourceRoot('../');
  mix.setPublicPath(path.resolve('./'));
  
	mix.webpackConfig({
	  watchOptions: { ignored: [
		  path.posix.resolve(__dirname, './node_modules'),
		  path.posix.resolve(__dirname, './dist/css'),
		  path.posix.resolve(__dirname, './dist/js'),
		  path.posix.resolve(__dirname, './dist/fonts'),
		  path.posix.resolve(__dirname, './dist/images')
		]}
	});
mix
	// handle JS files
	.scripts(["resources/js/twentytwenty.js", "resources/js/custom-jquery.js", "resources/js/isotope-multi-dropdown.js", "resources/js/wai-dropdown.js", "resources/js/wai-accordion.js"], "dist/js/bundle.min.js")
	//.disableNotifications()

	mix.postCss( "./resources/css/style.css", "./dist/css/style.css", [
		require("@tailwindcss/postcss"),
		]

	)

	mix.options({
		processCssUrls: false,
		manifest: false,
	  })

// remove unused CSS from files - only used when running npm run production
if (mix.inProduction()) {
	mix.options({
		uglify: {
			uglifyOptions: {
				mangle: true,

				compress: {
					warnings: false, // Suppress uglification warnings
					pure_getters: true,
					conditionals: true,
					unused: true,
					comparisons: true,
					sequences: true,
					dead_code: true,
					evaluate: true,
					if_return: true,
					join_vars: true
				},

				output: {
					comments: false,
				},

				exclude: [/\.min\.js$/gi] // skip pre-minified libs
			}
		}
	});

	// Purge CSS config
	// more examples can be found at https://gist.github.com/jack-pallot/217a5d172ffa43c8c85df2cb41b80bad
	mix.webpackConfig({
		plugins: [
			new PurgeCSSPlugin({
				paths: glob.sync([
					path.join(__dirname, "./**/*.php"),
					path.join(__dirname, "resources/js/**/*.js")
				]),

				extractors: [
					{
						extractor: TailwindExtractor,
						extensions: ["php", "js"]
					}
				],

				safelist: [
					"p",
					"h1",
					"h2",
					"h3",
					"h4",
					"h5",
					"h6",
					"hr",
					"ol",
					"ol li",
					"ul",
					"ul li",
					"em",
					"b",
					"strong",
					"blockquote",
					"tablepress",
					"current-item",
					"sideNav",
					"sub-menu",
					"callout",
					"breadcrumbs",
					"current-item",
					"page-numbers",
					"page-template-default",
					"page-template-front",
					"page-template-specialty-page",
					"entry-content",
					"hover:bg-grey-lightest",
					"hover:bg-mint-green",
					/^gsc-/,
					/^gs-/,
					/(^wp-block-)\w+/,
					/^icon-/,
					"class",
					/(^c-accordion)\w+/,
					"divide-grey-cool",
					'beyond-list',
					'external',
					'authenticate',
				],
			})
		]
	});
	  // Move images to dist directory
	  mix.copyDirectory("resources/images", "dist/images")

	  // Move fonts to dist directory
	  mix.copyDirectory("resources/fonts", "dist/fonts")
}
