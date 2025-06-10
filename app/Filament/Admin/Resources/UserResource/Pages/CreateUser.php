<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Halaman Tambah User
 * Menampilkan form untuk menambah user baru
 * Setelah berhasil menambah, akan diarahkan ke halaman daftar user
 */
    
class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
} 