<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model TransaksiSensor
 * Model ini berfungsi untuk mengelola data transaksi sensor pada sistem
 * Berisikan atribut dan relasi yang terkait dengan transaksi sensor
 */
class TransaksiSensor extends Model
{
    use HasFactory;

    /**
     * Mendefinisikan nama tabel yang terhubung dengan model ini
     * @var string
     */
    protected $table = 'transaksi_sensor';

    /**
     * Mendefinisikan atribut-atribut yang dapat diisi (fillable)
     * Atribut ini bisa diisi secara massal menggunakan metode create atau update
     * @var array
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
     * Menghubungkan TransaksiSensor dengan data device yang terkait
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterDevice(): BelongsTo
    {
        return $this->belongsTo(MasterDevice::class, 'masterdevice_id');
    }

    // Kolom yang akan dikonversi ke Carbon instances
    protected $dates = ['waktu_pencatatan'];
}
