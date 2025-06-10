<?php

namespace App\Filament\Admin\Resources\DevicesResource\Pages;

use App\Filament\Admin\Resources\DevicesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

/**
 * Halaman Tambah Device
 * Menampilkan form untuk menambah device baru
 * Setelah berhasil menambah, akan diarahkan ke halaman daftar device
 */
class CreateDevices extends CreateRecord
{
    protected static string $resource = DevicesResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman list setelah create selesai
        return $this->getResource()::getUrl('index');
    }

}
