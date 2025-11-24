import defaultTheme from "tailwindcss/defaultTheme";

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ["Poppins", ...defaultTheme.fontFamily.sans],
      },

      colors: {
        red: {
          50: "#FBDADB",
          100: "#F7B6B8",
          200: "#F39194",
          300: "#EF6C70",
          400: "#EB474D",
          500: "#E62129",
          600: "#CA161C",
          700: "#A51217",
          800: "#810E12",
          900: "#5C0A0D",
        },

        green: {
          50: "#FAFBEE",
          100: "#EFF4CD",
          200: "#E5EDAB",
          300: "#DBE58A",
          400: "#D0DE68",
          500: "#C2D43D",
          600: "#B6C92C",
          700: "#98A725",
          800: "#7A861D",
          900: "#5B6416",
        },

        blue: {
          50: "#99D8FF",
          100: "#70C8FF",
          200: "#47B9FF",
          300: "#1FA9FF",
          400: "#0097F5",
          500: "#0076BE",
          600: "#0065A3",
          700: "#004B7A",
          800: "#003252",
          900: "#001929",
        },

        beaver: {
          50: "#E5E1DC",
          100: "#D4CDC4",
          200: "#C2B9AD",
          300: "#B1A595",
          400: "#A0917E",
          500: "#8A7A65",
          600: "#756857",
          700: "#5E5345",
          800: "#463E34",
          900: "#2F2A23",
        },

        gray: {
          50: "#FFFFFF",
          100: "#FAFAFA",
          200: "#F5F5F5",
          300: "#E8E8E8",
          400: "#D9D9D9",
          500: "#BFBFBF",
          600: "#8C8C8C",
          700: "#595959",
          800: "#262626",
          900: "#1C1C1C",
        },

        yellow: {
          50: "#FFFBEB",
          100: "#FEF3C0",
          400: "#FDE05D",
          500: "#FDD835",
          600: "#E6C530",
        },

        crayola: {
          500: "#F5A623",
        },

        disable: {
          red: '#FBE8E6',
          blue: '#E9EDF4',
          white: '#F5F5F5',
          yellow: '#FFFBEB',
          grey: '#E8E8E8',
        },
      },
    },

    keyframes: {
      progress: {
        "0%": { transform: "translateX(-100%)" },
        "100%": { transform: "translateX(100%)" },
      },
    },
    animation: {
      progress: "progress 1.5s linear infinite",
    },
  },

  plugins: [],
};
