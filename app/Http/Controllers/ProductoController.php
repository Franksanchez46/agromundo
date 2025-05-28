<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

    // ...


class ProductoController extends Controller
{

    public function categoria($categoriaNombre)
    
    {  
        

        $iconos =[
            'pesticidas' => 'fa-bug-slash',
            'abonos' => 'fas fa-leaf me-2',
            'animales' => 'fa-cow',
            'concentrado para animales de granja' => 'fa-box',
            'concentrado mascotas' => 'fa-paw',
            'medicamentos' => 'fa-capsules',
            'herramientas' => 'fa-tools',
        ];


                //nuevo
        // Obtener la categoría por nombre
        $categoria = Categoria::where('nombre', $categoriaNombre)->first();




        if ($categoria) {
            $categoria->icono = $iconos[strtolower($categoria->nombre)] ?? 'fa-question-circle';

           
            // Obtener productos de la categoría seleccionada
            $productos = Producto::where('categoria_id', $categoria->id)->get();



            // Pasar los productos y la categoría a la vista
            return view('productos.categoria', compact('categoria', 'productos'));
        } else {
            // Si no se encuentra la categoría, mostrar un error o redirigir
            return redirect()->route('productos.index')->with('error', 'Categoría no encontrada');
        }
    

    }


    // Método para mostrar todos los productos (sin filtro de categoría)
public function index()
{
    
    $usuario = auth()->user();

    if ($usuario && $usuario->es_admin && session('modo_admin') === true) {
        $categorias = Categoria::all();
        return view('productos.admin', compact('categorias'));
    }

    $productos = Producto::all();
    $categoria = null;

    return view('productos.categoria', compact('productos', 'categoria'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all(); // Trae todas las categorías
        return view('productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
            'categoria_id' => 'required|exists:categorias,id', // Validar que la categoría exista
        ]);

        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->categoria_id = $request->input('categoria_id');

        if ($request->hasFile('imagen')) {
            try {
                $file = $request->file('imagen');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('productos', $filename, 'public');
                $producto->imagen = 'productos/' . $filename;
                
            } catch (\Exception $e) {
                return back()->with('error', 'Error al cargar la imagen.')->withInput();
            }
        }

        $producto->save();

        return back()->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Puedes agregar lógica aquí si deseas mostrar un producto específico
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Lógica para editar el producto
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Lógica para actualizar el producto
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Lógica para eliminar el producto
    }
}
