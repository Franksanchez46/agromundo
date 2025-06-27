<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

// Página de bienvenida
Route::get('/', function () {
    return view('pages.inicio');
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

// Página de inicio
Route::get('/inicio', function () {
    return view('pages.inicio');
})->name('inicio');

// routes/web.php
Route::get('/pesticidas', [ProductoController::class, 'indexPesticidas']);

Route::get('/perfil', function () {
    $user = Auth::user();
    return view('users.perfil', compact('user'));
})->middleware('auth')->name('profile');

Route::put('/perfil/actualizar', [UserController::class, 'updateUser'])
    ->middleware('auth')
    ->name('usuario.update');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

use App\Http\Controllers\CartController;

Route::get('/nosotro', function () {
    return view('nosotros');
})->name('nosotros');

Route::view('/contacto', 'contacto')->name('contacto');

// Rutas de administración
use App\Http\Controllers\Admin\ProductoController as AdminProductoController;
use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('productos', AdminProductoController::class);
    Route::resource('categorias', AdminCategoriaController::class);
});

// ELIMINAR ESTA SECCIÓN DUPLICADA:
// Route::resource('categorias', CategoriaController::class)->names([
//     'index' => 'admin.categorias.index',
//     'create' => 'categorias.create',
//     'store' => 'admin.categorias.store',
//     'edit' => 'admin.categorias.edit',
//     'update' => 'categorias.update',
//     'destroy' => 'admin.categorias.destroy',
// ]);

use App\Http\Controllers\ModoVistaController;
Route::post('/cambiar-modo', [ModoVistaController::class, 'cambiarModo'])->name('cambiar.modo');

use App\Http\Controllers\BusquedaController;
Route::get('/busqueda', [BusquedaController::class, 'buscar'])->name('busqueda.productos');

use App\Http\Controllers\CarritoController;
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
Route::get('/carrito/contenido', [CarritoController::class, 'contenido'])->name('carrito.contenido');
Route::get('/carrito', [CarritoController::class, 'mostrar'])->name('carrito.mostrar');
Route::post('/carrito/descontar-stock', [CarritoController::class, 'descontarStock'])->name('carrito.descontarStock');

// Rutas públicas de categorías
use App\Http\Controllers\CategoriaController;
Route::get('/categoria/{slug}', [CategoriaController::class, 'show']);
Route::get('/productos/categoria/{categoriaNombre}', [ProductoController::class, 'categoria'])
    ->name('productos.categoria');
Route::get('/productos/categoria/id/{id}', [ProductoController::class, 'categoriaPorId'])
    ->name('productos.categoria.id');

// Rutas de pago
use App\Http\Controllers\PagoController;
Route::get('/pago/respuesta', [PagoController::class, 'respuesta'])->name('pago.respuesta');
Route::get('/pago/confirmacion', [PagoController::class, 'confirmacion'])->name('pago.confirmacion');

// Rutas de ofertas
use App\Http\Controllers\OfertaController;
Route::get('/ofertas', [OfertaController::class, 'index']);
Route::resource('ofertas', OfertaController::class);

// Rutas de carrusel
use App\Http\Controllers\Admin\CarruselController;
Route::get('/admin/productos/carrusel/index', [CarruselController::class, 'index'])->name('admin.carrusel.index');
Auth::routes(['verify' => true, 'reset' => true, 'register' => false, 'login'=>false]);


Route::resource('ofertas', OfertaController::class);

Route::post('/carrito/vaciar', [App\Http\Controllers\CarritoController::class, 'vaciar'])->name('carrito.vaciar');

Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrar'])->name('carrito.mostrar');


Route::post('/carrito/descontar-stock', [App\Http\Controllers\CarritoController::class, 'descontarStock'])->name('carrito.descontarStock');
