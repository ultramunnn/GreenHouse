<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Devices;
use App\Models\LogAktivitas;
use App\Models\KategoriDevice;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Device', Devices::count())
                ->description('Total perangkat terdaftar')
                ->icon('heroicon-m-computer-desktop')
                ->color('success'),
            Stat::make('Kategori Device', KategoriDevice::count())
                ->description('Jumlah kategori perangkat')
                ->icon('heroicon-m-squares-2x2')
                ->color('success'),
            Stat::make('Log Aktivitas', LogAktivitas::count())
                ->description('Total log aktivitas')
                ->icon('heroicon-m-clipboard-document-list')
                ->color('success'),
        ];
    }
} 