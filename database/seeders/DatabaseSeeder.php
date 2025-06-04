<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterDevice;
use App\Models\TransaksiSensor;
use App\Models\KategoriDevice;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat kategori device terlebih dahulu
        $kategori = KategoriDevice::create([
            'nama_kategori' => 'Sensor Suhu',
            'keterangan' => 'Kategori untuk sensor suhu'
        ]);

        // Membuat data dummy untuk masterdevice
        MasterDevice::create([
            'nama_device' => 'Sensor Suhu 1',
            'keterangan' => 'Sensor untuk mengukur suhu ruangan',
            'masterkategori_device_id' => $kategori->id
        ]);

        // Membuat data dummy untuk transaksi sensor
        TransaksiSensor::create([
            'masterdevice_id' => 1,
            'nilai' => 25.5,
            'waktu_pencatatan' => now()
        ]);
    }
}
