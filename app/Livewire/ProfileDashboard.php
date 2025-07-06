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
        ];
    }

    public function render()
    {
        return view('livewire.profile-dashboard');
    }
}
