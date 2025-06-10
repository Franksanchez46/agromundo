<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; // Asegúrate de importar el modelo Categoria
\illuminate\Support\Facades\DB::enableQueryLog(); // Habilita el registro de consultas para depuración
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
        $query->whereRaw('LOWER(nombre) LIKE ?', ["%$nombre%"]);
    }

    $categorias = $query->get();

    return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create'); // Retorna la vista para crear una nueva categoría
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

        // Subir imagen si existe
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('categorias', 'public');
        } 
        
        // Crear la categoría
        Categoria::create([
            'nombre' => $request->input('nombre'),
            'imagen' => $rutaImagen,
            'descripcion' => $request->input('descripcion'),
            'icono' => $request->input('icono'),
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria')); // Retorna la vista para editar una categoría
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'descripcion' => 'nullable|string|max:1000',
            'icono' => 'nullable|string',
        ]);

        // Actualizar la imagen si se subió nueva
        if ($request->hasFile('imagen')){
            $rutaImagen = $request->file('imagen')->store('categorias', 'public');
            $categoria->imagen = $rutaImagen; // Actualiza la ruta de la imagen
        }

        $categoria->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'icono' => $request->input('icono'),
            'imagen' => $categoria->imagen, // Mantiene la imagen existente si no se subió una nueva
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete(); // Elimina la categoría por su ID
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
