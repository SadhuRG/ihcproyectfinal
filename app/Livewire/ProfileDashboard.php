<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfileDashboard extends Component
{
    // Datos del usuario
    public $user;
    public $userStats;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadUserData();
    }

    public function loadUserData()
    {
        $user = $this->user;

        $this->userStats = [
            'ordersCount' => $user->orders()->count(),
            'favoriteBooksCount' => $user->favoriteBooks()->count(),
            'commentsCount' => $user->comments()->count(),
            'addressesCount' => $user->addresses()->count(),
            'lastOrder' => $user->orders()->latest('fecha_orden')->first(),
            'primaryAddress' => $user->addresses()->first(),
            'recentOrders' => $user->orders()->with(['editions.book.authors'])->latest('fecha_orden')->take(3)->get(),
            'favoriteBooks' => $user->favoriteBooks()->with(['authors', 'editions'])->take(4)->get(),
        ];
    }

    public function render()
    {
        return view('livewire.profile-dashboard');
    }
}
