const mix = require('laravel-mix');
const postCssImport = require('postcss-import');
const tailwindcss = require('tailwindcss');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       postCssImport(),
       tailwindcss(),
   ])
   .options({
       processCssUrls: false
   })
   .webpackConfig({
       mode: 'development', // Change to 'production' for production builds
   });
