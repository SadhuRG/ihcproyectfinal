<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'payment_type_id',
        'shipment_type_id',
        'fecha_orden',
        'estado',
        'total',
    ];

    /**
     * Relación uno a muchos (inversa): Una orden pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación uno a muchos (inversa): La orden tiene una dirección de envío.
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Relación uno a muchos (inversa): La orden tiene un tipo de envío.
     */
    public function shipmentType()
    {
        return $this->belongsTo(ShipmentType::class);
    }

    /**
     * Relación uno a muchos (inversa): La orden tiene un tipo de pago.
     */
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    /**
     * Relación muchos a muchos: La orden contiene muchas ediciones de libros.
     */
    public function editions()
    {
        return $this->belongsToMany(Edition::class, 'edition_order')
                    ->withPivot('cantidad');
    }
}
