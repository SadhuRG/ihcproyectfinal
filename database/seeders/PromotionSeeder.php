<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use App\Models\Category;
use App\Models\Edition;
use Carbon\Carbon;

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

        // Fecha base para las promociones (últimos 6 meses)
        $baseDate = Carbon::now()->subMonths(6);

        foreach ($promotions as $index => $promoData) {
            // Cada promoción se crea con un intervalo
            $promotionDate = $baseDate->copy()->addDays($index * 30);

            $promotion = Promotion::create([
                'nombre' => $promoData['nombre'],
                'tipo' => $promoData['tipo'],
                'modalidad_promocion' => $promoData['modalidad_promocion'],
                'cantidad' => $promoData['cantidad'],
                'created_at' => $promotionDate,
                'updated_at' => $promotionDate,
            ]);

            // Asignar promociones a categorías o libros
            if ($promoData['tipo'] === 'categoria') {
                $promotion->categories()->attach($categories->random(2)->pluck('id'), [
                    'created_at' => $promotionDate,
                    'updated_at' => $promotionDate,
                ]);
            } elseif ($promoData['tipo'] === 'libro') {
                $promotion->editions()->attach($editions->random(3)->pluck('id'), [
                    'created_at' => $promotionDate,
                    'updated_at' => $promotionDate,
                ]);
            }
        }
    }
}
