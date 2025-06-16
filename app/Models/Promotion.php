<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo',
        'modalidad_promocion',
        'cantidad',
    ];

    /**
     * Relación muchos a muchos: Una promoción puede aplicar a muchas categorías.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Relación muchos a muchos: Una promoción puede aplicar a muchas ediciones.
     */
    public function editions()
    {
        return $this->belongsToMany(Edition::class);
    }
}
