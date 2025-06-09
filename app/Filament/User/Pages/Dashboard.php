<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Facades\FilamentView;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;



class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() && auth()->user()->role === 'user';
    }

    public function getTitle(): string
    {
        return 'Dashboard GreenHouse';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            
        ];
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