<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Facades\FilamentView;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';
    protected static ?string $title = 'Dashboard';
    protected static ?int $navigationSort = -2;

    public function mount(): void
    {
        // Redirect admin to admin dashboard
        if (auth()->user()->role === 'admin') {
            redirect()->to('/admin')->send();
        }
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Stats Overview
            \App\Filament\Widgets\StatsOverview::class,
        ];
    }

    protected function getColumns(): int | array
    {
        return 2;
    }
} 