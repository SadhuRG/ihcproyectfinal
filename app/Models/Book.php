<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'editorial_id',
        'title',
        'publication_year',
        'description',
        'price',
        'isbn',
        'image_path',
    ];

    /**
     * Relación uno a muchos (inversa): Un libro pertenece a una editorial.
     */
    public function editorial()
    {
        return $this->belongsTo(Editorial::class);
    }

    /**
     * Relación muchos a muchos: Un libro puede tener muchas ediciones.
     */
    public function editions()
    {
        return $this->hasMany(Edition::class);
    }

    /**
     * Relación muchos a muchos: Un libro puede tener muchos autores.
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * Relación muchos a muchos: Un libro puede estar en muchas categorías.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Relación uno a muchos: Un libro puede tener muchos comentarios.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relación muchos a muchos: Los usuarios que han marcado este libro como favorito.
     */
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'book_user_favorite');
    }
}
