<?php

namespace App\Filament\Admin\Resources\DeviceKategoryResource\Pages;

use App\Filament\Admin\Resources\DeviceKategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Halaman Edit Kategori Device
 * Menampilkan form untuk mengubah data kategori device yang ada
 * Menyediakan opsi untuk menghapus kategori
 */
class EditDeviceKategory extends EditRecord
{
    protected static string $resource = DeviceKategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman list setelah edit selesai
        return $this->getResource()::getUrl('index');
    }
}
