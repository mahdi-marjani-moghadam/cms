const path = require("path");
const dotenv = require('dotenv').config({ path: path.join(__dirname, '.env') });
var template = dotenv.parsed.TEMPLATE_NAME;
let mix = require('laravel-mix');

if (template == 'it-times-store') {
    var LiveReloadPlugin = require('webpack-livereload-plugin');
    const tailwindcss = require('tailwindcss');

    mix.options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
    });

    mix.webpackConfig({
        plugins: [new LiveReloadPlugin()],
        stats: { children: true }
    });
} else {

    mix.options({
        processCssUrls: false,
        postCss: [
            require('postcss-nesting'),
            require('@tailwindcss/postcss')({ config: './tailwind.config.js' })
        ],
    });

    mix.webpackConfig({
        watchOptions: {
            ignored: /node_modules|public|storage/,
        },
        stats: { children: true }
    });


    mix.setPublicPath('public/' + template + '/')
        .sass('resources/css/' + template + '.scss', '/', {
            sassOptions: { strictMath: true }
        })
        .copy('resources/fonts', 'public/' + template + '/fonts')
        .sass('resources/css/panel.scss', 'panel')
        .copy('node_modules/@fortawesome/fontawesome-free/webfonts/', 'public/' + template + '/panel/webfonts/')
        .copy('resources/js/jquery-3.6.0.min.js', 'public/' + template + '/')
        .version();



}
