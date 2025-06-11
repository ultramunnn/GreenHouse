<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Facades\FilamentView;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use App\Filament\Widgets\Location1SensorChart;
use App\Filament\Widgets\Location2SensorChart;
use App\Filament\Widgets\SensorStatsOverview;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            SensorStatsOverview::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            Location1SensorChart::class,
            Location2SensorChart::class,
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() && auth()->user()->role === 'user';
    }

    public function getTitle(): string
    {
        return 'Dashboard GreenHouse';
    }

    public function mount(): void
    {
        if (!auth()->check()) {
            $this->redirect(route('filament.user.auth.login'));
            return;
        }

        if (auth()->user()->role === 'admin') {
            $this->redirect(route('filament.admin.pages.dashboard'));
            return;
        }

        if (!auth()->user()->isApproved()) {
            Auth::logout();
            $this->redirect(route('filament.user.auth.login'));
            return;
        }
    }
}