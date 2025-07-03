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
        $editorials = [
            'Alfaguara',
            'Planeta',
            'Random House',
            'Penguin Books',
            'HarperCollins',
            'Simon & Schuster',
            'Bloomsbury',
            'Salamandra',
            'Debolsillo',
            'Tusquets',
            'Anagrama',
            'Seix Barral',
            'Grijalbo',
            'Ediciones B',
            'Espasa Calpe',
            'Santillana',
            'SM',
            'Vicens Vives',
            'Cátedra',
            'Akal',
            'Paidós',
            'Ariel',
            'Crítica',
            'Temas de Hoy',
            'Urano',
            'Plaza & Janés',
            'Minotauro',
            'Debate',
            'Aguilar',
            'Elipse',
            'Obelisco',
            'Alianza',
            'Real Academia Española',
        ];

        // Fecha base para las editoriales (últimos 20 años)
        $baseDate = Carbon::now()->subYears(20);

        foreach ($editorials as $index => $editorialName) {
            // Cada editorial se crea con un intervalo
            $editorialDate = $baseDate->copy()->addDays($index * 20);
            
            Editorial::create([
                'nombre' => $editorialName,
                'created_at' => $editorialDate,
                'updated_at' => $editorialDate,
            ]);
        }
    }
}
