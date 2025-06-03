import preset from './vendor/filament/support/tailwind.config.preset'

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: "rgb(var(--color-primary-50))",
                    100: "rgb(var(--color-primary-100))",
                    200: "rgb(var(--color-primary-200))",
                    300: "rgb(var(--color-primary-300))",
                    400: "rgb(var(--color-primary-400))",
                    500: "rgb(var(--color-primary-500))",
                    600: "rgb(var(--color-primary-600))",
                    700: "rgb(var(--color-primary-700))",
                    800: "rgb(var(--color-primary-800))",
                    900: "rgb(var(--color-primary-900))",
                    950: "rgb(var(--color-primary-950))",
                },
                secondary: {
                    DEFAULT: "#4A5568",  // Warna sekunder untuk aksen
                    50: "#F8FAFC",
                    100: "#F1F5F9",
                    200: "#E2E8F0",
                    300: "#CBD5E1",
                    400: "#94A3B8",
                    500: "#4A5568",
                    600: "#475569",
                    700: "#334155",
                    800: "#1E293B",
                    900: "#0F172A",
                }
            },
        },
    },
    plugins: [],
};
