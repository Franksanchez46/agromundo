<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{

    use HasFactory;
        protected $table = 'productos'; // <--- Esto garantiza que Laravel use la tabla correcta
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    public function variantes()
    {
        return $this->hasMany(Variante::class);
    }

        // Relación: un producto tiene muchas ofertas a través de sus variantes
/*     public function ofertas()
    {
        return $this->hasManyThrough(Oferta::class, Variante::class);
    } */

    public function oferta()
{
    return $this->hasOneThrough(Oferta::class, Variante::class, 'producto_id', 'variante_id', 'id', 'id');
}


}
