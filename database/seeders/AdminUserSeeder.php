<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Cek apakah user admin sudah ada berdasarkan email
        $adminEmail = 'admin@gmail.com';

        $user = User::where('email', $adminEmail)->first();

        if (! $user) {
            User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'password' => Hash::make('123'), // Ganti sesuai kebutuhan
                'role' => 'admin',
                'is_approved' => true,
            ]);
            $this->command->info('Admin user berhasil dibuat.');
        } else {
            $this->command->info('Admin user sudah ada, tidak dibuat ulang.');
        }
    }
}
