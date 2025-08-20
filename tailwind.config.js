import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.{js,jsx,ts,tsx}', // 👈 add this so React sees Tailwind
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        softPink: '#fff0f5',
        glamPink: '#ff66b2',
        rosyBeige: '#eee7eb',
        champagneGold: '#f4d4ba',
        mauvePink: '#d88cb7',
        deepBerry: '#b13579',
        charcoalGray: '#444444',
      },
    },
  },

  plugins: [forms],
};
