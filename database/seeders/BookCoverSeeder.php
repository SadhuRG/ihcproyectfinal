<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Edition;

class BookCoverSeeder extends Seeder
{
    public function run(): void
    {
        $books = Book::with('editions')->get();
        
        foreach ($books as $book) {
            $this->generateCoversForBook($book);
        }
        
        $this->command->info('URLs de portadas asignadas exitosamente para todos los libros.');
    }
    
    private function generateCoversForBook($book)
    {
        // Obtener la carátula correspondiente al libro
        $coverUrl = $this->getBookCover($book->titulo);
        
        // Asignar la misma carátula a todas las ediciones del libro
        foreach ($book->editions as $edition) {
            $edition->update([
                'url_portada' => $coverUrl
            ]);
        }
    }
    
    private function getBookCover($bookTitle): string
    {
        // Mapeo de libros a sus carátulas correspondientes
        $coverMapping = [
            'Cien años de soledad' => '/portadas/Cien años de Soledad.jpg',
            'El amor en los tiempos del cólera' => '/portadas/El amor en los tiempos de colera.jpg',
            'La casa de los espíritus' => '/portadas/La casa de los espiritus.jpg',
            'Harry Potter y la piedra filosofal' => '/portadas/Harry Poter y la Piedra Filosofal.jpg',
            'Harry Potter y la cámara secreta' => '/portadas/Harry Poter y la camara secreta.jpg',
            'El señor de los anillos: La comunidad del anillo' => '/portadas/Señor de los anillos la comunidad del anillo.jpg',
            'El código Da Vinci' => '/portadas/El codigo davinci.jpg',
            'El alquimista' => '/portadas/El alquimista.jpg',
            'Sapiens: De animales a dioses' => '/portadas/Sapiens de animales a dioses.jpg',
            'Homo Deus: Breve historia del mañana' => '/portadas/Homo Deus breve historia del Mañana.jpg',
            'El poder de los introvertidos' => '/portadas/El poder de los introvertidos en un mundo incapas de callarse.jpg',
            'Padre Rico, Padre Pobre' => '/portadas/Padre rico padre pobre.jpg',
            'Cómo ganar amigos e influir sobre las personas' => '/portadas/Como ganar amigos e influir sobre las personas.jpg',
            'Piense y hágase rico' => '/portadas/Piense y hagase rico.jpg',
            'El arte de la guerra' => '/portadas/El arte de la guerra.jpg',
            '1984' => '/portadas/Libro 1984.jpg',
            'Un mundo feliz' => '/portadas/Un mundo feliz.jpg',
            'El principito' => '/portadas/El principito.jpg',
            'El retrato de Dorian Gray' => '/portadas/El retrato de Dorian Gray.jpg',
            'Crimen y castigo' => '/portadas/Crimen y castigo.jpg',
            'Los miserables' => '/portadas/Los miserables.jpg',
            'Don Quijote de la Mancha' => '/portadas/Don quijote de la mancha y Sancho Panza.jpg',
            'Rayuela' => '/portadas/Rayuela.jpg',
            'Ficciones' => '/portadas/Ficciones.jpg',
            'Veinte poemas de amor y una canción desesperada' => '/portadas/Veinte poemas de amor.jpg',
            'Como agua para chocolate' => '/portadas/Como agua para chocolate.jpg'
        ];

        return $coverMapping[$bookTitle] ?? '/portadas/Cien años de Soledad.jpg'; // Carátula por defecto
    }
} 