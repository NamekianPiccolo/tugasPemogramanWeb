/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./public/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
      },
      colors: {
        brand: {
          primary: '#0F6E56',
          sidebar: '#085041',
          accent: '#1D9E75',
        }
      }
    },
  },
  plugins: [],
}
