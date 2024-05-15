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

Route::get('/camisetas/index', [ProductoController::class, 'index'])->name('camisetas.index');
// Route::get('/camisetas/create', [ProductoController::class, 'create'])->name('camisetas.create');
// Route::post('/camisetas/create', [ProductoController::class, 'store'])->name('camisetas.store');
// Route::get('/camisetas/{producto}', [ProductoController::class, 'show'])->name('camisetas.show');
// Route::get('/camisetas/{producto}/edit', [ProductoController::class, 'edit'])->name('camisetas.edit');
// Route::put('/camisetas/{producto}', [ProductoController::class, 'update'])->name('camisetas.update');
// Route::delete('/camisetas/{producto}', [ProductoController::class, 'destroy'])->name('camisetas.destroy');

Route::get('pantalones/index', [ProductoController::class, 'index'])->name('pantalones.index');
// sudaderas
Route::get('sudaderas/index', [ProductoController::class, 'index'])->name('sudaderas.index');
// carrito
Route::get('carrito/index', [CarritoController::class, 'index'])->name('carrito.index');

Route::get('/admin/direcciones/index', [DireccionesController::class, 'index'])->name('direcciones.index');
Route::put('/admin/direcciones/{direccion}', [DireccionesController::class, 'update'])->name('direcciones.update');
Route::delete('/admin/direcciones/{direccion}', [DireccionesController::class, 'destroy'])->name('direcciones.destroy');





// ruta a discover
Route::get('/discover', function () {
    return view('discover');
})->name('discover');
//ruta a privacy-policy
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');
//ruta a camisteas
Route::get('/index', function () {
    return view('index');
})->name('index');
//ruta a pantalones
Route::get('/pantalones', function () {
    return view('pantalones');
})->name('pantalones');



require __DIR__.'/auth.php';
