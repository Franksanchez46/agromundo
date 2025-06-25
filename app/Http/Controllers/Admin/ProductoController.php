<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Variante;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Producto::query()->with('categoria', 'variantes');

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        $productos = $query->paginate(10);
        $categorias = Categoria::all();

        return view('admin.productos.index', compact('productos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|max:10000',
            'variantes' => 'nullable|array',
            'variantes.*.tamaño' => 'required_with:variantes|string',
            'variantes.*.precio' => 'required_with:variantes|numeric',
            'variantes.*.stock' => 'required_with:variantes|integer',
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria_id;

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $path;
        }

        $producto->save();

        if ($request->has('variantes')) {
            foreach ($request->variantes as $variante) {
                $producto->variantes()->create([
                    'tamaño' => $variante['tamaño'],
                    'precio' => $variante['precio'],
                    'stock' => $variante['stock'],
                ]);
            }
        }

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado correctamente.');
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
        $producto = Producto::with('variantes')->findOrFail($id);
        $categorias = Categoria::all();
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
            'precio' => 'numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|max:10000',
            'variantes' => 'nullable|array',
            'variantes.*.tamaño' => 'required_with:variantes|string',
            'variantes.*.precio' => 'required_with:variantes|numeric',
            'variantes.*.stock' => 'required_with:variantes|integer',
        ]);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria_id;

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $path = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $path;
        }

        $producto->save();

        // Eliminar variantes anteriores
        $producto->variantes()->delete();

        // Crear nuevas variantes
        if ($request->has('variantes')) {
            foreach ($request->variantes as $variante) {
                $producto->variantes()->create([
                    'tamaño' => $variante['tamaño'],
                    'precio' => $variante['precio'],
                    'stock' => $variante['stock'],
                ]);
            }
        }

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->variantes()->delete();
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
