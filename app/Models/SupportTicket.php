<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asunto',
        'mensaje_usuario',
        'mensaje_admin',
        'estado'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación con el usuario que creó el ticket
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Verificar si el usuario puede crear un nuevo ticket
     */
    public static function canUserCreateTicket($userId)
    {
        return !self::where('user_id', $userId)
                    ->whereIn('estado', ['enviado', 'recibido'])
                    ->exists();
    }

    /**
     * Obtener el ticket activo del usuario (si existe)
     */
    public static function getActiveTicket($userId)
    {
        return self::where('user_id', $userId)
                   ->whereIn('estado', ['enviado', 'recibido'])
                   ->first();
    }

    /**
     * Contar palabras en un texto
     */
    public static function countWords($text)
    {
        return str_word_count(strip_tags($text));
    }

    /**
     * Verificar si un texto excede el límite de palabras
     */
    public static function exceedsWordLimit($text, $limit = 500)
    {
        return self::countWords($text) > $limit;
    }
}
