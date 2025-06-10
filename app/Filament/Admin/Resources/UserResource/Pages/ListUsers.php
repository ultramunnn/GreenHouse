<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * Halaman Daftar User
 * Menampilkan tabel berisi daftar semua user
 * Menyediakan fitur pencarian dan pengurutan data
 */

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 