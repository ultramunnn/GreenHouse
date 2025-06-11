<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Halaman Edit User
 * Menampilkan form untuk mengubah data user yang ada
 * Menyediakan opsi untuk menghapus user
 */

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

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