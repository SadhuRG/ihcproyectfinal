<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    /**
     * Relación uno a muchos: Una editorial tiene muchas ediciones.
     */
    public function editions()
    {
        return $this->hasMany(Edition::class, 'editorial_id');
    }
}
