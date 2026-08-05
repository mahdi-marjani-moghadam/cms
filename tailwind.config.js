/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        './resources/**/*.scss',
        './resources/**/*.html',
    ],
    theme: {
        extend: {
            colors: {
                'corepoColor': '#ea6413',
            },
        },
    },
    
}
