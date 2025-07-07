<?php

namespace App\Livewire\Books;

use Livewire\Component;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BestSellers extends Component
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
                DB::raw('MIN(editions.precio) as precio_minimo'),
                DB::raw('SUM(edition_order.cantidad) as total_vendido')
            ])
            ->join('editions', 'books.id', '=', 'editions.book_id')
            ->join('edition_order', 'editions.id', '=', 'edition_order.edition_id')
            ->join('orders', 'edition_order.order_id', '=', 'orders.id')
            ->where('orders.estado', true)
            ->whereNull('books.deleted_at')
            ->whereNull('editions.deleted_at')
            ->groupBy('books.id')
            ->orderByDesc('total_vendido')
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
        return view('livewire.books.best-sellers');
    }
}
