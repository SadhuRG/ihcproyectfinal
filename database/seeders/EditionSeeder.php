<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Edition;
use App\Models\Book;
use App\Models\Editorial;
use App\Models\Inventory;
use Carbon\Carbon;

class EditionSeeder extends Seeder
{
    public function run(): void
    {
        $books = Book::all();
        $editorials = Editorial::all();

        foreach ($books as $book) {
            // Crear 1-3 ediciones por libro
            $numEditions = rand(1, 3);

            for ($i = 1; $i <= $numEditions; $i++) {
                // Fecha de creación de la edición (después de la creación del libro)
                $bookCreatedAt = Carbon::parse($book->created_at);
                $editionCreatedAt = $bookCreatedAt->addDays(rand(30, 180));
                
                // Crear inventario primero
                $inventory = Inventory::create([
                    'cantidad' => rand(10, 100),
                    'umbral' => rand(5, 20),
                    'created_at' => $editionCreatedAt,
                    'updated_at' => $editionCreatedAt,
                ]);

                // Crear edición
                Edition::create([
                    'editorial_id' => $editorials->random()->id,
                    'inventorie_id' => $inventory->id,
                    'book_id' => $book->id,
                    'url_portada' => '/images/covers/' . $book->id . '_' . $i . '.jpg',
                    'numero_edicion' => $i . ($i == 1 ? 'ra' : ($i == 2 ? 'da' : 'ra')) . ' edición',
                    'url_pdf' => null,
                    'precio' => rand(200, 800) / 10, // 20.0 a 80.0
                    'created_at' => $editionCreatedAt,
                    'updated_at' => $editionCreatedAt,
                ]);
            }
        }
    }
}
