/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './*.php',
        './inc/**/*.php',
        './template-parts/**/*.php',
        './src/**/*.{js,jsx,ts,tsx,vue}',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"Inter"', 'sans-serif'],
                serif: ['"Playfair Display"', 'serif'],
            },
        },
    },
    plugins: [],
}
