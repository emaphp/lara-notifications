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

mix.react('resources/js/app.js', 'public/js')
    .react('resources/js/unreadNotifications.js', 'public/js')
    .react('resources/js/notification.js', 'public/js')
    .react('resources/js/pendingEvents.js', 'public/js')
    .react('resources/js/breakfastList.js', 'public/js')
    .react('resources/js/breakfastHistorial.js', 'public/js')
    .react('resources/js/eventDescription.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
