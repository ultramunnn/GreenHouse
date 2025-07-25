<?php

namespace App\Filament\Admin\Resources\DeviceKategoryResource\Pages;

use App\Filament\Admin\Resources\DeviceKategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

/**
 * Halaman Tambah Kategori Device
 * Menampilkan form untuk menambah kategori device baru
 * Setelah berhasil menambah, akan diarahkan ke halaman daftar kategori device
 */

class CreateDeviceKategory extends CreateRecord
{
    protected static string $resource = DeviceKategoryResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman list setelah create selesai
        return $this->getResource()::getUrl('index');
    }
}
