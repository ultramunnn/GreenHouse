<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model LogAktivitas
 * Model ini berfungsi untuk mencatat aktivitas yang terjadi dalam sistem
 * Menyimpan informasi seperti nama aktivitas dan alamat IP
 */

class LogAktivitas extends Model
{
    protected $fillable = ['nama_aktivitas', 'ip_address'];

}
