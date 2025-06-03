import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './vendor/filament/**/*.blade.php',
        './app/Filament/User/**/*.php',
        './resources/views/filament/user/**/*.blade.php',
    ],
} 