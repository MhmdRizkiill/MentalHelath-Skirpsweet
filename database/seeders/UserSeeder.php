<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat akun Admin
        User::create([
            'username' => 'admin', // Login admin sekarang menggunakan username ini
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Buat akun Mahasiswa Anonim Dummy
        User::create([
            'username' => 'anonim123', // Contoh akun samaran untuk testing
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
        ]);
    }
}