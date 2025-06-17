<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    use HasFactory;

    protected $fillable = [
        'editorial_id',
        'inventorie_id',
        'book_id',
        'url_portada',
        'numero_edicion',
        'url_pdf',
        'precio',
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
    public function editorial()
    {
        return $this->belongsTo(Editorial::class, 'editorial_id');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventorie_id');
    }

    /**
     * Relación muchos a muchos: Una edición puede estar en muchas órdenes.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'edition_order')
                    ->withPivot('cantidad');
    }

    /**
     * Relación muchos a muchos: Una edición puede tener muchas promociones.
     */
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }
}
