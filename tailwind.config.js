/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors')

export default {
    content: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'],
    theme: {
        extend: {
            gray: colors.gray,
            indigo: colors.indigo,
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
