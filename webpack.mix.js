let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
var LiveReloadPlugin = require('webpack-livereload-plugin');
const path = require("path");
const dotenv = require('dotenv').config({ path: path.join(__dirname, '.env') });

mix.webpackConfig({
    plugins: [new LiveReloadPlugin()],
    stats: { children: true }
});

var template = dotenv.parsed.TEMPLATE_NAME;

if (template = 'it-times-store') {
    mix.setPublicPath('public/' + template + '/')
        .postCss('resources/css/' + template + '.css', '/', {})
        .copy('resources/fonts', 'public/' + template + '/fonts')
        .version();
} else {
    mix.options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
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
