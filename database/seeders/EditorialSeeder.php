<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Editorial;
use Carbon\Carbon;

class EditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creamos 10 editoriales de ejemplo
        for ($i = 0; $i < 10; $i++) {
            // Fecha de creación de la editorial (últimos 10 años)
            $editorialCreatedAt = Carbon::now()->subDays(rand(0, 3650));
            
            Editorial::create([
                'nombre' => fake()->company() . ' Press',
                'created_at' => $editorialCreatedAt,
                'updated_at' => $editorialCreatedAt,
            ]);
        }
    }
}
