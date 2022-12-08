/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './src/Views/templates/*.html.twig',
    // './components/**/*.{html,js}'
  ],
  theme: {
    extend: {
      gridTemplateRows: {
        '[auto,auto,1fr]': 'auto auto 1fr',
      },
    },
  },
  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/aspect-ratio'),
  ],
}
