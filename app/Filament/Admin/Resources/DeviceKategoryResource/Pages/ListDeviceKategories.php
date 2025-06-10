<?php

namespace App\Filament\Admin\Resources\DeviceKategoryResource\Pages;

use App\Filament\Admin\Resources\DeviceKategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * Halaman Daftar Kategori Device
 * Menampilkan tabel berisi daftar semua kategori device
 * Menyediakan fitur pencarian dan pengurutan data
 */
class ListDeviceKategories extends ListRecords
{
    protected static string $resource = DeviceKategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->createAnother(false),
        ];
    }
}
