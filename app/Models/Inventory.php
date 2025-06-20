<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['cantidad', 'umbral'];

    public function edition() {
        return $this->belongsTo(Edition::class);
    }
}
