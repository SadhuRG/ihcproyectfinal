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

    protected $casts = [
        'fecha_orden' => 'date',
        'estado' => 'boolean',
        'total' => 'decimal:2',
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
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    /**
     * Scope para filtrar por estado
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('estado', $status);
    }

    /**
     * Scope para filtrar por fecha
     */
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    /**
     * Scope para filtrar por usuario
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Obtener el estado como texto
     */
    public function getEstadoTextAttribute()
    {
        return $this->estado ? 'Completado' : 'Pendiente';
    }

    /**
     * Obtener el total formateado
     */
    public function getTotalFormateadoAttribute()
    {
        return '$' . number_format($this->total, 2);
    }
}
