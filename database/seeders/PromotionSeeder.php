<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use App\Models\Category;
use App\Models\Edition;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $editions = Edition::all();

        $promotions = [
            [
                'nombre' => 'Descuento Ficción 20%',
                'tipo' => 'categoria',
                'modalidad_promocion' => 'porcentual',
                'cantidad' => 20,
            ],
            [
                'nombre' => 'Black Friday - $15 off',
                'tipo' => 'todos',
                'modalidad_promocion' => 'monto fijo',
                'cantidad' => 15,
            ],
            [
                'nombre' => 'Oferta Libro del Mes',
                'tipo' => 'libro',
                'modalidad_promocion' => 'porcentual',
                'cantidad' => 30,
            ],
        ];

        foreach ($promotions as $promoData) {
            $promotion = Promotion::create($promoData);

            // Asignar promociones a categorías o libros
            if ($promoData['tipo'] === 'categoria') {
                $promotion->categories()->attach($categories->random(2)->pluck('id'));
            } elseif ($promoData['tipo'] === 'libro') {
                $promotion->editions()->attach($editions->random(3)->pluck('id'));
            }
        }
    }
}
