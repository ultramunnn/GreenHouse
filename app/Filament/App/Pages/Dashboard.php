<?php

namespace App\Filament\App\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    public function getTitle(): string 
    {
        return 'Dashboard GreenHouse';
    }
    
    protected function getHeaderWidgets(): array
    {
        return [];
    }
} 