<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PagoController extends Controller
{
    // El usuario es redirigido aquí tras pagar
    public function respuesta(Request $request)
    {
        return view('pago.respuesta'); // crea esta vista después
    }

    // ePayco envía datos de pago aquí automáticamente (no lo ve el usuario)
    public function confirmacion(Request $request)
    {
        // Aquí podrías guardar en la base de datos si el pago fue aprobado
        // Ejemplo: verificar estado y guardar en tabla "pagos"
        Log::info('Confirmación de ePayco:', $request->all());

        return response('OK', 200);
    }
}
