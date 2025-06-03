import preset from "./vendor/filament/support/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: "#2F855A", // Warna hijau utama yang lebih natural
                    50: "#F0FDF4",      // Hijau sangat terang
                    100: "#DCFCE7",     // Hijau terang
                    200: "#BBF7D0",     // Hijau muda
                    300: "#86EFAC",     // Hijau cerah
                    400: "#4ADE80",     // Hijau menengah
                    500: "#2F855A",     // Warna utama
                    600: "#16A34A",     // Hijau gelap
                    700: "#15803D",     // Hijau lebih gelap
                    800: "#166534",     // Hijau sangat gelap
                    900: "#14532D",     // Hijau paling gelap
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
};
