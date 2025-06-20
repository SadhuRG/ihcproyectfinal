<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre', 'estado'];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
