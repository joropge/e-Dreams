<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnregisteredController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DireccionesController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Models\Carrito;
use App\Http\Controllers\FrontController;

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

/*-------------------------------------------PRODUCTOS----------------------------------------- */

Route::get('/unregistered', [UnregisteredController::class, 'unregistered'])->name('unregistered');
// camisetas
Route::get('users/camisetas/index', [ProductoController::class, 'camisetasIndex'])->name('camisetas.index');
// pantalones
Route::get('/users/pantalones/index', [ProductoController::class, 'pantalonesIndex'])->name('pantalones.index');
// sudaderas
Route::get('/users/sudaderas/index', [ProductoController::class, 'sudaderasIndex'])->name('sudaderas.index');

//front
Route::get('/users/front/index', [FrontController::class, 'index'])->name('front.index');
Route::get('/users/paginaPrincipal/index', [FrontController::class, 'index'])->name('dashboard');






/*-------------------------------------------DIRECCIONES----------------------------------------- */

// Route::get('/admin/direcciones/create', [DireccionesController::class, 'create'])->name('direcciones.create');
// Route::get('/admin/direcciones/{direccion}', [DireccionesController::class, 'show'])->name('direcciones.show');

Route::post('/admin/direcciones/create', [DireccionesController::class, 'store'])->name('direcciones.store');
//mostrar direcciones
Route::get('/admin/direcciones/index', [DireccionesController::class, 'index'])->name('direcciones.index');
//Ruta a editar direcciones
Route::get('/admin/direcciones/{direcciones}/edit', [DireccionesController::class, 'edit'])->name('direcciones.edit');
//Update direcciones
Route::put('/admin/direcciones/{direcciones}', [DireccionesController::class, 'update'])->name('direcciones.update');
//Eliminar direcciones
Route::delete('/admin/direcciones/{direcciones}', [DireccionesController::class, 'destroy'])->name('direcciones.destroy');

// Route::get('/user/{id}/pedidos', [PedidoController::class, 'getProductIdsByUser'])->name('user.pedidos');


Route::delete('/admin/direcciones/{carrito}', [DireccionesController::class, 'destroy'])->name('carritos.destroy');

/*-------------------------------------------CARRITO----------------------------------------- */

//Mandar informacion de la compra
Route::post('/user/carrito/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');
// Route::get('/user/carrito/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');
//eliminar todo el carrito
Route::get('/user/carrito/destroy', [CarritoController::class, 'destroy'])->name('carrito.destroy');
//eliminar un producto del carrito
Route::delete('/user/carrito/{carrito}', [CarritoController::class, 'delete'])->name('carrito.delete');
Route::post('/user/carrito/delete', [CarritoController::class, 'delete'])->name('carrito.delete');
//añadir un producto al carrito
Route::post('/user/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
//Mostrar el carrito
Route::get('/user/carrito', [CarritoController::class, 'index'])->name('carrito.index');
//Actualizar la cantidad de un producto en el carrito
Route::put('/user/carrito/{id}', [CarritoController::class, 'update'])->name('carrito.update');






// ruta a discover
Route::get('/discover', function () {
    return view('discover');
})->name('discover');
//ruta a privacy-policy
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');



require __DIR__.'/auth.php';
require __DIR__.'/socialstream.php';