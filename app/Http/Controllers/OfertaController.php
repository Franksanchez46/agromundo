<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    public function index()
    {
        // Cambio principal: Limitar a solo 8 ofertas para el carrusel
        // Puedes ajustar el número según necesites
        $ofertas = \App\Models\Oferta::limit(4)->get();
        
        /* Otras opciones que puedes usar:
        
        // Solo las más recientes:
        $ofertas = \App\Models\Oferta::latest()->limit(8)->get();
        
        // Si tienes un campo 'activa' o 'destacada':
        $ofertas = \App\Models\Oferta::where('activa', true)->limit(8)->get();
        
        // Si tienes fechas de vigencia:
        $ofertas = \App\Models\Oferta::where('fecha_fin', '>=', now())
                                   ->limit(8)
                                   ->get();
        
        // Ordenadas por descuento (mayor descuento primero):
        $ofertas = \App\Models\Oferta::orderBy('descuento', 'desc')
                                   ->limit(8)
                                   ->get();
        */
        
        return view('inicio', compact('ofertas'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'descripcion_breve' => 'nullable|string|max:255',
            'imagen' => 'required|string',
            'descuento' => 'required|integer',
            'alt' => 'required|string',
            'url' => 'required|string',
        ]);

        Oferta::create($validated);

        return redirect()->back()->with('success', 'Oferta creada correctamente');
    }
}