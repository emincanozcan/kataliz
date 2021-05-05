const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");
module.exports = {
  purge: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
      ...defaultTheme.colors,
      gray: colors.trueGray,
      // gray: {
      //   50: "#f9fafb",
      //   100: "#f3f4f6",
      //   200: "#e5e7eb",
      //   300: "#d1d5db",
      //   400: "#9ca3af",
      //   500: "#6b7280",
      //   600: "#4b5563",
      //   700: "#4e4e4e",
      //   800: "#3f3f3f",
      //   900: "#2b2b2b",
      // },
    },
    extend: {
      spacing: {
        84: "21rem",
      },
      fontFamily: {
        sans: ["Roboto", ...defaultTheme.fontFamily.sans],
        ubuntu: ["Ubuntu", ...defaultTheme.fontFamily.sans],
      },
      colors: {
        "pardus-yellow": "#FFCC00",
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
