<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

/**
 * Widget DeviceStatisticsChart
 * Menampilkan statistik jumlah device berdasarkan kategori
 * Memperbarui data secara otomatis setiap 2 detik
 */

class DeviceStatisticsChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Device per Kategori';
    protected static string $chartId = 'device-statistics';
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $data = DB::table('masterdevice')
            ->join('masterkategori_device', 'masterdevice.masterkategori_device_id', '=', 'masterkategori_device.id')
            ->select('masterkategori_device.nama_kategori', DB::raw('count(*) as total'))
            ->groupBy('masterkategori_device.nama_kategori')
            ->get();

        return [
            'labels' => $data->pluck('nama_kategori')->toArray(),
            'datasets' => [
                [
                    'label' => 'Device per Kategori',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => array_fill(0, $data->count(), '#10B981'), // Consistent green color
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
} 