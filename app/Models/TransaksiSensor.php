<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model untuk mengelola data transaksi sensor
 * Model ini menyimpan data hasil pembacaan dari sensor-sensor yang terpasang
 */
class TransaksiSensor extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan di database
    protected $table = 'transaksi_sensor';

    /**
     * Mendefinisikan kolom-kolom yang dapat diisi (fillable)
     * Data yang disimpan mencakup nilai sensor dan waktu pencatatan
     */
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

    /**
     * Relasi dengan model Devices
     * Setiap transaksi sensor terkait dengan satu device tertentu
     */
    public function masterDevice(): BelongsTo
    {
        return $this->belongsTo(MasterDevice::class, 'masterdevice_id');
    }

    // Kolom yang akan dikonversi ke Carbon instances
    protected $dates = ['waktu_pencatatan'];
}
