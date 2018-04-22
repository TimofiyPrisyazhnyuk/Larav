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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/shop/bootstrap.min.js', 'public/js/shop')
    .js('resources/assets/js/shop/html5shiv.js', 'public/js/shop')
    .js('resources/assets/js/shop/jquery.scrollUp.min.js', 'public/js/shop')
    .js('resources/assets/js/shop/main.js', 'public/js/shop')
    .js('resources/assets/js/shop/price-range.js', 'public/js/shop')

    /**
     *
     */
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/shop/responsive.scss', 'public/css/shop')
    .sass('resources/assets/sass/shop/animate.scss', 'public/css/shop')
    .sass('resources/assets/sass/shop/main.scss', 'public/css/shop')
    .sass('resources/assets/sass/shop/price-range.scss', 'public/css/shop')
    .sass('resources/assets/sass/shop/bootstrap.scss', 'public/css/shop');
