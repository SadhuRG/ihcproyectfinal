<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promotion;
use App\Models\Book;
use App\Models\Edition;

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
                'cantidad' => 25, // 25% de descuento
                'libro_index' => 0, // Primer libro
            ],
            [
                'nombre' => 'Oferta Especial - Cien Años de Soledad',
                'cantidad' => 30, // 30% de descuento
                'libro_index' => 1, // Segundo libro
            ],
            [
                'nombre' => 'Promoción de Lanzamiento - Don Juan Tenorio',
                'cantidad' => 15, // 15% de descuento
                'libro_index' => 2, // Tercer libro
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
                'cantidad' => $promoData['cantidad'],
            ]);

            // Asociar el libro a la promoción
            $promotion->books()->attach($libro->id);

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
            }

            $this->command->info("Promoción '{$promoData['nombre']}' aplicada al libro '{$libro->titulo}' con {$promoData['cantidad']}% de descuento");
        }

        $this->command->info('Promociones aplicadas exitosamente a libros específicos');
    }
}
