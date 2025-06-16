<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relación uno a muchos: Una editorial tiene muchos libros.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
