<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creamos 15 autores de ejemplo
        for ($i = 0; $i < 15; $i++) {
            Author::create([
                'nombre' => fake()->firstName(), // Usamos firstName() para el nombre
                'apellido' => fake()->lastName(),   // Usamos lastName() para el apellido
            ]);
        }
    }
}
