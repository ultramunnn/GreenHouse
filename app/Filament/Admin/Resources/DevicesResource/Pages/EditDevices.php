<?php

namespace App\Filament\Admin\Resources\DevicesResource\Pages;

use App\Filament\Admin\Resources\DevicesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Halaman Edit Device
 * Menampilkan form untuk mengubah data device yang ada
 * Menyediakan opsi untuk menghapus device
 */
class EditDevices extends EditRecord
{
    protected static string $resource = DevicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
