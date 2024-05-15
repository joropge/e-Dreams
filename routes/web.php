<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnregisteredController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DireccionesController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
// use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard-unauthenticated', function () {
    return view('dashboard');
})->name('dashboard-unauthenticated');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('carritos', CarritoController::class);
Route::resource('categorias', CategoriasController::class);
Route::resource('direcciones', DireccionesController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('productos', ProductoController::class);
Route::resource('users', ProfileController::class);

Route::get('/unregistered', [UnregisteredController::class, 'unregistered'])->name('unregistered');
// ruta a discover
Route::get('/discover', function () {
    return view('discover');
})->name('discover');
//ruta a privacy-policy




require __DIR__.'/auth.php';
