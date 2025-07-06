<?php

namespace App\Livewire\Books;

use Livewire\Component;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class FictionBooks extends Component
{
    public $books;

    public function mount()
    {
        // Versión mejorada con ediciones cargadas
        $this->books = Book::with(['authors', 'categories', 'editions' => function($query) {
                $query->whereNull('deleted_at')
                      ->orderBy('precio')
                      ->with(['editorial', 'inventory']);
            }])
            ->select([
                'books.*',
                DB::raw('MIN(editions.precio) as precio_minimo')
            ])
            ->join('editions', 'books.id', '=', 'editions.book_id')
            ->whereHas('categories', function ($query) {
                $query->where('nombre', 'Ciencia Ficción');
            })
            ->whereNull('books.deleted_at')
            ->whereNull('editions.deleted_at')
            ->groupBy('books.id')
            ->orderBy('books.created_at', 'desc')
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
        return view('livewire.books.fiction-books');
    }
}
