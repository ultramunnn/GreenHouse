<?php

namespace App\Filament\Admin\Resources\DevicesResource\Pages;

use App\Filament\Admin\Resources\DevicesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * Halaman Daftar Device
 * Menampilkan tabel berisi daftar semua device
 * Menyediakan fitur pencarian dan pengurutan data
 */

class ListDevices extends ListRecords
{
    protected static string $resource = DevicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->createAnother(false)
        ];
    }
    
}
