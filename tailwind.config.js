import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brown: {
                    100: '#d4c3a1',
                    200: '#b6a08a',
                    300: '#9f8d74',
                    400: '#8a7a5f',
                    500: '#7c6a4c',
                    600: '#6e5a3a',
                    700: '#5f4b2f',
                    800: '#4f3c24',
                    900: '#40301a',
                }
            }
        }
    },

    plugins: [forms],
};
