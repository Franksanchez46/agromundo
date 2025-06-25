<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\CartItem;
use App\Models\Variante;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    // El usuario es redirigido aquí tras pagar

    public function respuesta(Request $request)
{
    return view('pago.respuesta');
}

    // Webhook de ePayco (opcional, por si lo usas)
    public function confirmacion(Request $request)
    {
        Log::info('Confirmación de ePayco recibida:', $request->all());

        $estado = $request->input('x_response');
        $userId = $request->input('x_extra1');

        Log::info("Estado recibido: $estado, userId: $userId");

        if (strtolower($estado) === 'aprobada' && $userId) {
            $cartItems = CartItem::where('user_id', $userId)->get();
            Log::info("Items en carrito para usuario $userId: " . $cartItems->count());

            foreach ($cartItems as $item) {
                Log::info("Procesando item: variante_id={$item->variante_id}, cantidad={$item->quantity}");
                $variante = Variante::find($item->variante_id);
                if ($variante) {
                    Log::info("Variante encontrada: stock actual={$variante->stock}");
                    if ($variante->stock >= $item->quantity) {
                        $variante->stock -= $item->quantity;
                        $variante->save();
                        Log::info("Stock actualizado: nuevo stock={$variante->stock}");
                    } else {
                        Log::warning("Stock insuficiente para variante_id={$item->variante_id}");
                    }
                } else {
                    Log::warning("Variante no encontrada: variante_id={$item->variante_id}");
                }
            }

            CartItem::where('user_id', $userId)->delete();
            Log::info("🛒 Carrito vaciado para el usuario con ID $userId tras pago aprobado.");
        }

        return response('OK', 200);
    }
}
