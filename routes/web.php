<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true, 'reset' => true, 'register' => false, 'login' => false]);
// CRUD de productos
Route::resource('productos', ProductoController::class);

// Registro de usuario
Route::get('/registro', [UserController::class, 'showRegistrationForm'])->name('users.register');
Route::post('/registro', [UserController::class, 'register'])->name('users.store');

// Login de usuario
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.attempt');

// Página de inicio (pública o protegida como prefieras)
Route::get('/inicio', function () {
    return view('pages.inicio');
})->name('inicio');

Route::get('/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
 


// routes/web.php
Route::get('/pesticidas', [ProductoController::class, 'indexPesticidas']);

 

Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');

Route::get('/perfil', function () {
    $user = Auth::user(); // Obtiene el usuario autenticado
    return view('users.perfil', compact('user')); // Pasa los datos a la vista
})->middleware('auth')->name('profile');

// Ruta nueva agregada para actualizar perfil usando updateUser
/* Route::put('/perfil/actualizar', [UserController::class, 'updateUser'])->name('usuario.update'); */

Route::put('/perfil/actualizar', [UserController::class, 'updateUser'])
    ->middleware('auth')
    ->name('usuario.update');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// nuevas rutas carrito 
// web.php (Laravel)
use App\Http\Controllers\CartController;  // Importa el controlador
/* Route::middleware(['auth'])->group(function () { */
// Ruta para almacenar productos en el carrito
/* Route::get('/cart', [CartController::class, 'index']);

Route::post('/cart/store', [CartController::class, 'store']);

Route::delete('/cart/destroy/{id}', [CartController::class, 'destroy']);

Route::put('/cart/update/{id}', [CartController::class, 'update']);

Route::delete('/cart/clear', [CartController::class, 'clear']); */
/* }); */

Route::get('/nosotro', function () {
    return view('nosotros');
})->name('nosotros');

Route::view('/contacto', 'contacto')->name('contacto');

use App\Http\Controllers\Admin\ProductoController as AdminProductoController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('productos', AdminProductoController::class);
});


use App\Http\Controllers\ModoVistaController;

Route::post('/cambiar-modo', [ModoVistaController::class, 'cambiarModo'])->name('cambiar.modo');

/* use App\Http\Controllers\BusquedaController;

Route::get('/buscar-ajax', [BusquedaController::class, 'ajax'])->name('busqueda.global'); */


use App\Http\Controllers\BusquedaController;

Route::get('/busqueda', [BusquedaController::class, 'buscar'])->name('busqueda.productos');


use App\Http\Controllers\CarritoController;
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
Route::get('/carrito/contenido', [CarritoController::class, 'contenido'])->name('carrito.contenido');

use App\Http\Controllers\CategoriaController;


 
Route::resource('categorias', CategoriaController::class)->names([
    'index' => 'admin.categorias.index',
    'create' => 'categorias.create',
    'store' => 'admin.categorias.store',
    'edit' => 'admin.categorias.edit',
    'update' => 'categorias.update',
    'destroy' => 'admin.categorias.destroy',
]);


/* Route::prefix('admin')->name('categorias.')->middleware('auth')->group(function () {
    Route::resource('categorias', CategoriaController::class);
}); */


use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categorias', AdminCategoriaController::class);
});

Route::get('/categoria/{slug}', [CategoriaController::class, 'show']);



Route::get('/productos/categoria/{categoriaNombre}', [ProductoController::class, 'categoria'])
    ->name('productos.categoria');



Route::get('/productos/categoria/id/{id}', [ProductoController::class, 'categoriaPorId'])
    ->name('productos.categoria.id');


    Route::get('/categoria/id/{id}', [ProductoController::class, 'categoriaPorId'])->name('productos.categoria.id');
