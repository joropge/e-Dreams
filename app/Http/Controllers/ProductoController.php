<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Pedido;
use App\Models\User;
use App\Models\Direccion;
use App\Models\Categoria;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Devuelve una vista con todos los productos
        return view('productos.index', ['productos' => Producto::all()]);
    }

    //No se usa
    public function show(Producto $producto)
    {
        // Muestra los detalles de un producto específico
        return view('productos.show', ['producto' => $producto]);
    }

    //Productos with catogoria_id = 1
    public function camisetasIndex()
    {
        $productos = Producto::where('categoria_id', 1)->get();
        return view('productos.camisetas.index', ['productos' => $productos]);
    }
    //Productos with catogoria_id = 2
    public function sudaderasIndex()
    {
        $productos = Producto::where('categoria_id', 2)->get();
        return view('productos.sudaderas.index', ['productos' => $productos]);
    }
    //Productos with catogoria_id = 3
    public function pantalonesIndex()
    {
        $productos = Producto::where('categoria_id', 3)->get();
        return view('productos.pantalones.index', ['productos' => $productos]);
    }
    //Productos with catogoria_id = 4 -> modificarlo cuando queramos mostrar otro tipo de productos
    public function frontIndex()
    {
        $productos = Producto::where('categoria_id', 4)->get();
        return view('productos.zapatos.index', ['productos' => $productos]);
    }
}
