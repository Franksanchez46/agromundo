<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Variante; // Importa Variante para validar stock
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $user = Auth::user();

        // Validar variante y stock
        $variante = Variante::find($request->variante_id);
        if (!$variante) {
            return response()->json([
                'success' => false,
                'message' => 'Variante no encontrada.'
            ], 422);
        }
        $stock = $variante->stock;
        $addQty = $request->quantity ?? 1;

        $item = CartItem::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->where('variante_id', $request->variante_id)
            ->first();

        $currentQty = $item ? $item->quantity : 0;
        $newQty = $currentQty + $addQty;

        if ($newQty > $stock) {
            return response()->json([
                'success' => false,
                'message' => "Solo hay {$stock} unidades disponibles."
            ], 422);
        }

        if ($item) {
            $item->quantity = $newQty;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'variante_id' => $request->variante_id,
                'nombre' => $request->nombre,
                'tamaño' => $request->tamaño,
                'price' => $request->price,
                'quantity' => $addQty,
                'imagen' => $request->imagen,
            ]);
        }

        $cantidad = CartItem::where('user_id', $user->id)->sum('quantity');
        return response()->json(['success' => true, 'cantidad' => $cantidad]);
    }

    public function actualizar(Request $request)
    {
        $user = Auth::user();

        // Validar variante y stock
        $variante = Variante::find($request->variante_id);
        if (!$variante) {
            return response()->json([
                'success' => false,
                'message' => 'Variante no encontrada.'
            ], 422);
        }
        $stock = $variante->stock;
        $newQty = max(1, (int) $request->quantity);

        if ($newQty > $stock) {
            return response()->json([
                'success' => false,
                'message' => "Solo hay {$stock} unidades disponibles."
            ], 422);
        }

        $item = CartItem::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->where('variante_id', $request->variante_id)
            ->first();

        if ($item) {
            $item->quantity = $newQty;
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
    public function mostrar()
{
    return view('pago.respuesta');
}

public function descontarStock()
{
    $userId = Auth::id();
    $cartItems = \App\Models\CartItem::where('user_id', $userId)->get();

    foreach ($cartItems as $item) {
        $variante = \App\Models\Variante::find($item->variante_id);
        if ($variante && $variante->stock >= $item->quantity) {
            $variante->stock -= $item->quantity;
            $variante->save();
        }
    }

    return response()->json(['success' => true]);
}
}