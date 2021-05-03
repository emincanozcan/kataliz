module.exports = {
  purge: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      spacing: {
        128: "36rem",
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
