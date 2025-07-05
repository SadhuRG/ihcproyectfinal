<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
    ];

    /**
     * Relación muchos a muchos: Un autor puede haber escrito muchos libros.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'author_book', 'author_id', 'book_id')
                    ->whereNull('books.deleted_at');
    }
}
