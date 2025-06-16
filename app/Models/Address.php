<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
        'country',
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
