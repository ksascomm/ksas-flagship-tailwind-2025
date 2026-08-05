import { defineConfig } from "vite";
import path from "path";
import fs from "fs";
import { minify } from "terser"; // Modern JS minification
import { viteStaticCopy } from "vite-plugin-static-copy";

// ESM Imports for PostCSS plugins
import tailwindcss from "@tailwindcss/postcss";
import autoprefixer from "autoprefixer";

// Recursive directory copying helper (Mimics mix.copyDirectory)
function copyDirRecursive(src, dest) {
  if (!fs.existsSync(src)) return;

  if (!fs.existsSync(dest)) {
    fs.mkdirSync(dest, { recursive: true });
  }

  const entries = fs.readdirSync(src, { withFileTypes: true });

  for (const entry of entries) {
    const srcPath = path.join(src, entry.name);
    const destPath = path.join(dest, entry.name);

    if (entry.isDirectory()) {
      copyDirRecursive(srcPath, destPath);
    } else {
      fs.copyFileSync(srcPath, destPath);
    }
  }
}

// Custom plugin that handles JS concatenation, minification, & Asset Syncing
function customWordPressAssets(options) {
  const processAssets = async () => {
    const { files, outputFile, copyDirectories, isProduction } = options;
    const outputDir = path.dirname(outputFile);

    if (!fs.existsSync(outputDir)) {
      fs.mkdirSync(outputDir, { recursive: true });
    }

    // 1. Concatenate JS Files
    let concatenatedContent = files
      .map((file) => {
        const absolutePath = path.resolve(__dirname, file);
        if (fs.existsSync(absolutePath)) {
          return (
            `/* --- Source: ${file} --- */\n` +
            fs.readFileSync(absolutePath, "utf-8")
          );
        }
        console.warn(
          `\x1b[33m⚠ [assets-plugin] File not found: ${file}\x1b[0m`,
        );
        return "";
      })
      .join("\n\n");

    // 2. Minify JS in Production using Terser
    if (isProduction && concatenatedContent.trim().length > 0) {
      try {
        const minified = await minify(concatenatedContent, {
          compress: {
            drop_console: true, // Drops console.log statements in production
          },
          mangle: true,
        });
        concatenatedContent = minified.code || concatenatedContent;
        console.log(`\x1b[32m✓\x1b[0m minified JS bundle successfully.`);
      } catch (err) {
        console.error(
          `\x1b[31m✗ [Terser Error] Minification failed:\x1b[0m`,
          err,
        );
      }
    }

    fs.writeFileSync(outputFile, concatenatedContent, "utf-8");
    console.log(`\x1b[32m✓\x1b[0m concatenated JS scripts into ${outputFile}`);

    // 3. Sync Directories (Ensures PHP template files can access ALL assets)
    if (copyDirectories) {
      Object.entries(copyDirectories).forEach(([srcDir, destDir]) => {
        const absoluteSrc = path.resolve(__dirname, srcDir);
        const absoluteDest = path.resolve(__dirname, destDir);
        copyDirRecursive(absoluteSrc, absoluteDest);
        console.log(`\x1b[32m✓\x1b[0m synced directory ${srcDir} → ${destDir}`);
      });
    }
  };

  return {
    name: "custom-wordpress-assets",
    async buildStart() {
      await processAssets();
    },
    async handleHotUpdate({ file }) {
      const isWatchedJS = options.files.some(
        (f) => path.resolve(f) === path.resolve(file),
      );
      const isStaticAsset = Object.keys(options.copyDirectories || {}).some(
        (dir) => path.resolve(file).startsWith(path.resolve(dir)),
      );

      if (isWatchedJS || isStaticAsset) {
        await processAssets();
      }
    },
  };
}

export default defineConfig(({ mode }) => {
  const isProduction = mode === "production";

  return {
    // Tells Vite to prefix compiled CSS asset paths with your theme's dist directory
    base: "/wp-content/themes/ksas-flagship-tailwind-2025/dist/",

    publicDir: false, // Disables copying of default /public/ folder

    css: {
      postcss: {
        plugins: [tailwindcss(), autoprefixer()],
      },
    },

    build: {
      outDir: "dist",
      assetsDir: "",
      emptyOutDir: false,
      manifest: false,
      sourcemap: !isProduction, // Generates source maps only for development builds

      // Forces Vite to process ALL font and image files through rollup instead of inlining them
      assetsInlineLimit: 0,

      // Only watch during development. Turns off during production builds so it exits!
      watch: isProduction ? null : { exclude: ["node_modules/**", "dist/**"] },

      rollupOptions: {
        input: {
          "css/style": path.resolve(__dirname, "resources/css/style.css"),
        },
        output: {
          // Dynamic asset router. Rebuilds the original nested folder hierarchies.
          assetFileNames: (assetInfo) => {
            const info = assetInfo.name || "";

            if (info.endsWith(".css")) {
              return "css/style.css";
            }

            // Check if Rollup provided an original file location (e.g. source file system path)
            const originalPath = assetInfo.originalFileName || "";

            if (originalPath) {
              const resourcesIndex = originalPath.indexOf("resources/");
              if (resourcesIndex !== -1) {
                return originalPath.substring(
                  resourcesIndex + "resources/".length,
                );
              }
            }

            // Fallbacks if Rollup cannot find original path metadata
            if (/\.(woff2?|eot|ttf|otf)$/i.test(info)) {
              return "fonts/[name].[ext]";
            }
            if (/\.(jpe?g|png|gif|svg|webp|ico)$/i.test(info)) {
              return "images/[name].[ext]";
            }

            return "[name].[ext]";
          },
        },
      },
    },

    plugins: [
      customWordPressAssets({
        isProduction,
        files: [
          "resources/js/twentytwenty.js",
          "resources/js/custom-jquery.js",
          "resources/js/wai-dropdown.js",
          "resources/js/wai-accordion.js",
        ],
        outputFile: path.resolve(__dirname, "dist/js/bundle.min.js"),
        // FIXED: Enabled mirroring. This copies all images/fonts (even those only
        // referenced in PHP files) directly to your dist folder.
        copyDirectories: {
          "resources/images": "dist/images",
          "resources/fonts": "dist/fonts",
        },
      }),
      viteStaticCopy({
        targets: [
          {
            src: "resources/js/isotope-multi-dropdown.js",
            dest: "js",
            rename: { stripBase: 2 },
            // Minify content on the fly during build
            async transform(content) {
              if (isProduction) {
                const result = await minify(content.toString());
                return result.code;
              }
              return content;
            },
          },
        ],
      }),
    ],
  };
});
