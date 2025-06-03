<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MasterKategoriDevice;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Devices extends Model
{
    use HasFactory;

    protected $table = 'masterdevice'; // nama tabel di database

    protected $fillable = [
        'nama_device',
        'jenis_device',
        'masterkategori_device_id',
        'keterangan',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriDevice::class, 'masterkategori_device_id');
    }
}
