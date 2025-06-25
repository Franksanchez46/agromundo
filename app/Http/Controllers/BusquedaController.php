<?php
//         }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class BusquedaController extends Controller
{
    public function buscar(Request $request)
    {
        $q = $request->input('q');
        $productos = Producto::where('nombre', 'like', "%$q%")
            ->orWhere('descripcion', 'like', "%$q%")
            ->get();
        return view('resultados.busqueda', compact('productos', 'q'));
    }
}