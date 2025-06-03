<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class BlogPostsChart extends ChartWidget
{
    protected static ?string $heading = 'Data Sensor Cahaya';
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
         return Cache::remember('sensor_cahaya_chart_data', now()->addMinutes(10), function () {
            return [
                'labels' => ['08:00', '09:00', '10:00', '11:00', '12:00'],
                'datasets' => [
                    [
                        'label' => 'Nilai LUX',
                        'data' => [150, 300, 500, 700, 400], // contoh data LUX hardcoded
                        'backgroundColor' => 'rgba(75, 192, 192, 0.5)',
                        'borderColor' => 'rgba(75, 192, 192, 1)',
                        'borderWidth' => 1,
                    ],
                ],
            ];
        });
    }

    protected function getType(): string
    {
        return 'line';
    }
}
