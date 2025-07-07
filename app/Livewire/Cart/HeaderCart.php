<?php

namespace App\Livewire\Cart;

use Livewire\Component;

class HeaderCart extends Component
{
    public $cartCount = 0;
    public $cartTotal = 0;
    public $cartItems = [];

    // Escuchar múltiples eventos para asegurar actualización
    protected $listeners = ['cartUpdated' => 'refreshCart'];

    public function mount()
    {
        $this->refreshCart();
        logger("HeaderCart mounted. Cart count: " . $this->cartCount);
    }

    public function refreshCart()
    {
        $cart = session()->get('cart', []);
        $this->cartItems = $cart;
        $this->cartCount = array_sum(array_column($cart, 'quantity'));

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $this->cartTotal = $total;

        logger("Cart refreshed. Count: " . $this->cartCount . ", Items: " . count($this->cartItems));

        // Forzar actualización del DOM
        $this->dispatch('cart-count-updated', ['count' => $this->cartCount]);
    }

    public function removeItem($cartKey)
    {
        // Debug - ver qué llega
        logger("Intentando eliminar: " . $cartKey);

        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
            session()->put('cart', $cart);

            logger("Producto eliminado. Carrito restante: " . count($cart));

            $this->refreshCart();

            // Mensaje de éxito
            $this->dispatch('showMessage', 'Producto eliminado del carrito');
        } else {
            logger("Key no encontrada: " . $cartKey . ". Keys disponibles: " . implode(', ', array_keys($cart)));
            $this->dispatch('showMessage', 'Error al eliminar producto');
        }
    }

    public function updateQuantity($cartKey, $quantity)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            if ($quantity <= 0) {
                unset($cart[$cartKey]);
            } else {
                $cart[$cartKey]['quantity'] = $quantity;
            }
            session()->put('cart', $cart);
        }

        $this->refreshCart();
    }

    // Método simple para testing
    public function testRemove()
    {
        logger("Test remove button clicked!");
        $this->dispatch('showMessage', 'Botón clickeado correctamente');
    }

    public function render()
    {
        return view('livewire.cart.header-cart');
    }
}
