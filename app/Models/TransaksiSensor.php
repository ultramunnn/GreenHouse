<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model untuk menyimpan data transaksi sensor
 * Model ini menangani pencatatan nilai-nilai yang dibaca dari sensor
 */
class TransaksiSensor extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan di database
    protected $table = 'transaksi_sensor';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'masterdevice_id', // ID referensi ke master device
        'nilai',           // Nilai yang dibaca dari sensor
        'waktu_pencatatan' // Waktu saat pembacaan sensor dilakukan
    ];

    // Mengaktifkan pencatatan waktu create dan update otomatis
    public $timestamps = true;

    // Menentukan tipe data untuk kolom-kolom tertentu
    protected $casts = [
        'nilai' => 'float',               // Memastikan nilai sensor bertipe float
        'waktu_pencatatan' => 'datetime'  // Memastikan waktu dalam format datetime
    ];

    // Relasi ke model MasterDevice - Setiap transaksi sensor berkaitan dengan satu master device
    public function masterDevice(): BelongsTo
    {
        return $this->belongsTo(MasterDevice::class, 'masterdevice_id');
    }

    // Kolom yang akan dikonversi ke Carbon instances
    protected $dates = ['waktu_pencatatan'];
}
