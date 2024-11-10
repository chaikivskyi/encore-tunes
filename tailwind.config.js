/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    safelist: [
        'bg-red-500',
        'text-red-50',
        'bg-green-500',
        'text-green-50',
        'bg-sky-500',
        'text-sky-50',
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ],
}

