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
                'brand-blue': '#1F3C88',
                'brand-maroon': '#8B1E2D',
                'brand-dark': '#111111',
                'brand-slate': '#2E4057',
                'brand-forest': '#2E7D32',
                'brand-sky': '#4FC3F7',
                'brand-bg': '#F8F9FA',
            },
        },
    },

    plugins: [forms],
};
