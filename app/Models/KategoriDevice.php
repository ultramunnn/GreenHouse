<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriDevice extends Model
{
    //

    protected $table = 'masterkategori_device';
    protected $fillable = [
        'nama_kategori',
        'keterangan',
    ];
}
