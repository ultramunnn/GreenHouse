<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Admin\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Admin\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\AdminMiddleware;
use App\Filament\Admin\Pages\Dashboard;
use App\Filament\Admin\Resources\UserResource;
use App\Filament\Admin\Resources\DevicesResource;
use App\Filament\Admin\Resources\DeviceKategoryResource;
use App\Filament\Admin\Resources\LogAktivitasResource;
use App\Filament\Widgets\Location1SensorChart;
use App\Filament\Widgets\Location2SensorChart;



use App\Filament\Pages\Auth\Login;
use App\Http\Middleware\RedirectAfterLogout;

/**
 * Provider Panel Admin
 * Mengkonfigurasi panel admin Filament
 * Mendaftarkan resource, widget, dan middleware yang digunakan di panel admin
 */
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->resources([
                UserResource::class,
                DevicesResource::class,
                DeviceKategoryResource::class,
                LogAktivitasResource::class,
            ])
            ->widgets([
             
         
                Location1SensorChart::class,
                Location2SensorChart::class,
            ])
            ->pages([
                Dashboard::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                RedirectAfterLogout::class,
                AdminMiddleware::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->authGuard('web')
            ->brandName('Admin Panel')
            ->viteTheme('resources/css/app.css')
            ->spa();
            }
}
