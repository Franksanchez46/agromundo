<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'descripcion_breve',
        'imagen',
        'descuento',
        'alt',
        'variante_id',
    ];

    public function oferta()
{
    return $this->hasOne(Oferta::class);   // oferta.variante_id → variante.id
}

      public function variante()
    {
        return $this->belongsTo(Variante::class);
    }
}
