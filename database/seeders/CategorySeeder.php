<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Ciencia Ficción',
            'Fantasía',
            'Novela Histórica',
            'Misterio y Suspense',
            'Biografía',
            'Desarrollo Personal',
            'Tecnología',
            'Poesía'
        ];

        // Fecha base para las categorías (hace 3 años)
        $baseDate = Carbon::now()->subYears(3);

        foreach ($categories as $index => $categoryName) {
            // Cada categoría se crea con un pequeño intervalo
            $categoryDate = $baseDate->copy()->addDays($index * 15);
            
            Category::create([
                'nombre' => $categoryName,
                'created_at' => $categoryDate,
                'updated_at' => $categoryDate,
            ]);
        }
    }
}
