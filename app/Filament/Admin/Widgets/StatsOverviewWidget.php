<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Devices;
use App\Models\LogAktivitas;
use App\Models\KategoriDevice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Widget StatsOverview
 * Menampilkan ringkasan statistik sensor dalam bentuk card
 * Memperbarui data secara real-time setiap 2 detik
 */
class StatsOverviewWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '2s';

    protected function getStats(): array
    {
        $latestSensor = DB::table('transaksi_sensor')
            ->join('masterdevice', 'transaksi_sensor.masterdevice_id', '=', 'masterdevice.id')
            ->join('masterkategori_device', 'masterdevice.masterkategori_device_id', '=', 'masterkategori_device.id')
            ->where('masterkategori_device.nama_kategori', 'LUX')
            ->orderBy('transaksi_sensor.created_at', 'desc')
            ->select('transaksi_sensor.created_at', 'transaksi_sensor.nilai')
            ->first();

        $nilaiSensor = $latestSensor ? number_format($latestSensor->nilai, 1) : '0';
        $waktuPencatatan = $latestSensor ? Carbon::parse($latestSensor->created_at)->format('H:i:s') : '-';

        return [
            Stat::make('Intensitas Cahaya', $nilaiSensor . ' LUX')
                ->description('Pembacaan sensor cahaya terkini')
                ->icon('heroicon-m-sun')
                ->color('success'),
            Stat::make('Waktu Pembacaan', $waktuPencatatan)
                ->description('Terakhir diperbarui')
                ->icon('heroicon-m-clock')
                ->color('success'),
           
        ];
    }
}