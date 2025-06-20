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
        'apellido',      // ← NUEVO
        'url_foto',      // ← NUEVO
        'fecha_n',       // ← NUEVO (fecha nacimiento)
        'telefono',      // ← NUEVO
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
            'fecha_n' => 'date',    // ← NUEVO
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

    // ========== ACCESSORS PARA COMPATIBILIDAD CON VISTA ACTUAL ==========

    /**
     * Accessor para fecha_registro (compatibilidad con vista actual)
     */
    public function getFechaRegistroAttribute()
    {
        return $this->created_at ? $this->created_at->format('Y-m-d') : null;
    }

    /**
     * Accessor para fecha_nacimiento (compatibilidad con vista actual)
     */
    public function getFechaNacimientoAttribute()
    {
        return $this->fecha_n ? $this->fecha_n->format('Y-m-d') : null;
    }

    /**
     * Accessor para obtener el rol principal del usuario
     */
    public function getRolAttribute()
    {
        return $this->roles->first()?->name ?? 'usuario';
    }

    // ========== RELACIONES ==========

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
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * Relación muchos a muchos: Los libros que el usuario ha marcado como favoritos.
     */
    public function favoriteBooks()
    {
        return $this->belongsToMany(Book::class, 'book_user_favorite', 'user_id', 'book_id');
    }

    /**
     * Relación muchos a muchos: Los libros que el usuario ha comentado/valorado.
     */
    public function commentedBooks()
    {
        return $this->belongsToMany(Book::class, 'book_user_coment', 'user_id', 'book_id')
                    ->withPivot(['puntuacion', 'comentario', 'fecha_valoracion']);
    }

    // ========== SCOPES ÚTILES ==========

    /**
     * Scope para obtener usuarios por rol
     */
    public function scopeByRole($query, $roleName)
    {
        return $query->whereHas('roles', function ($q) use ($roleName) {
            $q->where('name', $roleName);
        });
    }

    /**
     * Scope para usuarios activos (que tienen orders)
     */
    public function scopeActive($query)
    {
        return $query->whereHas('orders');
    }

    /**
     * Scope para búsqueda general
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('apellido', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%')
              ->orWhereHas('roles', function ($roleQuery) use ($search) {
                  $roleQuery->where('name', 'like', '%' . $search . '%');
              });
        });
    }

    // ========== MÉTODOS ÚTILES ==========

    /**
     * Verificar si el usuario tiene pedidos
     */
    public function hasOrders()
    {
        return $this->orders()->exists();
    }

    /**
     * Obtener el total gastado por el usuario
     */
    public function getTotalGastadoAttribute()
    {
        return $this->orders()->where('estado', 1)->sum('total');
    }

    /**
     * Obtener la cantidad de libros favoritos
     */
    public function getFavoriteBooksCountAttribute()
    {
        return $this->favoriteBooks()->count();
    }

    /**
     * Verificar si un libro está en favoritos
     */
    public function hasFavoriteBook($bookId)
    {
        return $this->favoriteBooks()->where('book_id', $bookId)->exists();
    }

    /**
     * Obtener la última orden del usuario
     */
    public function getLastOrder()
    {
        return $this->orders()->latest('fecha_orden')->first();
    }

    /**
     * Verificar si el usuario ha comentado un libro específico
     */
    public function hasCommentedBook($bookId)
    {
        return $this->commentedBooks()->where('book_id', $bookId)->exists();
    }
}
