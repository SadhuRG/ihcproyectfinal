<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamamos al seeder de roles y usuarios que ya tenías
        $this->call(RolesAndUsersSeeder::class);

        // Llamamos a los nuevos seeders en orden
        $this->call([
            ExtraUserSeeder::class,
            AuthorSeeder::class,
            EditorialSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
        ]);
    }
}
