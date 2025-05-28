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
        'quantity',
        'price',
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

    // Si quieres asegurar que siempre se guarde el precio cuando el producto es añadido al carrito
    public static function boot()
    {
        parent::boot();

        static::creating(function ($cartItem) {
            // Asegurarse de que el precio es tomado del producto en el momento de la creación
            $producto = Producto::find($cartItem->product_id);
            if ($producto) {
                $cartItem->price = $producto->precio; // Guardar el precio actual del producto
            }
        });
    }
}
