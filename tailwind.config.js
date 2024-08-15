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
        darkgrey: '#5f5f57',
        grey: '#D9D9D9',
        lightgrey: '#EEF0F2',
        red: '#f91f1f',
        green: '#48b23c',
        darkorange:'#f23c02',
        orange:'#fe8c03',
        lightorange:'#feaa03',
        orangepastel:'#fec64d',
        orangeyellow:'#fdb119',
        yellowpastel: '#fbfb45',
      },
      fontFamily: {
        raleway: ['Raleway', 'sans-serif'],
        roboto: ['Roboto', 'sans-serif'],
        inter: ['Inter', 'sans-serif'],
        plusjakartasans: ['Plus Jakarta Sans', 'sans-serif']
      },},
  },
  plugins: [
    require('daisyui'),
  ],
}

