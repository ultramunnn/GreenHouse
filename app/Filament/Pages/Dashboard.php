<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\BlogPostsChart;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    public function getTitle(): string 
    {
        return 'Admin Dashboard';
    }

    public function getWidgets(): array
    {
        return [
            BlogPostsChart::class,
        ];
    }

    public function mount(): void
    {
        if (auth()->user()->role !== 'admin') {
            redirect()->to('/user')->send();
        }
    }
} 