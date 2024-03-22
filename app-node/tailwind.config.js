/** @type {import('tailwindcss').Config} */

const colors = require("tailwindcss/colors");

const fallbackFonts = [
  'ui-sans-serif',
  'system-ui',
  '-apple-system',
  'BlinkMacSystemFont',
  'Segoe UI',
  'Roboto',
  'Helvetica Neue',
  'Arial',
  'Noto Sans',
  'sans-serif',
  'Apple Color Emoji',
  'Segoe UI Emoji',
  'Segoe UI Symbol',
  'Noto Color Emoji',
];

let customColors = {
  page:   'var(--pageColor)',
  header: 'var(--headerColor)',
};

module.exports = {
  content: [
    "./src/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  theme: {
    fontFamily: {
      primary: ['Heebo', ...fallbackFonts],
      secondary: ['OpenSans', ...fallbackFonts],
    },
    colors: {
      white: colors.white,
      black: colors.black,
      neutral: colors.neutral,
      ...customColors,
    },
    extend: {},
  },
  plugins: [],
}