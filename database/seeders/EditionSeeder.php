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
            // Determinar cuántas ediciones crear basado en la popularidad del libro
            $numEditions = $this->getEditionCount($book->titulo);
            
            // Fecha base de la primera edición (después de la creación del libro)
            $bookCreatedAt = Carbon::parse($book->created_at);
            $firstEditionDate = $bookCreatedAt->addDays(rand(30, 180));

            for ($i = 1; $i <= $numEditions; $i++) {
                // Fecha de esta edición
                $editionDate = $firstEditionDate->copy()->addDays(($i - 1) * rand(90, 365));
                
                // Crear inventario con stock realista
                $inventory = Inventory::create([
                    'cantidad' => $this->getRealisticStock($book->titulo, $i),
                    'umbral' => $this->getRealisticThreshold($book->titulo),
                    'created_at' => $editionDate,
                    'updated_at' => $editionDate,
                ]);

                // Seleccionar editorial apropiada
                $editorial = $this->getAppropriateEditorial($book->titulo, $editorials);

                // Crear edición
                Edition::create([
                    'editorial_id' => $editorial->id,
                    'inventorie_id' => $inventory->id,
                    'book_id' => $book->id,
                    'url_portada' => '/images/covers/' . $book->id . '_' . $i . '.jpg',
                    'numero_edicion' => $this->getEditionNumber($i),
                    'url_pdf' => null,
                    'precio' => $this->getRealisticPrice($book->titulo, $i),
                    'created_at' => $editionDate,
                    'updated_at' => $editionDate,
                ]);
            }
        }
    }

    private function getEditionCount($bookTitle): int
    {
        // Libros muy populares tienen más ediciones
        $popularBooks = [
            'Cien años de soledad',
            'Harry Potter y la piedra filosofal',
            'Harry Potter y la cámara secreta',
            'El señor de los anillos: La comunidad del anillo',
            'El código Da Vinci',
            'Sapiens: De animales a dioses',
            'Padre Rico, Padre Pobre',
            'Cómo ganar amigos e influir sobre las personas',
            '1984',
            'El principito',
            'Don Quijote de la Mancha'
        ];

        if (in_array($bookTitle, $popularBooks)) {
            return rand(3, 5); // 3-5 ediciones para libros populares
        }

        // Libros clásicos tienen ediciones moderadas
        $classicBooks = [
            'El amor en los tiempos del cólera',
            'La casa de los espíritus',
            'El alquimista',
            'Homo Deus: Breve historia del mañana',
            'Piense y hágase rico',
            'El arte de la guerra',
            'Un mundo feliz',
            'El retrato de Dorian Gray',
            'Crimen y castigo',
            'Los miserables',
            'Rayuela',
            'Ficciones',
            'Veinte poemas de amor y una canción desesperada',
            'Como agua para chocolate'
        ];

        if (in_array($bookTitle, $classicBooks)) {
            return rand(2, 4); // 2-4 ediciones para clásicos
        }

        return rand(1, 2); // 1-2 ediciones para otros libros
    }

    private function getRealisticStock($bookTitle, $editionNumber): int
    {
        // Stock base según popularidad
        $baseStock = 50;

        // Libros muy populares tienen más stock
        $veryPopular = [
            'Harry Potter y la piedra filosofal',
            'Harry Potter y la cámara secreta',
            'El código Da Vinci',
            'Sapiens: De animales a dioses',
            'Padre Rico, Padre Pobre'
        ];

        if (in_array($bookTitle, $veryPopular)) {
            $baseStock = 150;
        }

        // Libros populares
        $popular = [
            'Cien años de soledad',
            'El señor de los anillos: La comunidad del anillo',
            'Cómo ganar amigos e influir sobre las personas',
            '1984',
            'El principito',
            'Don Quijote de la Mancha'
        ];

        if (in_array($bookTitle, $popular)) {
            $baseStock = 100;
        }

        // Variación según la edición (las primeras ediciones suelen tener menos stock)
        $editionMultiplier = $editionNumber == 1 ? 0.8 : 1.2;

        // Variación aleatoria (±30%)
        $variation = rand(70, 130) / 100;

        return max(10, round($baseStock * $editionMultiplier * $variation));
    }

    private function getRealisticThreshold($bookTitle): int
    {
        // Umbral de reabastecimiento (cuándo pedir más libros)
        $baseThreshold = 10;

        // Libros muy populares tienen umbral más alto
        $veryPopular = [
            'Harry Potter y la piedra filosofal',
            'Harry Potter y la cámara secreta',
            'El código Da Vinci',
            'Sapiens: De animales a dioses',
            'Padre Rico, Padre Pobre'
        ];

        if (in_array($bookTitle, $veryPopular)) {
            $baseThreshold = 25;
        }

        // Libros populares
        $popular = [
            'Cien años de soledad',
            'El señor de los anillos: La comunidad del anillo',
            'Cómo ganar amigos e influir sobre las personas',
            '1984',
            'El principito',
            'Don Quijote de la Mancha'
        ];

        if (in_array($bookTitle, $popular)) {
            $baseThreshold = 15;
        }

        return $baseThreshold;
    }

    private function getAppropriateEditorial($bookTitle, $editorials)
    {
        // Mapeo de libros a editoriales específicas
        $editorialMapping = [
            'Cien años de soledad' => 'Alfaguara',
            'El amor en los tiempos del cólera' => 'Alfaguara',
            'La casa de los espíritus' => 'Plaza & Janés',
            'Harry Potter y la piedra filosofal' => 'Salamandra',
            'Harry Potter y la cámara secreta' => 'Salamandra',
            'El señor de los anillos: La comunidad del anillo' => 'Minotauro',
            'El código Da Vinci' => 'Planeta',
            'El alquimista' => 'Planeta',
            'Sapiens: De animales a dioses' => 'Debate',
            'Homo Deus: Breve historia del mañana' => 'Debate',
            'Padre Rico, Padre Pobre' => 'Aguilar',
            'Cómo ganar amigos e influir sobre las personas' => 'Elipse',
            'Piense y hágase rico' => 'Obelisco',
            '1984' => 'Debolsillo',
            'Un mundo feliz' => 'Debolsillo',
            'El principito' => 'Salamandra',
            'El retrato de Dorian Gray' => 'Alianza',
            'Crimen y castigo' => 'Alianza',
            'Los miserables' => 'Alianza',
            'Don Quijote de la Mancha' => 'Real Academia Española',
            'Rayuela' => 'Alfaguara',
            'Ficciones' => 'Alianza',
            'Veinte poemas de amor y una canción desesperada' => 'Cátedra',
            'Como agua para chocolate' => 'Planeta'
        ];

        $preferredEditorial = $editorialMapping[$bookTitle] ?? null;

        if ($preferredEditorial) {
            $editorial = $editorials->where('nombre', $preferredEditorial)->first();
            if ($editorial) {
                return $editorial;
            }
        }

        // Si no encontramos la editorial específica, usar una aleatoria
        return $editorials->random();
    }

    private function getEditionNumber($editionNumber): string
    {
        $suffixes = [
            1 => '1ra edición',
            2 => '2da edición',
            3 => '3ra edición',
            4 => '4ta edición',
            5 => '5ta edición'
        ];

        return $suffixes[$editionNumber] ?? $editionNumber . 'ta edición';
    }

    private function getRealisticPrice($bookTitle, $editionNumber): float
    {
        // Precio base según el tipo de libro
        $basePrice = 25.0;

        // Libros de desarrollo personal y negocios suelen ser más caros
        $businessBooks = [
            'Padre Rico, Padre Pobre',
            'Cómo ganar amigos e influir sobre las personas',
            'Piense y hágase rico',
            'El arte de la guerra',
            'Sapiens: De animales a dioses',
            'Homo Deus: Breve historia del mañana'
        ];

        if (in_array($bookTitle, $businessBooks)) {
            $basePrice = 35.0;
        }

        // Libros infantiles/juveniles suelen ser más baratos
        $childrenBooks = [
            'Harry Potter y la piedra filosofal',
            'Harry Potter y la cámara secreta',
            'El principito'
        ];

        if (in_array($bookTitle, $childrenBooks)) {
            $basePrice = 20.0;
        }

        // Libros clásicos pueden variar
        $classicBooks = [
            'Don Quijote de la Mancha',
            'Crimen y castigo',
            'Los miserables',
            '1984',
            'Un mundo feliz'
        ];

        if (in_array($bookTitle, $classicBooks)) {
            $basePrice = 30.0;
        }

        // Variación según la edición (las primeras ediciones suelen ser más caras)
        $editionMultiplier = $editionNumber == 1 ? 1.1 : 0.95;

        // Variación aleatoria (±15%)
        $variation = rand(85, 115) / 100;

        return round($basePrice * $editionMultiplier * $variation, 2);
    }
}
