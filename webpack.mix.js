const mix = require("laravel-mix");
const path = require("path");

mix.setResourceRoot('../');
mix.setPublicPath(path.resolve('./'));

// Webpack Config for Mix 6 compatibility
mix.webpackConfig({
    stats: { children: true },
    watchOptions: { 
		// Stop the infinite refresh loop by ignoring the output folders
        ignored: [
            path.join(__dirname, 'node_modules'),
            path.join(__dirname, 'dist/css'),
            path.join(__dirname, 'dist/js'),
            path.join(__dirname, 'dist/fonts'),
            path.join(__dirname, 'dist/images'),
        ]
    }
});

// 1. Handle JS (Bundling your scripts)
mix.scripts([
    "resources/js/twentytwenty.js", 
    "resources/js/custom-jquery.js", 
    "resources/js/isotope-multi-dropdown.js", 
    "resources/js/wai-dropdown.js", 
    "resources/js/wai-accordion.js"
], "dist/js/bundle.min.js");

// 2. Handle CSS (Tailwind v4 handles purging automatically)
mix.postCss("./resources/css/style.css", "./dist/css/style.css", [
    require("@tailwindcss/postcss"),
    require("autoprefixer"),
]);

mix.options({
    processCssUrls: false,
    manifest: false,
    terser: {
        terserOptions: {
            compress: { drop_console: mix.inProduction() }
        }
    }
});

// 3. Asset Syncing
if (mix.inProduction()) {
    mix.copyDirectory("resources/images", "dist/images");
    mix.copyDirectory("resources/fonts", "dist/fonts");
}