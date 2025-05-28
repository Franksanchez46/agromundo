<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    // Obtener el carrito
    public function index()
    {
        try {
            if (!Auth::check()) {
                return response()->json(['error' => 'Usuario no autenticado.'], 401);
            }
            $cartItems = $this->getFormattedCart();
            return response()->json(['cart' => $cartItems]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los productos del carrito.'], 500);
        }
    }

    // Agregar un producto al carrito
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:productos,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $user = Auth::user();
            $product = Producto::findOrFail($request->product_id);

            $cartItem = CartItem::where('user_id', $user->id)
                                ->where('product_id', $product->id)
                                ->first();

            if ($cartItem) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                $cartItem = CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->precio,
                ]);
            }

            $cartItems = $this->getFormattedCart();
            return response()->json(['cart' => $cartItems]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al agregar el producto al carrito.'], 500);
        }
    }

    // Actualizar la cantidad de un producto en el carrito
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $cartItem = CartItem::findOrFail($id);
            $cartItem->update(['quantity' => $request->quantity]);

            $cartItems = $this->getFormattedCart();
            return response()->json(['cart' => $cartItems]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la cantidad del producto.'], 500);
        }
    }

    // Eliminar un producto del carrito
    public function destroy($id)
    {
        try {
            $cartItem = CartItem::find($id);
            if (!$cartItem) {
                return response()->json(['error' => 'Producto no encontrado en el carrito.'], 404);
            }

            $cartItem->delete();

            $cartItems = $this->getFormattedCart();
            return response()->json(['cart' => $cartItems]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el producto del carrito.'], 500);
        }
    }

    // Vaciar el carrito
    public function clear()
    {
        try {
            CartItem::where('user_id', Auth::id())->delete();
            return response()->json(['cart' => []]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al vaciar el carrito.'], 500);
        }
    }

    // Función privada para formatear el carrito
    private function getFormattedCart()
    {
        if (!Auth::check()) {
            return [];
        }
        return CartItem::where('user_id', Auth::id())
            ->with('producto')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nombre' => $item->producto->nombre,
                    'precio' => $item->price,
                    'cantidad' => $item->quantity,
                ];
            });
    }
}
