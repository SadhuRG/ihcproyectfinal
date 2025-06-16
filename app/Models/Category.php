<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relación muchos a muchos: Una categoría puede contener muchos libros.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * Relación muchos a muchos: Una categoría puede tener muchas promociones.
     */
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }
}
