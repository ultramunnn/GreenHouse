<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static string $view = 'filament.user.pages.dashboard';
    
    protected static ?string $title = 'Dashboard';
    
    protected static ?string $slug = 'dashboard';
    
    public static function getNavigationLabel(): string
    {
        return 'Beranda';
    }
    
    public static function getNavigationGroup(): ?string
    {
        return null;
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            // Add your widgets here
        ];
    }
    
    protected function getFooterWidgets(): array
    {
        return [];
    }
} 