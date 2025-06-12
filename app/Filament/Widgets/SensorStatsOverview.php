<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\TransaksiSensor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SensorStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '2s';
    
    // Tambahkan properti untuk Filament
    protected int | string | array $columnSpan = 'full';
    public static function canView(): bool
    {
        return true;
    }

    protected function getStats(): array
    {
        // Get latest reading for Location 1 (masterdevice_id = 1)
        $latestSensor1 = DB::table('transaksi_sensor')
            ->where('masterdevice_id', 1)
            ->orderBy('waktu_pencatatan', 'desc')
            ->select('waktu_pencatatan', 'nilai')
            ->first();

        // Get latest reading for Location 2 (masterdevice_id = 2)
        $latestSensor2 = DB::table('transaksi_sensor')
            ->where('masterdevice_id', 2)
            ->orderBy('waktu_pencatatan', 'desc')
            ->select('waktu_pencatatan', 'nilai')
            ->first();

        $nilaiSensor1 = $latestSensor1 ? number_format($latestSensor1->nilai, 1) : '0';
        $waktuPencatatan1 = $latestSensor1 ? Carbon::parse($latestSensor1->waktu_pencatatan)->format('H:i:s') : '-';

        $nilaiSensor2 = $latestSensor2 ? number_format($latestSensor2->nilai, 1) : '0';
        $waktuPencatatan2 = $latestSensor2 ? Carbon::parse($latestSensor2->waktu_pencatatan)->format('H:i:s') : '-';

        return [
            Stat::make('Lokasi 1 - Intensitas Cahaya', $nilaiSensor1 . ' LUX')
                ->description('Update terakhir: ' . $waktuPencatatan1)
                ->icon('heroicon-m-sun')
                ->color('success'),
            
            Stat::make('Lokasi 2 - Intensitas Cahaya', $nilaiSensor2 . ' LUX')
                ->description('Update terakhir: ' . $waktuPencatatan2)
                ->icon('heroicon-m-sun')
                ->color('primary'),
        ];
    }
}