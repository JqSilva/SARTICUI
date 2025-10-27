/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./public/**/*.html",
    "./app/Controllers/**/*.php"
  ],
  prefix: "tw-",
  corePlugins: { preflight: false }
};