const mix = require('laravel-mix');
const path = require("path");
const dotenv = require('dotenv').config({ path: path.join(__dirname, '.env') });
var template = dotenv.parsed.TEMPLATE_NAME;
// const tailwindcss = require('tailwindcss'); /* Add this line at the top */

mix.setPublicPath('public/' + template + '/')
    .webpackConfig({ stats: { children: true } })
    .postCss('resources/css/arino.css', '/', [
        require("@tailwindcss/postcss"),
    ]);

// let mix = require('laravel-mix');

// const tailwindcss = require('tailwindcss'); /* Add this line at the top */
// // const LiveReloadPlugin = require('webpack-livereload-plugin');

// // let tailwindcss = require('tailwindcss');
// // const path = require("path");


// mix.webpackConfig({
//     // plugins: [new LiveReloadPlugin()],
//     stats: {
//         children: true
//     },
//     watchOptions: {
//         ignored: /node_modules|public|storage/,
//     },
// });

// mix.options({
//     postCss: [ tailwindcss('./tailwind.config.js') ],
//     processCssUrls: false,
// });

// var template = dotenv.parsed.TEMPLATE_NAME;

// // فایل مخصوص Tailwind (CSS)
// // mix.postCss('resources/css/tailwind.css', 'public/' + template + '/', [
// //     require('tailwindcss'),
// // ]);

// mix.setPublicPath('public/' + template + '/')
//     .postCss("resources/css/tailwind.css", "public/css", [
//         tailwindcss,
//     ])
//     .sass('resources/css/' + template + '.scss', '/', {
//         sassOptions: {
//             strictMath: true,
//             // includePaths: ['resources/css', 'node_modules'],
//         }
//     })
//     .copy('resources/fonts', 'public/' + template + '/fonts')
//     .sass('resources/css/panel.scss', 'panel')
//     .copy('node_modules/@fortawesome/fontawesome-free/webfonts/', 'public/' + template + '/panel/webfonts/')
//     .copy('resources/js/jquery-3.6.0.min.js', 'public/' + template + '/')
//     // .minify('public/'+template + '/'+template + '.css')
//     .version();

