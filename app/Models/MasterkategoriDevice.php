<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model untuk mengelola kategori master device
 * Model ini menyimpan daftar kategori-kategori untuk perangkat
 */
class MasterkategoriDevice extends Model
{
    /**
     * Nama tabel yang digunakan oleh model ini
     */
    protected $table = 'masterkategori_device';

    /**
     * Daftar kolom yang bisa diisi secara massal
     */
    protected $fillable = [
        'nama_kategori',
        'deskripsi'
    ];

    /**
     * Relasi dengan model Device
     * Satu kategori bisa memiliki banyak device
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Devices::class, 'masterkategori_device_id');
    }
}
