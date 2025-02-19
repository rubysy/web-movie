import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue', // Include Vue files
    './resources/js/**/*.jsx', // Include React files
    './resources/js/**/*.tsx', // Include TypeScript React files
  ],

  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: '1rem',
        sm: '2rem',
        lg: '4rem',
        xl: '5rem',
      },
    },
    extend: {
      screens: {
        'xs': '475px',
      },
      gridTemplateColumns: {
        'auto-fit': 'repeat(auto-fit, minmax(250px, 1fr))',
        'auto-fill': 'repeat(auto-fill, minmax(250px, 1fr))',
      },
      fontFamily: {
        'inter': ['Inter', 'sans-serif'],
        'quicksand': ['Quicksand', 'sans-serif'],
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
        serif: ['Merriweather', ...defaultTheme.fontFamily.serif], // Additional serif font
        mono: ['Courier New', ...defaultTheme.fontFamily.mono], // Additional mono font
      },
      colors: {
        develobe: {
          10: '#d20000',
          50: '#E7EBFB',
          100: '#C3D0F8',
          200: '#97ADF5',
          300: '#6B8AF2',
          400: '#C7A66B', // gold muted
          500: '#778DA9', // steel gray
          600: '#E0E1DD',
          700: '#666666', //dark slate blue
          800: '#333333', // Darker navy
          900: '#181A1B', // deep charcoal
        },
        primary: {
          light: '#6EC1E4',
          DEFAULT: '#3490DC',
          dark: '#2779BD',
        },
        secondary: {
          light: '#F6AD55',
          DEFAULT: '#ED8936',
          dark: '#DD6B20',
        },
        neutral: {
          50: '#F9FAFB',
          100: '#F4F5F7',
          200: '#E5E7EB',
          300: '#D2D6DC',
          400: '#9FA6B2',
          500: '#6B7280',
          600: '#4B5563',
          700: '#374151',
          800: '#252F3F',
          900: '#161E2E',
        },
      },
      spacing: {
        '128': '32rem',
        '144': '36rem',
        '160': '40rem',
        '192': '48rem',
      },
      borderRadius: {
        '4xl': '2rem',
        '5xl': '2.5rem',
        full: '9999px',
      },
      boxShadow: {
        'custom-light': '0 2px 4px rgba(0, 0, 0, 0.1)',
        'custom-dark': '0 4px 6px rgba(0, 0, 0, 0.2)',
      },
      zIndex: {
        '-1': '-1',
        '60': '60',
        '70': '70',
      },
    },
  },

  plugins: [
    forms, // Form plugin from Tailwind
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/typography'), // Useful for prose-based content
    require('@tailwindcss/aspect-ratio'), // For aspect ratio utilities
    require('@tailwindcss/container-queries'), // Experimental plugin for container queries
    require('tailwind-scrollbar'), // Custom scrollbar utilities
    require('tailwindcss-debug-screens'), // For debug screens utilities
  ],

  // Add custom input focus styles
  plugins: [
    function ({ addUtilities }) {
      addUtilities({
        '.focus-none': {
          '&:focus': {
            outline: 'none',
            boxShadow: 'none',
            border: 'none',
          },
        },
      });
    },
  ],
};
