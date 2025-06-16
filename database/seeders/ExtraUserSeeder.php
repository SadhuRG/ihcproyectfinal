<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ExtraUserSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 3; $i++) {
            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password123'), // Contraseña por defecto
            ]);
        }
    }
}
