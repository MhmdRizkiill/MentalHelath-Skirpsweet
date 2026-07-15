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
        
        // Memanggil factory untuk generate 10 mahasiswa dummy tambahan
        \App\Models\User::factory(10)->create();
    }
}