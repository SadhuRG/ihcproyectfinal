<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'cantidad',
    ];

    /**
     * Relación muchos a muchos: Una promoción puede aplicar a muchos libros.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class)
                    ->whereNull('books.deleted_at');
    }
}
