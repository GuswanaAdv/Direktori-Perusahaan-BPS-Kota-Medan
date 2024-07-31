const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.css",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        blue: '#5C9EBF',
        darkblue: '#002B6A',
        white: '#FFFFFF',
        black: '#000000',
        grey: '#D9D9D9',
        lightgrey: '#EEF0F2',
        red: '#f91f1f',
      },
      fontFamily: {
        raleway: ['Raleway', 'sans-serif'],
        roboto: ['Roboto', 'sans-serif'],
        inter: ['Inter', 'sans-serif'],
        plusjakartasans: ['Plus Jakarta Sans', 'sans-serif']
      },},
  },
  plugins: [require('daisyui'),],
}

