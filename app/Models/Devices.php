<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MasterKategoriDevice;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model untuk mengelola data perangkat (device)
 * Model ini menyimpan informasi tentang perangkat-perangkat yang terpasang
 */
class Devices extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan di database
    protected $table = 'masterdevice';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_device',               // Nama dari perangkat
        'jenis_device',             // Jenis atau tipe perangkat
        'masterkategori_device_id', // ID kategori dari perangkat
        'keterangan',               // Informasi tambahan tentang perangkat
    ];

    // Relasi ke model KategoriDevice - Setiap device memiliki satu kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriDevice::class, 'masterkategori_device_id');
    }
}
