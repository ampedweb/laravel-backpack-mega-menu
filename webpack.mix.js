const mix = require('laravel-mix');
const webpack = require('webpack')

mix.webpackConfig ({
    plugins: [
        new webpack.DefinePlugin({
            __VUE_OPTIONS_API__: true,
            __VUE_PROD_DEVTOOLS__: false,
        }),
    ],
})
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
mix.setPublicPath('resources/assets');
mix.js('resources/js/mega-menu-app.js', "/js/mega-menu-app.js").vue({ version: 3 }).copy('resources/assets/js/mega-menu-app.js', '../../../public/packages/ampedweb/laravel-backpack-mega-menu/assets/js/mega-menu-app.js');