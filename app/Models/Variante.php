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

        public function oferta()
    {
        return $this->hasOne(Oferta::class);
    }

    // Calcula el precio con descuento si hay oferta
    public function getPrecioConDescuentoAttribute()
    {
        if ($this->oferta && $this->oferta->descuento > 0) {
            return $this->precio - ($this->precio * $this->oferta->descuento / 100);
        }
        return $this->precio;
    }

    public function variantes() {
    return $this->hasMany(Variante::class);
}

}
