const mix = require('laravel-mix');

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

mix.setPublicPath('public_html');

mix.js('resources/js/app.js', 'js')
    .sass('resources/sass/app.scss', 'css');

mix.browserSync({
    proxy: 'personeelsfeest51.test',
    port: 3000
});
