<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogPostsChart extends ChartWidget
{
    protected static ?string $heading = 'Data Sensor Cahaya';
    protected static ?string $pollingInterval = '5s';

    // Tambahkan properti untuk filter
    public ?string $masterKategoriDevice = 'LUX';

    protected function getData(): array
    {
        return Cache::remember('sensor_cahaya_chart_data_' . $this->masterKategoriDevice, now()->addSeconds(5), function () {
            // Mengambil data 5 jam terakhir
            $data = DB::table('transaksi_sensor')
                ->join('masterdevice', 'transaksi_sensor.masterdevice_id', '=', 'masterdevice.id')
                ->join('masterkategori_device', 'masterdevice.masterkategori_device_id', '=', 'masterkategori_device.id')
                ->where('transaksi_sensor.created_at', '>=', now()->subHours(5))
                ->where('masterkategori_device.nama_kategori', $this->masterKategoriDevice)
                ->orderBy('transaksi_sensor.created_at', 'asc')
                ->select('transaksi_sensor.created_at', 'transaksi_sensor.nilai')
                ->get()
                ->groupBy(function ($item) {
                    return Carbon::parse($item->created_at)->format('H:i');
                });

            $labels = [];
            $values = [];

            foreach ($data as $hour => $readings) {
                $labels[] = $hour;
                // Mengambil rata-rata nilai sensor per jam
                $values[] = $readings->avg('nilai');
            }

            // Jika data kurang dari 5 titik, tambahkan nilai kosong
            while (count($labels) < 5) {
                array_unshift($labels, '');
                array_unshift($values, 0);
            }

            // Batasi hanya 5 data terakhir
            $labels = array_slice($labels, -5);
            $values = array_slice($values, -5);

            return [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Nilai ' . $this->masterKategoriDevice,
                        'data' => $values,
                        'backgroundColor' => 'rgba(75, 192, 192, 0.5)',
                        'borderColor' => 'rgba(75, 192, 192, 1)',
                        'borderWidth' => 1,
                        'fill' => true,
                    ],
                ],
            ];
        });
    }

    protected function getType(): string
    {
        return 'line';
    }

    // Konfigurasi chart
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Nilai ' . $this->masterKategoriDevice
                    ]
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Waktu'
                    ]
                ]
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top'
                ],
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
        ];
    }
}
