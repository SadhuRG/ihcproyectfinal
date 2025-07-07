<?php

namespace App\Livewire\Books;

use Livewire\Component;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class NewReleases extends Component
{
    public $books;

    public function mount()
    {
        // Versión corregida con GROUP BY apropiado
        $this->books = Book::with(['authors', 'categories', 'editions' => function($query) {
                $query->whereNull('deleted_at')
                      ->orderBy('precio')
                      ->with(['editorial', 'inventory']);
            }])
            ->select([
                'books.id',
                'books.titulo',
                'books.descripcion',
                'books.ISBN',
                DB::raw('MIN(editions.precio) as precio_minimo')
            ])
            ->join('editions', 'books.id', '=', 'editions.book_id')
            ->whereNull('editions.deleted_at')
            ->groupBy('books.id', 'books.titulo', 'books.descripcion', 'books.ISBN')
            ->orderBy('books.id', 'desc')
            ->take(6)
            ->get()
            ->map(function ($book) {
                // Agregar edición más barata para mostrar carátula
                $book->cheapest_edition = $book->editions->sortBy('precio')->first();
                return $book;
            });
    }

    public function render()
    {
        return view('livewire.books.new-releases');
    }
}
