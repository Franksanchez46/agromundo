<?php
// app/Http/Controllers/OfertaController.php
namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;
use App\Models\Variante;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class OfertaController extends Controller
{
    public function index()
    {
        // Cambio principal: Limitar a solo 8 ofertas para el carrusel
        // Puedes ajustar el número según necesites
        /* $ofertas = \App\Models\Oferta::limit(4)->get(); */
        
        $ofertas = Oferta::with('variante.producto')->get();

    $productos = Producto::with(['variantes.oferta'])->get();

        
        /* return view('inicio', compact('ofertas')); */
          return view('ofertas.index', compact('ofertas'));
    }

    public function create()
{
    $variantes = \App\Models\Variante::with('producto')->get();
    return view('ofertas.create', compact('variantes'));
}
    
    public function store(Request $request)
    {


        $request->validate([
        'titulo' => 'required',
        'descripcion' => 'required',
        'descuento' => 'required|numeric',
        'imagen' => 'image|mimes:jpg,jpeg,png,ico|max:10000',
        'variante_id' => 'required|exists:variantes,id',
        'alt' => 'required|string',
        'descripcion_breve' => 'nullable|string|max:255', // Asegúrate
    ]);

    $imagenPath = null;
    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('ofertas', 'public');
    }

    Oferta::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'descripcion_breve' => $request->descripcion_breve,
        'descuento' => $request->descuento,
        'imagen' => $imagenPath,
        'alt' => $request->alt,
        'variante_id' => $request->variante_id, // Asegúrate de que variante_id sea un campo en tu formulario
    ]);

    return redirect()->route('ofertas.index')->with('success', 'Oferta creada');
    }

    public function edit($id)
{
        $oferta = Oferta::findOrFail($id);
    $variantes = Variante::with('producto')->get(); // cargamos el producto asociado para mostrar nombre y tamaño
    return view('ofertas.edit', compact('oferta', 'variantes'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required',
        'descripcion' => 'required',
        'descuento' => 'required|numeric',
        'alt' => 'required|string',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png,ico|max:2048',
        'variante_id' => 'required|exists:variantes,id', // Asegúrate de que variante_id sea un campo en tu formulario
        'descripcion_breve' => 'nullable|string|max:255', // Asegúrate de que este campo sea opcional
    ]);

    $oferta = Oferta::findOrFail($id);

    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('ofertas', 'public');
        $oferta->imagen = $imagenPath;
    }

    $oferta->titulo = $request->titulo;
    $oferta->descripcion = $request->descripcion;
    $oferta->descripcion_breve = $request->descripcion_breve;
    $oferta->descuento = $request->descuento;
    $oferta->alt = $request->alt;
    $oferta->variante_id = $request->variante_id;
    $oferta->save();

    return redirect()->route('ofertas.index')->with('success', 'Oferta actualizada correctamente');
}

public function destroy($id)
{
    $oferta = Oferta::findOrFail($id);

    // Si hay imagen asociada, elimínala del almacenamiento
    if ($oferta->imagen) {
        Storage::disk('public')->delete($oferta->imagen);
    }

    $oferta->delete();

    return redirect()->route('ofertas.index')->with('success', 'Oferta eliminada correctamente.');
}

}