<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model untuk mengelola data master perangkat
 * Model ini berfungsi sebagai data induk untuk semua perangkat dalam sistem
 */
class MasterDevice extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan di database
    protected $table = 'masterdevice';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_device',               // Nama dari perangkat
        'keterangan',               // Informasi tambahan tentang perangkat
        'masterkategori_device_id'  // ID kategori dari perangkat
    ];

    // Relasi ke model TransaksiSensor - Satu master device dapat memiliki banyak transaksi sensor
    public function transaksiSensor(): HasMany
    {
        return $this->hasMany(TransaksiSensor::class, 'masterdevice_id');
    }

    // Relasi ke model KategoriDevice - Setiap master device memiliki satu kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriDevice::class, 'masterkategori_device_id');
    }
}