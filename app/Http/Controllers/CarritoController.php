<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $user = Auth::user();
        $item = CartItem::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->where('variante_id', $request->variante_id)
            ->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'variante_id' => $request->variante_id,
                'nombre' => $request->nombre,
                'tamaño' => $request->tamaño,
                'price' => $request->price,
                'quantity' => $request->quantity ?? 1,
                'imagen' => $request->imagen,
            ]);
        }

        $cantidad = CartItem::where('user_id', $user->id)->sum('quantity');
        return response()->json(['success' => true, 'cantidad' => $cantidad]);
    }

    public function actualizar(Request $request)
    {
        $user = Auth::user();
        $item = CartItem::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->where('variante_id', $request->variante_id)
            ->first();

        if ($item) {
            $item->quantity = max(1, $request->quantity);
            $item->save();
        }
        return response()->json(['success' => true]);
    }

    public function eliminar(Request $request)
    {
        $user = Auth::user();
        CartItem::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->where('variante_id', $request->variante_id)
            ->delete();
        return response()->json(['success' => true]);
    }

    public function vaciar()
    {
        $user = Auth::user();
        CartItem::where('user_id', $user->id)->delete();
        return response()->json(['success' => true]);
    }

    public function contenido()
    {
        $user = Auth::user();
        $carrito = CartItem::where('user_id', $user->id)->get();
        $carritoArray = [];
        foreach ($carrito as $item) {
            $key = $item->product_id . '-' . $item->variante_id;
            $carritoArray[$key] = [
                'product_id' => $item->product_id,
                'variante_id' => $item->variante_id,
                'nombre' => $item->nombre,
                'tamaño' => $item->tamaño,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'imagen' => $item->imagen,
            ];
        }
        return response()->json(['carrito' => $carritoArray]);
    }
}