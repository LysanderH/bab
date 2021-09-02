const mix = require('laravel-mix');
require('laravel-mix-criticalcss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css/app.css')
    .criticalCss({
        enabled: mix.inProduction(),
        paths: {
            base: 'https://bab.lysander-hans.com',
            templates: './resources/css',
            suffix: '_critical.min'
        },
        urls: [
            { url: 'blog', template: 'blog' },
        ],
        options: {
            minify: true,
        },
    })
    .options({
        processCssUrls: false
    });
