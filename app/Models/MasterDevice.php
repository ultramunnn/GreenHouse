<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterDevice extends Model
{
    use HasFactory;

    protected $table = 'masterdevice';
    
    protected $fillable = [
        'nama_device',
        'keterangan',
        'masterkategori_device_id'
    ];

    // Relasi dengan TransaksiSensor
    public function transaksiSensor(): HasMany
    {
        return $this->hasMany(TransaksiSensor::class, 'masterdevice_id');
    }

    // Relasi dengan KategoriDevice
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriDevice::class, 'masterkategori_device_id');
    }
} 