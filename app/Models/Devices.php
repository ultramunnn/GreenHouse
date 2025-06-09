<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MasterKategoriDevice;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model untuk mengelola data perangkat (devices)
 * Model ini berhubungan dengan tabel devices di database
 */
class Devices extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan di database
    protected $table = 'masterdevice';

    /**
     * Mendefinisikan kolom-kolom yang dapat diisi (fillable)
     * Kolom ini bisa diisi secara massal menggunakan metode create atau update
     */
    protected $fillable = [
        'nama_device',               // Nama dari perangkat
        'jenis_device',             // Jenis atau tipe perangkat
        'masterkategori_device_id', // ID kategori dari perangkat
        'keterangan',               // Informasi tambahan tentang perangkat
    ];

    /**
     * Relasi dengan model User
     * Setiap device dimiliki oleh satu user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi dengan model KategoriDevice
     * Setiap device memiliki satu kategori
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriDevice::class, 'masterkategori_device_id');
    }

    /**
     * Relasi dengan model TransaksiSensor
     * Satu device bisa memiliki banyak transaksi sensor
     */
    public function transaksiSensor(): HasMany
    {
        return $this->hasMany(TransaksiSensor::class, 'device_id');
    }
}
