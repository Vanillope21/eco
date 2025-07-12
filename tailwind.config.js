
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
          ecogreen: {
            DEFAULT: "#388e3c",
            50: "#e6f4ea",
            100: "#c1e3cb",
            200: "#9ad2ab",
            300: "#73c18b",
            400: "#4cb16b",
            500: "#388e3c", // main
            600: "#2c6e2e",
            700: "#204f20",
            800: "#143012",
            900: "#081104",
          },
          ecoorange: {
            DEFAULT: "#ffa726",
            50: "#fff3e0",
            100: "#ffe0b2",
            200: "#ffcc80",
            300: "#ffb74d",
            400: "#ffa726",
            500: "#fb8c00",
            600: "#f57c00",
            700: "#ef6c00",
            800: "#e65100",
            900: "#bf360c",
          },
          ecoyellow: {
            DEFAULT: "#ffb300",
            50: "#fffde7",
            100: "#fff9c4",
            200: "#fff59d",
            300: "#fff176",
            400: "#ffee58",
            500: "#ffeb3b",
            600: "#fdd835",
            700: "#fbc02d",
            800: "#f9a825",
            900: "#f57f17",
          },
        },
      },
    },
    plugins: [],
  }