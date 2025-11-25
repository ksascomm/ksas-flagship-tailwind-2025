# Flagship Tailwind

Theme for Krieger Flagship website. Built using the [Underscores](https://github.com/automattic/_s) starter theme. Incorporates [Tailwind](https://github.com/tailwindlabs/tailwindcss) and their [WordPress Laravel Mix](https://github.com/tailwindlabs/tailwindcss-setup-examples/tree/master/examples/wordpress-laravel-mix) version.

## PurgeCSS
Tailwind uses PurgeCSS to scan and remove unused styles from the production build. You can modify the safelist and directories via the webpack.mix.js file. Check your production build to make sure styles you were developing with compiled correctly. View the [Tailwind docs](https://tailwindcss.com/docs/optimizing-for-production) for more information.

## Install Dependencies
```bash
cd directory
npm install
```

## Build once
```bash
npm run development
```

## Watch for Changes
```bash
npm run watch
```

## Compile & Minify All Theme Assets, Run PurgeCSS
```bash
$ npm run production
```
