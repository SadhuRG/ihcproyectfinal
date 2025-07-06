<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ProfilePedidos extends Component
{
    use WithPagination;

    public $selectedStatus = 'all'; // all, pending, completed
    public $searchTerm = '';

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        // Lógica inicial si es necesaria
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatedSelectedStatus()
    {
        $this->resetPage();
    }

    public function filterByStatus($status)
    {
        $this->selectedStatus = $status;
        $this->resetPage();
    }

    public function addToCart($editionId, $quantity = 1)
    {
        // Lógica para agregar al carrito
        // Aquí implementarías la lógica según tu sistema de carrito

        session()->flash('cart_success', 'Producto agregado al carrito correctamente');

        // Opcional: podrías emitir un evento para actualizar el contador del carrito
        $this->dispatch('product-added-to-cart');
    }

    public function getOrdersProperty()
    {
        $query = Auth::user()->orders()
            ->with(['editions.book.authors', 'editions.editorial', 'address'])
            ->latest('fecha_orden');

        // Filtrar por estado si es necesario
        if ($this->selectedStatus === 'pending') {
            $query->where('estado', false);
        } elseif ($this->selectedStatus === 'completed') {
            $query->where('estado', true);
        }

        // Filtrar por término de búsqueda si es necesario
        if ($this->searchTerm) {
            $query->whereHas('editions.book', function ($q) {
                $q->where('titulo', 'like', '%' . $this->searchTerm . '%');
            });
        }

        return $query->paginate(5);
    }

    public function render()
    {
        return view('livewire.profile-pedidos', [
            'orders' => $this->orders
        ]);
    }
}
