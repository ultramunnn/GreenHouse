<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiSensor extends Model
{
    use HasFactory;

    protected $table = 'transaksi_sensor'; // Nama tabel sesuai dengan yang Anda gunakan
    protected $fillable = [
        'masterdevice_id',
        'nilai',
        'waktu_pencatatan'
    ];
    
    // Mengaktifkan timestamps
    public $timestamps = true;

    protected $casts = [
        'nilai' => 'float',
        'waktu_pencatatan' => 'datetime'
    ];

    // Relasi dengan MasterDevice
    public function masterDevice(): BelongsTo
    {
        return $this->belongsTo(MasterDevice::class, 'masterdevice_id');
    }

    // Memastikan waktu_pencatatan dikonversi ke Carbon
    protected $dates = ['waktu_pencatatan'];
}
