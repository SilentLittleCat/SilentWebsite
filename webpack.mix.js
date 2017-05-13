const { mix } = require('laravel-mix');

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
   .sass('resources/assets/sass/app.scss', 'public/css');

// custom resources
// jquery
mix.copy('resources/assets/bower/jquery/dist/jquery.js', 'public/bower/jquery/dist/jquery.js');

// semantic-ui
mix.copy('resources/assets/bower/semantic/dist/semantic.css', 'public/bower/semantic/dist/semantic.css')
   .copy('resources/assets/bower/semantic/dist/semantic.js', 'public/bower/semantic/dist/semantic.js')
   .copyDirectory('resources/assets/bower/semantic/dist/themes/', 'public/bower/semantic/dist/themes/');

// cropperjs
mix.copy('resources/assets/bower/cropperjs/dist/cropper.css', 'public/bower/cropperjs/dist/cropper.css')
   .copy('resources/assets/bower/cropperjs/dist/cropper.js', 'public/bower/cropperjs/dist/cropper.js');

// jquery.scrollTo
mix.copy('resources/assets/bower/jquery.scrollTo/jquery.scrollTo.js', 'public/bower/jquery.scrollTo/jquery.scrollTo.js');

// Snap.svg
mix.copy('resources/assets/bower/Snap.svg/dist/snap.svg.js', 'public/bower/Snap.svg/dist/snap.svg.js');

mix.browserSync({
    open: 'external',
    host: 'silent.website',
    proxy: 'silent.website',
    files: ['resources/views/**/*.php', 'app/**/*.php', 'routes/**/*.php']
});