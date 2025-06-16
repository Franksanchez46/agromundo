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
        'url',
    ];
}
