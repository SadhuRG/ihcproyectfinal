<?php

namespace App\Livewire\Books;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryBooks extends Component
{
    use WithPagination;

    public $categoria;
    public $orderBy = 'titulo';
    public $orderDirection = 'asc';
    public $perPage = 12;

    protected $paginationTheme = 'tailwind';

    public function mount($categoria)
    {
        $this->categoria = $categoria;
    }

    public function sortBy($field)
    {
        if ($this->orderBy === $field) {
            $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderBy = $field;
            $this->orderDirection = 'asc';
        }

        $this->resetPage();
    }

    public function render()
    {
        // Buscar la categoría
        $category = Category::where('nombre', $this->categoria)->first();

        if (!$category) {
            // Si no existe la categoría, mostrar mensaje
            return view('livewire.books.category-books', [
                'books' => collect(),
                'category' => null,
                'totalBooks' => 0
            ]);
        }

        // Obtener libros de la categoría con paginación
        $books = $category->books()
            ->with(['authors', 'editions.editorial', 'editions.inventory'])
            ->orderBy($this->orderBy, $this->orderDirection)
            ->paginate($this->perPage);

        return view('livewire.books.category-books', [
            'books' => $books,
            'category' => $category,
            'totalBooks' => $category->books()->count()
        ]);
    }
}
