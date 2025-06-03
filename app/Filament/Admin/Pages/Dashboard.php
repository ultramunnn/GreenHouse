<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard Admin';
    protected static ?string $title = 'Dashboard Admin';
    
    public function getTitle(): string 
    {
        return 'Dashboard Admin GreenHouse';
    }

    public function mount(): void
    {
        if (!auth()->user()->isAdmin()) {
            redirect()->route('filament.user.pages.dashboard');
        }
    }
} 