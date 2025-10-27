/** @type {import('tailwindcss').Config} */
module.exports = {
  prefix: 'tw-',
  content: ["./app/Views/**/*.php", "./public/**/*.js"],
  theme: { extend: {} },
  plugins: [],
  // Si tenías esto, bórralo o ponlo en true:
  // corePlugins: { preflight: true },
}
