<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

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

        foreach ($categories as $categoryName) {
            Category::create(['nombre' => $categoryName]);
        }
    }
}
