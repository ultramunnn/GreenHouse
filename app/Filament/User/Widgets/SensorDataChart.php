<?php

namespace App\Filament\User\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SensorDataChart extends ChartWidget
{
    protected static ?string $heading = 'Data Sensor Cahaya';
    protected static ?string $pollingInterval = '2s';
    protected static string $chartId = 'sensor-chart-user';

    public ?string $masterKategoriDevice = 'LUX';
    protected $previousData = null;

    public function getMaxValue(): float
    {
        return DB::table('transaksi_sensor')
            ->join('masterdevice', 'transaksi_sensor.masterdevice_id', '=', 'masterdevice.id')
            ->join('masterkategori_device', 'masterdevice.masterkategori_device_id', '=', 'masterkategori_device.id')
            ->where('masterkategori_device.nama_kategori', $this->masterKategoriDevice)
            ->max('nilai') ?? 100;
    }

    protected function getData(): array
    {
        $latestData = DB::table('transaksi_sensor')
            ->join('masterdevice', 'transaksi_sensor.masterdevice_id', '=', 'masterdevice.id')
            ->join('masterkategori_device', 'masterdevice.masterkategori_device_id', '=', 'masterkategori_device.id')
            ->where('masterkategori_device.nama_kategori', $this->masterKategoriDevice)
            ->where('transaksi_sensor.created_at', '>=', now()->subMinutes(5))
            ->orderBy('transaksi_sensor.created_at', 'asc')
            ->select('transaksi_sensor.created_at', 'transaksi_sensor.nilai')
            ->get();

        if ($latestData->isEmpty()) {
            $latestData = collect([
                (object) ['created_at' => now(), 'nilai' => 0]
            ]);
        }

        $labels = $latestData->map(fn($item) => Carbon::parse($item->created_at)->format('H:i'))->toArray();
        $values = $latestData->pluck('nilai')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Nilai ' . $this->masterKategoriDevice,
                    'data' => $values,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                    'tension' => 0.2,
                    'borderWidth' => 2,
                    'pointRadius' => 4,
                    'pointBackgroundColor' => '#10B981',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        $maxValue = $maxValue = max($this->getMaxValue(), 20000); // Ensure we can see up to at least 25,000 lux


        return [
            'scales' => [
                'y' => [
                    'min' => 0,
                    'max' => $maxValue * 1.2,
                    'grid' => [
                        'display' => true,
                        'color' => 'rgba(0,0,0,0.05)',
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Nilai ' . $this->masterKategoriDevice
                    ],
                    'ticks' => [
                        'stepSize' => max(1, round($maxValue / 10)),
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => true,
                        'color' => 'rgba(0,0,0,0.05)',
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Waktu'
                    ],
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
            'animation' => false,
            'interaction' => [
                'intersect' => false,
                'mode' => 'index',
            ],
            'elements' => [
                'line' => [
                    'tension' => 0.2
                ]
            ]
        ];
    }
}