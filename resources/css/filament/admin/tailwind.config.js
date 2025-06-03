import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './vendor/filament/**/*.blade.php',
        './app/Filament/Admin/**/*.php',
        './resources/views/filament/admin/**/*.blade.php',
    ],
} 