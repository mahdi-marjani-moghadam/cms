const path = require("path");
const dotenv = require('dotenv').config({ path: path.join(__dirname, '.env') });
var template = dotenv.parsed.TEMPLATE_NAME;
let mix = require('laravel-mix');
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
