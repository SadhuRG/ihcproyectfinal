<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ProfileDeseos extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $quantities = []; // Array para almacenar cantidades por libro

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        // Inicializar cantidades en 1 para todos los libros favoritos
        $favoriteBooks = Auth::user()->favoriteBooks()->get();
        foreach ($favoriteBooks as $book) {
            $this->quantities[$book->id] = 1;
        }
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updateQuantity($bookId, $quantity)
    {
        $this->quantities[$bookId] = max(1, intval($quantity));
    }

    public function addToCart($bookId)
    {
        try {
            $book = Auth::user()->favoriteBooks()->with('editions')->find($bookId);

            if (!$book) {
                session()->flash('error', 'Libro no encontrado en tu lista de deseos.');
                return;
            }

            // Obtener la primera edición disponible del libro
            $edition = $book->editions()->first();

            if (!$edition) {
                session()->flash('error', 'No hay ediciones disponibles para este libro.');
                return;
            }

            $quantity = $this->quantities[$bookId] ?? 1;

            // Aquí implementarías la lógica de tu carrito
            // Por ejemplo, guardar en sesión, base de datos, etc.

            // Ejemplo básico con sesión:
            $cart = session()->get('cart', []);
            $cartKey = 'edition_' . $edition->id;

            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] += $quantity;
            } else {
                $cart[$cartKey] = [
                    'edition_id' => $edition->id,
                    'book_title' => $book->titulo,
                    'authors' => $book->authors->pluck('nombre')->join(', '),
                    'price' => $edition->precio_promocional ?? $edition->precio,
                    'cover' => $edition->url_portada,
                    'quantity' => $quantity
                ];
            }

            session()->put('cart', $cart);

            session()->flash('cart_success', "'{$book->titulo}' agregado al carrito correctamente (x{$quantity})");

            // Opcional: emitir evento para actualizar contador del carrito
            $this->dispatch('product-added-to-cart');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al agregar al carrito: ' . $e->getMessage());
        }
    }

    public function removeFromWishlist($bookId)
    {
        try {
            $user = Auth::user();
            $book = $user->favoriteBooks()->find($bookId);

            if ($book) {
                $user->favoriteBooks()->detach($bookId);
                unset($this->quantities[$bookId]);

                session()->flash('wishlist_success', "'{$book->titulo}' eliminado de tu lista de deseos.");

                // Recargar la página para actualizar la lista
                $this->resetPage();
            }

        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar de la lista de deseos: ' . $e->getMessage());
        }
    }

    public function getFavoriteBooksProperty()
    {
        $query = Auth::user()->favoriteBooks()
            ->with(['authors', 'editions' => function($q) {
                $q->whereNull('deleted_at')->orderBy('created_at', 'desc');
            }])
            ->whereNull('books.deleted_at');

        // Filtrar por término de búsqueda si es necesario
        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('titulo', 'like', '%' . $this->searchTerm . '%')
                  ->orWhereHas('authors', function($authorQuery) {
                      $authorQuery->where('nombre', 'like', '%' . $this->searchTerm . '%')
                               ->orWhere('apellido', 'like', '%' . $this->searchTerm . '%');
                  });
            });
        }

        return $query->paginate(8);
    }

    public function render()
    {
        return view('livewire.profile-deseos', [
            'favoriteBooks' => $this->favoriteBooks
        ]);
    }
}
