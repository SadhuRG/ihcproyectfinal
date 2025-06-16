<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Editorial;

class EditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creamos 10 editoriales de ejemplo
        for ($i = 0; $i < 10; $i++) {
            Editorial::create([
                'nombre' => fake()->company() . ' Press'
            ]);
        }
    }
}
