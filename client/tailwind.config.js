const defaultTheme = require("tailwindcss/defaultTheme");
module.exports = {
  purge: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      // spacing: {
      //   128: "36rem",
      // },
      fontFamily: {
        sans: ["Inter", ...defaultTheme.fontFamily.sans],
      },
      colors: {
        "pardus-yellow": "#ffcb01",
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
