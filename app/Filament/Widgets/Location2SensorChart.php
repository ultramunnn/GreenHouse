<?php

namespace App\Filament\Widgets;

use App\Models\TransaksiSensor;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class Location2SensorChart extends ChartWidget
{
    protected static ?string $heading = 'Sensor Lokasi 2';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '300px';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '2s';

    protected function getData(): array
    {
        // Get the last 10 readings for Location 2 (masterdevice_id = 2)
        $readings = TransaksiSensor::where('masterdevice_id', 2)
            ->latest('waktu_pencatatan')
            ->take(10)
            ->get()
            ->reverse();

        return [
            'datasets' => [
                [
                    'label' => 'Intensitas Cahaya (Lux)',
                    'data' => $readings->pluck('nilai')->toArray(),
                    'borderColor' => '#3B82F6',
                    'fill' => false,
                ]
            ],
            'labels' => $readings->pluck('waktu_pencatatan')->map(function ($date) {
                return Carbon::parse($date)->format('H:i:s');
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public static function canView(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'user']);
    }
} 