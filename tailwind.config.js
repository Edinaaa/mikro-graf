const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')
module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
   
    screens: {
      'xxs': '450px',
      'xs': '560px',
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    },
    extend: {
     

      colors: {
        // Build your palette here
       primary: colors.orange,
      },
 
      fontFamily: {

        'cursive': ['Comic Sans MS', 'Comic Sans', 'cursive'],
        'cursiveBrush': ['Brush Script MT', 'Brush Script Std','cursive'],
        'cursiveSnell': ['Snell Roundhand','cursive'],

      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
