#!/bin/bash

echo "🧹 Starting cache clearing process..."

echo "📦 Clearing Composer's autoload..."
composer dump-autoload

echo "🗑️ Clearing application cache..."
php artisan cache:clear

echo "⚙️ Clearing config cache..."
php artisan config:clear

echo "👁️ Clearing view cache..."
php artisan view:clear

echo "🔄 Clearing route cache..."
php artisan route:clear

echo "🎨 Clearing Filament components cache..."
php artisan filament:cache-components

echo "✨ Clearing compiled classes..."
php artisan clear-compiled

echo "✅ All caches have been cleared successfully!"