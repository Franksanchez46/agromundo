<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria; // Asegúrate de importar el modelo Categoria
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
 $query = Categoria::query();

    if ($request->filled('nombre')) {
        $nombre = strtolower($request->nombre);
       $query->where('nombre', 'LIKE', '%' . $request->nombre . '%');

    }

    $categorias = $query->get();

    return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'descripcion' => 'nullable|string|max:1000',
            'icono' => 'nullable|string',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('categorias', 'public');
        }

        Categoria::create([
            'nombre' => $request->nombre,
            'imagen' => $rutaImagen,
            'descripcion' => $request->descripcion,
            'icono' => $request->icono,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'descripcion' => 'nullable|string|max:1000',
            'icono' => 'nullable|string',
        ]);

        // Si hay nueva imagen, eliminar la anterior y guardar la nueva
        if ($request->hasFile('imagen')) {
            if ($categoria->imagen) {
                Storage::disk('public')->delete($categoria->imagen);
            }
            $categoria->imagen = $request->file('imagen')->store('categorias', 'public');
        }

        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'icono' => $request->icono,
            'imagen' => $categoria->imagen,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        if ($categoria->imagen) {
            Storage::disk('public')->delete($categoria->imagen);
        }

        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    
    }
}
