<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'ISBN',
        'descripcion',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book', 'book_id', 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'book_user_favorite', 'book_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'book_id', 'id');
    }

    public function editions() {
        return $this->hasMany(Edition::class, 'book_id');
    }

    public function commentedUsers() {
        return $this->belongsToMany(User::class, 'book_user_coment', 'book_id', 'user_id')
            ->withPivot(['puntuacion', 'comentario', 'fecha_valoracion']);
    }
}
