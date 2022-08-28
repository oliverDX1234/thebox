const mix = require("laravel-mix");
var path = require("path")

require('dotenv').config()
let webpack = require('webpack')

let dotenvplugin = new webpack.DefinePlugin({
    'process.env': {
        APP_URL: JSON.stringify(process.env.APP_URL || '/'),
    }
})


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

mix.webpackConfig(webpack => {
    return {
        plugins: [
            dotenvplugin,
        ],
        stats: {
            children: true
        }
    };
});

mix.js("resources/js/app.js", "public/js")
    .vue()
    .alias({
        "@": path.resolve(__dirname, "resources/js"),
        '@assets': path.resolve(__dirname, 'resources/assets'),
        '@sass': path.resolve(__dirname, 'resources/sass')
    })
    .disableNotifications()
    .sass("resources/sass/app.scss", "public/css");
