<?php

namespace App\Filament\Admin\Resources\LogAktivitasResource\Pages;

use App\Filament\Admin\Resources\LogAktivitasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Halaman Edit Log Aktivitas
 * Menampilkan form untuk mengubah data log aktivitas yang ada
 * Menyediakan opsi untuk menghapus log aktivitas
 */

class EditLogAktivitas extends EditRecord
{
    protected static string $resource = LogAktivitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
