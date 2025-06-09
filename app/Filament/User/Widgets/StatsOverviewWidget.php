<?php

namespace App\Filament\User\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\TransaksiSensor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
            Stat::make('Nilai Sensor Terakhir', $nilaiSensor . ' LUX')
                ->description('Nilai sensor cahaya terakhir')
                ->icon('heroicon-m-sun')
                ->color('success'),
            Stat::make('Waktu Pencatatan', $waktuPencatatan)
                ->description('Waktu pembacaan terakhir')
                ->icon('heroicon-m-clock')
                ->color('success'),
        ];
    }
}