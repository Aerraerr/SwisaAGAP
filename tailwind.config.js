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
                sans: ['Rubik', 'sans-serif'],
                product: ['"Product Sans"', 'sans-serif'],
            },
            colors: {
                customBG: '#E0F2F1',
                customIT: '#2C6E49',
                btncolor: '#4C956C',
                snbg: '#E8F6EF',
                iconsClr: '#68B2AB',
                approved: '#4C956C',
                rejected: '#F15B66',
                pending: '#E8CC5E',
                mainbg: "#F2F5F3",
            },
            borderColor: {
                Gborder: '#2C6E49',
            }
            
        },
    },
    
    plugins: [forms],
};
