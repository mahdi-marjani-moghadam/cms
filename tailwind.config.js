/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                'corepoColor': '#ea6413',
              },
        },
    },
    plugins: [
        require('tailwindcss-rtl'),
    ],
}
