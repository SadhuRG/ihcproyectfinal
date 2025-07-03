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
            'Literatura Contemporánea',
            'Novela Histórica',
            'Ciencia Ficción',
            'Fantasía',
            'Misterio y Suspense',
            'Romance',
            'Biografía y Memorias',
            'Desarrollo Personal',
            'Negocios y Economía',
            'Tecnología e Informática',
            'Poesía',
            'Teatro',
            'Ensayo',
            'Filosofía',
            'Psicología',
            'Historia',
            'Ciencias Sociales',
            'Arte y Fotografía',
            'Cocina y Gastronomía',
            'Viajes y Geografía',
            'Infantil y Juvenil',
            'Educación',
            'Salud y Bienestar',
            'Religión y Espiritualidad',
            'Política y Actualidad',
        ];

        // Fecha base para las categorías (hace 5 años)
        $baseDate = Carbon::now()->subYears(5);

        foreach ($categories as $index => $categoryName) {
            // Cada categoría se crea con un pequeño intervalo
            $categoryDate = $baseDate->copy()->addDays($index * 10);
            
            Category::create([
                'nombre' => $categoryName,
                'created_at' => $categoryDate,
                'updated_at' => $categoryDate,
            ]);
        }
    }
}
