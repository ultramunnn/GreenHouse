<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Facades\FilamentView;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check();
    }
    
    public function getTitle(): string 
    {
        return 'Dashboard GreenHouse';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Widget akan ditambahkan nanti
        ];
    }

    public function mount(): void
    {
        if (auth()->user()->isAdmin()) {
            redirect()->route('filament.admin.pages.dashboard');
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