<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'variante_id',
        'nombre',
        'tamaño',
        'imagen',
        'quantity',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
        'quantity' => 'integer',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'product_id');
    }

    // Relación con la variante
    public function variante()
    {
        return $this->belongsTo(Variante::class);
    }

    // Asignar automáticamente el precio desde el producto (opcional)
    public static function boot()
    {
        parent::boot();

        static::creating(function ($cartItem) {
            $producto = Producto::find($cartItem->product_id);
            if ($producto && is_null($cartItem->price)) {
                $cartItem->price = $producto->precio;
            }
        });
    }
}

