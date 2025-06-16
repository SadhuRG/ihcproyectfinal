<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla si no sigue la convención de Laravel
    protected $table = 'book_user_coment';

    protected $fillable = [
        'user_id',
        'book_id',
        'puntuacion',
        'comentario',
        'fecha_valoracion',
    ];

    /**
     * Relación uno a muchos (inversa): Un comentario pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación uno a muchos (inversa): Un comentario pertenece a un libro.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
