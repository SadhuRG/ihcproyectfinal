<?php

namespace App\Livewire\Books;

use Livewire\Component;
use App\Models\Book;
use App\Models\Edition;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class BestSellers extends Component
{
    public $books;

    public function mount()
    {
        // Obtenemos los libros más vendidos sumando las cantidades por edición
        $this->books = Book::select('books.*', DB::raw('MIN(editions.precio) as precio_minimo'), DB::raw('SUM(edition_order.cantidad) as total_vendido'))
            ->join('editions', 'books.id', '=', 'editions.book_id')
            ->join('edition_order', 'editions.id', '=', 'edition_order.edition_id')
            ->join('orders', 'edition_order.order_id', '=', 'orders.id')
            ->where('orders.estado', true)
            ->groupBy('books.id')
            ->orderByDesc('total_vendido')
            ->take(6)
            ->get();
    }

    public function render()
    {
        return view('livewire.books.best-sellers');
    }
}
