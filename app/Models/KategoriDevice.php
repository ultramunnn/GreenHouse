<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model untuk mengelola kategori perangkat
 * Model ini menyimpan daftar kategori-kategori yang tersedia untuk perangkat
 */
class KategoriDevice extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan di database
    protected $table = 'masterkategori_device';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_kategori', // Nama kategori perangkat (contoh: LUX, Suhu, dll)
        'keterangan',    // Deskripsi atau informasi tambahan tentang kategori
    ];

    // Relasi ke model Devices - Satu kategori dapat memiliki banyak device
    public function devices(): HasMany
    {
        return $this->hasMany(Devices::class, 'masterkategori_device_id');
    }
}
