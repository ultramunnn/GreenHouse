<?php

namespace App\Filament\Widgets;

use App\Models\TransaksiSensor;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class Location1SensorChart extends ChartWidget
{
    protected static ?string $heading = 'Sensor Lokasi 1';
    protected static ?int $sort = 1;
    protected static ?string $maxHeight = '300px';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        // Get the last 10 readings for Location 1 (masterdevice_id = 1)
        $readings = TransaksiSensor::where('masterdevice_id', 1)
            ->latest('waktu_pencatatan')
            ->take(10)
            ->get()
            ->reverse();

        return [
            'datasets' => [
                [
                    'label' => 'Intensitas Cahaya (Lux)',
                    'data' => $readings->pluck('nilai')->toArray(),
                    'borderColor' => '#10B981',
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