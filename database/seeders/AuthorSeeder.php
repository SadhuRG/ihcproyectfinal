<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Carbon\Carbon;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['nombre' => 'Gabriel', 'apellido' => 'García Márquez'],
            ['nombre' => 'Mario', 'apellido' => 'Vargas Llosa'],
            ['nombre' => 'Isabel', 'apellido' => 'Allende'],
            ['nombre' => 'Pablo', 'apellido' => 'Neruda'],
            ['nombre' => 'Jorge Luis', 'apellido' => 'Borges'],
            ['nombre' => 'Julio', 'apellido' => 'Cortázar'],
            ['nombre' => 'Octavio', 'apellido' => 'Paz'],
            ['nombre' => 'Carlos', 'apellido' => 'Fuentes'],
            ['nombre' => 'Laura', 'apellido' => 'Esquivel'],
            ['nombre' => 'Elena', 'apellido' => 'Poniatowska'],
            ['nombre' => 'Roberto', 'apellido' => 'Bolaño'],
            ['nombre' => 'Alejandro', 'apellido' => 'Zambra'],
            ['nombre' => 'Claudia', 'apellido' => 'Piñeiro'],
            ['nombre' => 'Samanta', 'apellido' => 'Schweblin'],
            ['nombre' => 'Mariana', 'apellido' => 'Enríquez'],
            ['nombre' => 'J.K.', 'apellido' => 'Rowling'],
            ['nombre' => 'Stephen', 'apellido' => 'King'],
            ['nombre' => 'George R.R.', 'apellido' => 'Martin'],
            ['nombre' => 'Dan', 'apellido' => 'Brown'],
            ['nombre' => 'Paulo', 'apellido' => 'Coelho'],
            ['nombre' => 'Haruki', 'apellido' => 'Murakami'],
            ['nombre' => 'Yuval Noah', 'apellido' => 'Harari'],
            ['nombre' => 'Malcolm', 'apellido' => 'Gladwell'],
            ['nombre' => 'Simon', 'apellido' => 'Sinek'],
            ['nombre' => 'Brené', 'apellido' => 'Brown'],
            ['nombre' => 'Dale', 'apellido' => 'Carnegie'],
            ['nombre' => 'Napoleon', 'apellido' => 'Hill'],
            ['nombre' => 'Robert', 'apellido' => 'Kiyosaki'],
            ['nombre' => 'Tony', 'apellido' => 'Robbins'],
            ['nombre' => 'J.R.R.', 'apellido' => 'Tolkien'],
            ['nombre' => 'Susan', 'apellido' => 'Cain'],
            ['nombre' => 'Sun', 'apellido' => 'Tzu'],
            ['nombre' => 'George', 'apellido' => 'Orwell'],
            ['nombre' => 'Aldous', 'apellido' => 'Huxley'],
            ['nombre' => 'Antoine de', 'apellido' => 'Saint-Exupéry'],
            ['nombre' => 'Oscar', 'apellido' => 'Wilde'],
            ['nombre' => 'Fiódor', 'apellido' => 'Dostoyevski'],
            ['nombre' => 'Victor', 'apellido' => 'Hugo'],
            ['nombre' => 'Miguel de', 'apellido' => 'Cervantes'],
        ];

        // Fecha base para los autores (últimos 20 años)
        $baseDate = Carbon::now()->subYears(20);

        foreach ($authors as $index => $author) {
            // Cada autor se crea con un intervalo
            $authorDate = $baseDate->copy()->addDays($index * 15);
            
            Author::create([
                'nombre' => $author['nombre'],
                'apellido' => $author['apellido'],
                'created_at' => $authorDate,
                'updated_at' => $authorDate,
            ]);
        }
    }
}
