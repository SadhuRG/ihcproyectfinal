<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'format',
        'page_count',
    ];

    /**
     * Relación uno a muchos (inversa): Una edición pertenece a un libro.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Relación uno a uno: Cada edición tiene un registro de inventario.
     */
    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    /**
     * Relación muchos a muchos: Una edición puede estar en muchas órdenes.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Relación muchos a muchos: Una edición puede tener muchas promociones.
     */
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }
}
