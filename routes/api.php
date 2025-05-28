<?php
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Grupo de rutas para el carrito (requiere autenticación)
Route::middleware('auth:sanctum')->group(function () {
    // Obtener todos los productos del carrito
    Route::get('/carrito', [CartController::class, 'index']);

    // Agregar un producto al carrito
    Route::post('/carrito', [CartController::class, 'store']);

    // Actualizar la cantidad de un producto en el carrito
    Route::put('/carrito/{id}', [CartController::class, 'update']);

    // Eliminar un producto del carrito
    Route::delete('/carrito/{id}', [CartController::class, 'destroy']);

    // Vaciar el carrito
    Route::delete('/carrito/vaciar', [CartController::class, 'clear']);
});

