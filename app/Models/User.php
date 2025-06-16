<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * Relación uno a muchos: Un usuario puede tener muchas direcciones.
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Relación uno a muchos: Un usuario puede tener muchas órdenes.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relación uno a muchos: Un usuario puede escribir muchos comentarios.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relación muchos a muchos: Los libros que el usuario ha marcado como favoritos.
     */
    public function favoriteBooks()
    {
        return $this->belongsToMany(Book::class, 'book_user_favorite');
    }
}
