<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Dashboard as BasePage;
use Filament\Notifications\Notification;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.user.pages.dashboard';
    
    public function getTitle(): string 
    {
        return 'Dashboard';
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    public function mount(): void
    {
        if (auth()->user()->role === 'admin') {
            redirect()->to('/admin')->send();
        }
    }

    public function redirectToGreenhouse()
    {
        Notification::make()
            ->title('Fitur dalam pengembangan')
            ->warning()
            ->send();
    }

    public function redirectToMonitoring()
    {
        Notification::make()
            ->title('Fitur dalam pengembangan')
            ->warning()
            ->send();
    }

    public function redirectToSettings()
    {
        Notification::make()
            ->title('Fitur dalam pengembangan')
            ->warning()
            ->send();
    }

    public function redirectToHelp()
    {
        Notification::make()
            ->title('Fitur dalam pengembangan')
            ->warning()
            ->send();
    }
} 