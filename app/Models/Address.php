<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'calle',
        'numero_piso',
        'numero_departamento',
        'distrito',
        'provincia',
        'departamento',
        'referencia',
    ];

    /**
     * Relación uno a muchos (inversa): Una dirección pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación uno a muchos: Una dirección puede ser usada en muchas órdenes.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
