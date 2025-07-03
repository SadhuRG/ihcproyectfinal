<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promotion;
use App\Models\Book;
use App\Models\Edition;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener algunos libros para aplicar promociones
        $libros = Book::with('editions')->take(3)->get();

        $promociones = [
            [
                'nombre' => 'Descuento Verano 2025 - El Quijote',
                'tipo' => 'libro',
                'modalidad_promocion' => 'porcentual',
                'cantidad' => 25, // 25% de descuento
                'libro_index' => 0, // Primer libro
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now()->addMonths(2),
            ],
            [
                'nombre' => 'Oferta Especial - Cien Años de Soledad',
                'tipo' => 'libro',
                'modalidad_promocion' => 'porcentual',
                'cantidad' => 30, // 30% de descuento
                'libro_index' => 1, // Segundo libro
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now()->addMonth(),
            ],
            [
                'nombre' => 'Promoción de Lanzamiento - Don Juan Tenorio',
                'tipo' => 'libro',
                'modalidad_promocion' => 'porcentual',
                'cantidad' => 15, // 15% de descuento
                'libro_index' => 2, // Tercer libro
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now()->addWeeks(3),
            ],
        ];

        foreach ($promociones as $promoData) {
            // Verificar que el libro existe
            if (!isset($libros[$promoData['libro_index']])) {
                continue;
            }

            $libro = $libros[$promoData['libro_index']];
            
            // Crear la promoción
            $promotion = Promotion::create([
                'nombre' => $promoData['nombre'],
                'tipo' => $promoData['tipo'],
                'modalidad_promocion' => $promoData['modalidad_promocion'],
                'cantidad' => $promoData['cantidad'],
            ]);

            // Obtener todas las ediciones del libro
            $ediciones = $libro->editions;

            foreach ($ediciones as $edicion) {
                // Calcular el precio promocional
                $descuento = $edicion->precio * ($promoData['cantidad'] / 100);
                $precio_promocional = $edicion->precio - $descuento;

                // Actualizar la edición con el precio promocional
                $edicion->update([
                    'precio_promocional' => round($precio_promocional, 2)
                ]);

                // Crear la relación promoción-edición con fechas
                $promotion->editions()->attach($edicion->id, [
                    'fecha_inicio' => $promoData['fecha_inicio'],
                    'fecha_fin' => $promoData['fecha_fin'],
                ]);
            }

            $this->command->info("Promoción '{$promoData['nombre']}' aplicada al libro '{$libro->titulo}' con {$promoData['cantidad']}% de descuento");
        }

        $this->command->info('Promociones aplicadas exitosamente a libros específicos');
    }
}
