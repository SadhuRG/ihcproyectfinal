<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Carbon\Carbon;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creamos 15 autores de ejemplo
        for ($i = 0; $i < 15; $i++) {
            // Fecha de creación del autor (últimos 5 años)
            $authorCreatedAt = Carbon::now()->subDays(rand(0, 1825));
            
            Author::create([
                'nombre' => fake()->firstName(), // Usamos firstName() para el nombre
                'apellido' => fake()->lastName(),   // Usamos lastName() para el apellido
                'created_at' => $authorCreatedAt,
                'updated_at' => $authorCreatedAt,
            ]);
        }
    }
}
