<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Edition extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'editorial_id',
        'inventorie_id',
        'book_id',
        'url_portada',
        'numero_edicion',
        'url_pdf',
        'precio',
        'precio_promocional',
    ];

    /**
     * Relación uno a muchos (inversa): Una edición pertenece a un libro.
     */
    public function book()
    {
        return $this->belongsTo(Book::class)->whereNull('books.deleted_at');
    }

    /**
     * Relación uno a uno: Cada edición tiene un registro de inventario.
     */
    public function editorial()
    {
        return $this->belongsTo(Editorial::class, 'editorial_id');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventorie_id');
    }

    /**
     * Relación muchos a muchos: Una edición puede estar en muchas órdenes.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'edition_order')
                    ->withPivot('cantidad');
    }

    /**
     * Obtiene la URL del icono de edición correspondiente
     */
    public function getEditionIconUrl($theme = 'dark')
    {
        $iconMapping = [
            '1ra edición' => '1ra edición.svg',
            '2da edición' => '2da edición.svg',
            '3ra edición' => '3ra edición.svg',
            '4ta edición' => '4ta edición.svg',
            '5ta edición' => '5ta edición.svg',
            '6ta edición' => '6ta edición.svg',
            '7ma edición' => '7ma edición.svg',
            '8va edición' => '8va edición.svg',
            '9na edición' => '9na edición.svg',
            '10ma edición' => '10ma edición.svg',
            'edición especial' => 'especial edición.svg'
        ];

        $iconName = $iconMapping[$this->numero_edicion] ?? '1ra edición.svg';
        $themeFolder = $theme === 'dark' ? 'dark' : 'ligth';
        
        return "/icons/edicion_libro/{$themeFolder}/{$iconName}";
    }

    /**
     * Verifica si la edición tiene carátula
     */
    public function hasCover()
    {
        return !empty($this->url_portada) && $this->url_portada !== '/images/covers/default.jpg';
    }
}
