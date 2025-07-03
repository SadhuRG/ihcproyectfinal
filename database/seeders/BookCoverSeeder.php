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
        
        $this->command->info('URLs de portadas generadas exitosamente para todos los libros.');
    }
    
    private function generateCoversForBook($book)
    {
        // Generar portadas para cada edición
        foreach ($book->editions as $edition) {
            $this->generateEditionCover($book, $edition);
        }
    }
    
    private function generateEditionCover($book, $edition)
    {
        // Generar URL de portada usando servicios online
        $coverUrl = $this->generateCoverUrl($book, $edition);
        
        // Actualizar la URL en la base de datos
        $edition->update([
            'url_portada' => $coverUrl
        ]);
    }
    
    private function generateCoverUrl($book, $edition)
    {
        // Usar Picsum Photos para generar imágenes placeholder únicas
        $imageId = $this->getImageId($book->id, $edition->id);
        $width = 400;
        $height = 600;
        
        // URL de Picsum Photos con parámetros para imagen de libro
        $url = "https://picsum.photos/id/{$imageId}/{$width}/{$height}";
        
        // Alternativa: usar Lorem Picsum con seed específico
        // $url = "https://picsum.photos/seed/{$book->id}_{$edition->id}/{$width}/{$height}";
        
        return $url;
    }
    
    private function getImageId($bookId, $editionId)
    {
        // Generar un ID único para cada combinación libro-edición
        // Usar números entre 1 y 1000 para Picsum Photos
        $uniqueId = ($bookId * 100 + $editionId) % 1000 + 1;
        return $uniqueId;
    }
} 