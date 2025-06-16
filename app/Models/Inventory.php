<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = ['edition_id', 'stock'];

    public function edition() {
        return $this->belongsTo(Edition::class);
    }
}
