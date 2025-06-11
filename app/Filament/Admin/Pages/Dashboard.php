<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;
use App\Filament\Widgets\Location1SensorChart;
use App\Filament\Widgets\Location2SensorChart;
use App\Filament\Widgets\SensorStatsOverview;


/**
 * Halaman Dashboard Admin
 * Menampilkan halaman dashboard admin
 * Menyediakan informasi statistik dan widget yang relevan
 */

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard Admin';
    protected static ?string $title = 'Dashboard Admin';

    public function getTitle(): string
    {
        return 'Dashboard Admin GreenHouse';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SensorStatsOverview::class,
        ];
    }


    public function mount(): void
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            Auth::logout();
            $this->redirect(route('filament.user.auth.login'));
        }
    }
}