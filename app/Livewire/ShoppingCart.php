<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Edition;

class ShoppingCart extends Component
{
    public $showCart = false;
    public $cartItems = [];
    public $cartCount = 0;
    public $cartTotal = 0;

    protected $listeners = [
        'cartUpdated' => 'updateCart',
        'toggleCart' => 'toggleCart',
        'addToCart' => 'handleAddToCart'
    ];

    public function mount()
    {
        $this->showCart = false; // Asegurar que inicie cerrado
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = session()->get('cart', []);
        $this->validateCartItems();
        $this->calculateCartSummary();
    }

    public function validateCartItems()
    {
        $validCart = [];
        foreach ($this->cartItems as $key => $item) {
            // Verificar que el item tenga las claves necesarias
            if (isset($item['edition_id'], $item['book_title'], $item['price'], $item['quantity'])) {
                // Asegurar que todas las claves existan con valores por defecto
                $validCart[$key] = [
                    'edition_id' => $item['edition_id'],
                    'book_id' => $item['book_id'] ?? null,
                    'book_title' => $item['book_title'] ?? 'Libro sin título',
                    'edition_number' => $item['edition_number'] ?? $item['edition_name'] ?? '1ra edición',
                    'editorial' => $item['editorial'] ?? 'Editorial no especificada',
                    'price' => $item['price'] ?? 0,
                    'original_price' => $item['original_price'] ?? $item['price'] ?? 0,
                    'cover_url' => $item['cover_url'] ?? '/images/covers/default.jpg',
                    'quantity' => $item['quantity'] ?? 1,
                    'isbn' => $item['isbn'] ?? '',
                    'authors' => $item['authors'] ?? 'Autor desconocido'
                ];
            }
        }

        if (count($validCart) !== count($this->cartItems)) {
            session()->put('cart', $validCart);
            $this->cartItems = $validCart;
        }
    }

    public function calculateCartSummary()
    {
        $this->cartCount = 0;
        $this->cartTotal = 0;

        foreach ($this->cartItems as $item) {
            $quantity = $item['quantity'] ?? 0;
            $price = $item['price'] ?? 0;

            $this->cartCount += $quantity;
            $this->cartTotal += $price * $quantity;
        }
    }

    public function addItem($editionId, $quantity = 1)
    {
        $edition = Edition::with(['book', 'editorial', 'inventory'])->find($editionId);

        if (!$edition || !$edition->inventory || $edition->inventory->cantidad < $quantity) {
            session()->flash('error', 'No hay suficiente stock disponible');
            return;
        }

        $cart = session()->get('cart', []);

        // Usar la misma lógica de clave que ya tienes
        $itemKey = "edition_" . $editionId;

        if (isset($cart[$itemKey])) {
            $newQuantity = $cart[$itemKey]['quantity'] + $quantity;
            if ($newQuantity > $edition->inventory->cantidad) {
                session()->flash('error', 'No hay suficiente stock disponible');
                return;
            }
            $cart[$itemKey]['quantity'] = $newQuantity;
        } else {
            $cart[$itemKey] = [
                'edition_id' => $edition->id,
                'book_id' => $edition->book->id,
                'book_title' => $edition->book->titulo ?? 'Libro sin título',
                'edition_number' => $edition->numero_edicion ?? '1ra edición',
                'price' => $edition->precio_promocional ?? $edition->precio ?? 0,
                'original_price' => $edition->precio ?? 0,
                'quantity' => $quantity,
                'cover_url' => $edition->url_portada ?? '/images/covers/default.jpg',
                'editorial' => $edition->editorial->nombre ?? 'Editorial no especificada',
                'isbn' => $edition->book->ISBN ?? '',
                'authors' => $edition->book->authors->pluck('nombre')->implode(', ') ?? 'Autor desconocido'
            ];
        }

        session()->put('cart', $cart);
        $this->loadCart();

        // Abrir el carrito automáticamente
        $this->showCart = true;

        session()->flash('success', 'Producto agregado al carrito');
        $this->dispatch('cartUpdated');
    }

    public function updateQuantity($editionId, $quantity)
{
    $editionId = (int) $editionId;
    $quantity = (int) $quantity;

    $cart = session()->get('cart', []);
    $realKey = "edition_" . $editionId;

    if (!isset($cart[$realKey])) {
        session()->flash('error', 'Producto no encontrado en el carrito');
        return;
    }

    if ($quantity <= 0) {
        $this->removeItem($editionId);
        return;
    }

    // Verificar stock disponible
    $edition = Edition::with('inventory')->find($editionId);
    if (!$edition || $quantity > $edition->inventory->cantidad) {
        session()->flash('error', 'No hay suficiente stock disponible');
        return;
    }

    // Actualizar en sesión
    $cart[$realKey]['quantity'] = $quantity;
    session()->put('cart', $cart);

    // Actualizar SOLO el array local y los totales (SIN loadCart completo)
    $this->cartItems[$realKey]['quantity'] = $quantity;
    $this->calculateCartSummary();

    // Solo dispatch si es necesario
    $this->dispatch('cartUpdated');
}

    public function testRemove($editionId)
    {
        session()->flash('success', "🔥 MÉTODO EJECUTADO! ID: {$editionId}");
        $this->dispatch('cartUpdated');
    }

    public function removeItem($editionId)
    {
        $cart = session()->get('cart', []);
        $realKey = "edition_" . $editionId;

        if (isset($cart[$realKey])) {
            $bookTitle = $cart[$realKey]['book_title'] ?? 'Producto';
            unset($cart[$realKey]);
            session()->put('cart', $cart);
            $this->loadCart();
            $this->dispatch('cartUpdated');
            session()->flash('success', "'{$bookTitle}' eliminado del carrito");
        } else {
            session()->flash('error', 'Producto no encontrado en el carrito');
        }
    }

    public function clearCart()
    {
        session()->forget('cart');
        $this->loadCart();
        $this->dispatch('cartUpdated');
        session()->flash('success', 'Carrito vaciado correctamente');
    }

    public function resetCart()
    {
        // Método para resetear completamente el carrito en caso de errores
        session()->forget('cart');
        $this->cartItems = [];
        $this->cartCount = 0;
        $this->cartTotal = 0;
        $this->dispatch('cartUpdated');
    }

    public function toggleCart()
    {
        $this->showCart = !$this->showCart;
    }

    public function closeCart()
    {
        $this->showCart = false;
    }

    public function openCart()
    {
        $this->showCart = true;
    }

    public function handleAddToCart($data)
    {
        $this->addItem($data['editionId'], $data['quantity']);
    }

    public function updateCart()
    {
        $this->loadCart();
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
