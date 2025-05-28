<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use App\Models\Categoria;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $query = Producto::query()->with('categoria');

    if ($request->filled('nombre')) {
        $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }

    if ($request->filled('categoria')) {
        $query->where('categoria_id', $request->categoria);
    }

    $productos = $query->paginate(10); // con paginación
    $categorias = Categoria::all();

    return view('admin.productos.index', compact('productos', 'categorias'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $producto = Producto::findOrFail($id);
    $categorias = Categoria::all(); // Para elegir nueva categoría si es necesario

    return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);

    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|max:10000',
    ]);

    $producto->nombre = $request->nombre;
    $producto->descripcion = $request->descripcion;
    $producto->precio = $request->precio;
    $producto->categoria_id = $request->categoria_id;

    if ($request->hasFile('imagen')) {
        // Eliminar imagen anterior
        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        // Guardar nueva imagen
        $path = $request->file('imagen')->store('productos', 'public');
        $producto->imagen = $path;
    }

    $producto->save();

    return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $producto = Producto::findOrFail($id);

    // Eliminar imagen asociada si existe
    if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
        Storage::disk('public')->delete($producto->imagen);
    }

    $producto->delete();

    return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
