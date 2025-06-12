import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/filament/admin/theme.css',
                'resources/css/filament/user/theme.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        // Optimasi untuk Windows
        chunkSizeWarningLimit: 1000,
    },
    server: {
        // Optimasi untuk Windows
        hmr: {
            protocol: 'ws',
            host: 'localhost',
        },
        watch: {
            usePolling: false,
            interval: 1000,
        }
    }
})
