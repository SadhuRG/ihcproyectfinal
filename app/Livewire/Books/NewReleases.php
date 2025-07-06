<?php

namespace App\Livewire\Books;

use Livewire\Component;
use App\Models\Book;
use App\Models\Edition;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class NewReleases extends Component
{
    public $books;

    public function mount()
    {
        $this->books = Book::select('books.*', DB::raw('MIN(editions.precio) as precio_minimo'))
            ->join('editions', 'books.id', '=', 'editions.book_id')
            ->groupBy('books.id')
            ->orderBy('books.created_at', 'desc')
            ->take(6)
            ->get();
    }

    public function render()
    {
        return view('livewire.books.new-releases');
    }
}
