<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ProfilePedidoDetalles extends Component
{
    public $order;
    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->loadOrder();
    }

    public function loadOrder()
    {
        $this->order = Auth::user()->orders()
            ->with([
                'editions.book.authors',
                'editions.editorial',
                'address',
                'paymentType',
                'shipmentType'
            ])
            ->find($this->orderId);

        // Si no se encuentra el pedido o no pertenece al usuario, redirigir
        if (!$this->order) {
            session()->flash('error', 'Pedido no encontrado.');
            return redirect()->route('profile.pedidos');
        }
    }

    public function addToCart($editionId, $quantity = 1)
    {
        try {
            $edition = $this->order->editions()->find($editionId);

            if (!$edition) {
                session()->flash('error', 'Producto no encontrado.');
                return;
            }

            // Lógica básica del carrito (ajusta según tu implementación)
            $cart = session()->get('cart', []);
            $cartKey = 'edition_' . $edition->id;

            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] += $quantity;
            } else {
                $cart[$cartKey] = [
                    'edition_id' => $edition->id,
                    'book_title' => $edition->book->titulo,
                    'authors' => $edition->book->authors->pluck('nombre')->join(', '),
                    'price' => $edition->precio_promocional ?? $edition->precio,
                    'cover' => $edition->url_portada,
                    'quantity' => $quantity
                ];
            }

            session()->put('cart', $cart);
            session()->flash('cart_success', "'{$edition->book->titulo}' agregado al carrito correctamente");

            $this->dispatch('product-added-to-cart');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al agregar al carrito: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.profile-pedido-detalles');
    }
}
