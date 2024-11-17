import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
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
        extend: {
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin')
    ],
};
