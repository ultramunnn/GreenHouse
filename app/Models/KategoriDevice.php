<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriDevice extends Model
{
    use HasFactory;

    protected $table = 'masterkategori_device';
    protected $fillable = [
        'nama_kategori',
        'keterangan',
    ];

    public function devices(): HasMany
    {
        return $this->hasMany(Devices::class, 'masterkategori_device_id');
    }
}
