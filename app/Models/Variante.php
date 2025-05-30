<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variante extends Model
{
        use HasFactory;

    protected $fillable = [
        'producto_id',
        'tamaño',
        'precio',
        'stock',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
