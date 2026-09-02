import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";
import path from "path";
import fs from "fs";
import { minify } from "terser";
import { viteStaticCopy } from "vite-plugin-static-copy";
import liveReload from "vite-plugin-live-reload";

// Recursive directory copying helper
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

// Custom plugin handling JS concatenation, minification, & Asset Syncing
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
        const absolutePath = path.resolve(import.meta.dirname, file);
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
            drop_console: true,
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

    // 3. Sync Directories
    if (copyDirectories) {
      Object.entries(copyDirectories).forEach(([srcDir, destDir]) => {
        const absoluteSrc = path.resolve(import.meta.dirname, srcDir);
        const absoluteDest = path.resolve(import.meta.dirname, destDir);
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
    // 1. Dev Server Settings for Local WordPress
    server: {
      host: "0.0.0.0",
      port: 5173,
      strictPort: true,
      cors: {
        origin: "*",
        methods: ["GET", "POST", "PUT", "DELETE", "OPTIONS"],
        allowedHeaders: ["Content-Type", "Authorization"],
      },
      origin: "http://localhost:5173",
      hmr: {
        host: "localhost",
        protocol: "ws",
      },
    },

    // 2. Base Path Configuration
    base: isProduction
      ? "/wp-content/themes/ksas-flagship-tailwind-2025/dist/"
      : "/",

    build: {
      outDir: "dist",
      assetsDir: "",
      emptyOutDir: false,
      manifest: false,
      sourcemap: !isProduction,
      assetsInlineLimit: 0,

      watch: isProduction ? null : { exclude: ["node_modules/**", "dist/**"] },

      rollupOptions: {
        input: {
          "css/style": path.resolve(
            import.meta.dirname,
            "resources/css/style.css",
          ),
          "css/editor-style": path.resolve(
            import.meta.dirname,
            "gutenberg-editor/editor-style.css",
          ),
          "js/editor": path.resolve(
            import.meta.dirname,
            "gutenberg-editor/editor.js",
          ),
          "js/live-acf-css": path.resolve(
            import.meta.dirname,
            "gutenberg-editor/live-acf-css.js",
          ),
        },
        output: {
          entryFileNames: "[name].js",
          assetFileNames: (assetInfo) => {
            const info = assetInfo.name || "";

            // Handle specific CSS output paths mapped from input names
            if (info === "style.css" || info === "css/style.css") {
              return "css/style.css";
            }
            if (
              info === "editor-style.css" ||
              info === "css/editor-style.css"
            ) {
              return "css/editor-style.css";
            }
            if (info.endsWith(".css")) {
              return "css/[name].[ext]";
            }

            // Restore original directory structure for fonts/images
            const originalPath = assetInfo.originalFileName || "";
            if (originalPath) {
              const resourcesIndex = originalPath.indexOf("resources/");
              if (resourcesIndex !== -1) {
                return originalPath.substring(
                  resourcesIndex + "resources/".length,
                );
              }
            }

            // Fallback rules
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
      tailwindcss(),
      liveReload(["**/*.php"]),
      customWordPressAssets({
        isProduction,
        files: [
          "resources/js/twentytwenty.js",
          "resources/js/custom-jquery.js",
          "resources/js/wai-dropdown.js",
          "resources/js/wai-accordion.js",
        ],
        outputFile: path.resolve(import.meta.dirname, "dist/js/bundle.min.js"),
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
