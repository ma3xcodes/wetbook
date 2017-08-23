let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/*mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copyDirectory('node_modules/sweetalert2', 'public/plugins/sweetalert2')*/

mix.js('resources/assets/js/app.js', 'html/js')
    .sass('resources/assets/sass/app.scss', 'html/css')
    .copyDirectory('node_modules/sweetalert2', 'html/plugins/sweetalert2')
    .copyDirectory('node_modules/izitoast', 'html/plugins/izitoast');
