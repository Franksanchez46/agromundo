<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModoVistaController extends Controller
{
    public function cambiarModo(Request $request)
    {
        if (auth()->check() && auth()->user()->rol_id === 1) {
            $modoActual = session('modo_admin', true);
            $nuevoModo = !$modoActual;

            session(['modo_admin' => $nuevoModo]);

            // Redirección según el nuevo modo
            return $nuevoModo
                ? redirect()->route('admin.productos.index') // modo_admin = true
                : redirect()->route('inicio'); // modo_admin = false
        }

        return redirect()->route('inicio');
    }
}
