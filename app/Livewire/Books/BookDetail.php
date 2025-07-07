<?php

namespace App\Livewire\Books;

use Livewire\Component;
use App\Models\Book;
use App\Models\Edition;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class BookDetail extends Component
{
    public Book $book;
    public $selectedEdition;
    public $quantity = 1;
    public $activeTab = 'description';

    // Para comentarios
    public $newComment = '';
    public $newRating = 0;
    public $hasUserCommented = false;

    // Para favoritos y lista de deseos
    public $isFavorite = false;
    public $isInWishlist = false;

    protected $rules = [
        'newComment' => 'required|string|min:10|max:1000',
        'newRating' => 'required|integer|min:1|max:5',
    ];

    protected $messages = [
        'newComment.required' => 'El comentario es obligatorio.',
        'newComment.min' => 'El comentario debe tener al menos 10 caracteres.',
        'newComment.max' => 'El comentario no puede exceder 1000 caracteres.',
        'newRating.required' => 'La calificación es obligatoria.',
        'newRating.min' => 'La calificación mínima es 1 estrella.',
        'newRating.max' => 'La calificación máxima es 5 estrellas.',
    ];

    public function mount($bookId)
    {
        $this->book = Book::with(['authors', 'categories', 'editions.editorial', 'editions.inventory', 'comments.user'])
                          ->findOrFail($bookId);

        // Seleccionar la primera edición disponible por defecto
        $this->selectedEdition = $this->book->editions->first();

        if (Auth::check()) {
            $this->checkUserInteractions();
        }
    }

    public function checkUserInteractions()
    {
        $userId = Auth::id();

        // Verificar si el usuario ya comentó este libro
        $this->hasUserCommented = Comment::where('user_id', $userId)
                                         ->where('book_id', $this->book->id)
                                         ->exists();

        // Verificar si está en favoritos
        $this->isFavorite = $this->book->favoriteUsers()->where('user_id', $userId)->exists();

        // Verificar si está en lista de deseos (puedes implementar esta funcionalidad)
        // $this->isInWishlist = ...;
    }

    public function selectEdition($editionId)
    {
        $this->selectedEdition = $this->book->editions->find($editionId);
        $this->quantity = 1; // Reset quantity when changing edition
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para agregar productos al carrito.');
            return redirect()->route('login');
        }

        if (!$this->selectedEdition) {
            session()->flash('error', 'Por favor selecciona una edición.');
            return;
        }

        // Usar el componente ShoppingCart para agregar el item
        $this->dispatch('addToCart', [
            'editionId' => $this->selectedEdition->id,
            'quantity' => $this->quantity
        ]);
    }

    public function isBookInCart()
    {
        if (!$this->selectedEdition) return false;

        $cart = session()->get('cart', []);
        $itemKey = "edition_" . $this->selectedEdition->id;
        return isset($cart[$itemKey]);
    }

    public function toggleFavorite()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para agregar a favoritos.');
            return;
        }

        $userId = Auth::id();

        if ($this->isFavorite) {
            $this->book->favoriteUsers()->detach($userId);
            $this->isFavorite = false;
            session()->flash('success', 'Libro removido de favoritos.');
        } else {
            $this->book->favoriteUsers()->attach($userId);
            $this->isFavorite = true;
            session()->flash('success', 'Libro agregado a favoritos.');
        }
    }

    public function toggleWishlist()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para agregar a lista de deseos.');
            return;
        }

        // Implementar lógica de lista de deseos
        // Similar a favoritos pero con otra tabla
        $this->isInWishlist = !$this->isInWishlist;

        if ($this->isInWishlist) {
            session()->flash('success', 'Libro agregado a lista de deseos.');
        } else {
            session()->flash('success', 'Libro removido de lista de deseos.');
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function submitComment()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para comentar.');
            return;
        }

        $this->validate();

        Comment::create([
            'user_id' => Auth::id(),
            'book_id' => $this->book->id,
            'puntuacion' => $this->newRating,
            'comentario' => $this->newComment,
            'fecha_valoracion' => now(),
        ]);

        $this->newComment = '';
        $this->newRating = 0;
        $this->hasUserCommented = true;

        // Recargar comentarios
        $this->book->refresh();

        session()->flash('success', '¡Gracias por tu reseña! Ha sido publicada correctamente.');
    }

    // Computed properties para estadísticas
    public function getAverageRatingProperty()
    {
        return $this->book->comments->avg('puntuacion') ?? 0;
    }

    public function getTotalCommentsProperty()
    {
        return $this->book->comments->count();
    }

    public function getDiscountPercentageProperty()
    {
        if (!$this->selectedEdition || !$this->selectedEdition->precio_promocional) {
            return 0;
        }

        $original = $this->selectedEdition->precio;
        $promotional = $this->selectedEdition->precio_promocional;

        return round((($original - $promotional) / $original) * 100);
    }

    public function render()
    {
        return view('livewire.books.book-detail');
    }
}
