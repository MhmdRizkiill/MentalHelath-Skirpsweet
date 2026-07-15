<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder yang telah dibuat
        $this->call([
            UserSeeder::class,
            QuestionSeeder::class,
        ]);
        
        // HAPUS baris \App\Models\User::factory(10)->create(); di bawah sini
    }
}