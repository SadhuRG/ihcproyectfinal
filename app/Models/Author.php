<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'biography',
    ];

    /**
     * Relación muchos a muchos: Un autor puede haber escrito muchos libros.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
