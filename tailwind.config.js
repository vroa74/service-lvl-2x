import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import flowbite from 'flowbite/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                '5px': '0.3125rem',   // 5px
                '6px': '0.375rem',    // 6px
                '7px': '0.4375rem',   // 7px
                '8px': '0.5rem',      // 8px
                '9px': '0.5625rem',   // 9px
                '10px': '0.625rem',   // 10px
                '11px': '0.6875rem',  // 11px (1 pixel less than text-xs)
            },
            maxWidth: {
                '8xl': '90rem', // 1440px
            }
        },
    },

    plugins: [forms, typography, flowbite],
};
