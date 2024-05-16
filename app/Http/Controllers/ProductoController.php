<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use App\Models\User;
use App\Models\Direccion;
use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;


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
    // {
    //     // Devuelve todos los productos en formato JSON
    //     $productos = Producto::all();
    //     return response()->json($productos);
    // }

    public function create()
    {
        // Muestra la vista de creación de productos
        return view('productos.create');
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario y crea un nuevo producto
        try {
            $validated = $request->validate([
                'nombre' => 'required',
                'categoria_id' => 'nullable|exists:categorias,id', // 'exists' valida que el valor exista en la tabla 'categorias'
                'descripcion' => 'nullable|string|max:250',
                'precio' => 'required|numeric',
                'stock' => 'required|numeric',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            $producto = Producto::create($validated);
            return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.create')->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Producto $producto)
    {
        // Muestra los detalles de un producto específico
        return view('productos.show', ['producto' => $producto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        // Muestra la vista de edición de un producto específico
        return view('productos.edit', ['producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        // Valida los datos del formulario y actualiza el producto
        try {
            $validated = $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
                'precio' => 'required|integer',
                'stock' => 'required|integer',
                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
            ]);

            $producto->update($validated);
            return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.edit', $producto)->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        // Elimina un producto específico de la base de datos
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

    private function applyFilters(Request $request, Builder $query): Builder
    {
        if ($request->filled('search')) {
            $query->where('estado', 'like', '%' . $request->get('search') . '%');
        }

        if ($request->filled('stock')) {
            $query->where('stock', $request->get('stock'));
        }

        if ($request->filled('price')) {
            $query->where('precio', $request->get('price'));
        }

        if ($request->filled('user')) {
            $query->where('user_id', $request->get('user'));
        }

        if ($request->filled('name')) {
            $query->where('nombre', $request->get('user'));
        }

        return $query;
    }

    public function search(Request $request)
    {
        $productos = $this->applyFilters($request, Producto::query())->paginate(5);
        return view('productos.index', ['productos' => $productos]);
    }

    public function myIndex(){
        $user = auth()->user();
        return view('productos.myIndex',
        ['productos' => $user->productos]);
    }

    // Show only Productos with catogoria_id = 1 and send them to the view
    public function camisetasIndex()
    {
        $productos = Producto::where('categoria_id', 1)->get();
        return view('productos.camisetas.index', ['productos' => $productos]);
    }

    // Show only Productos with catogoria_id = 2
    public function pantalonesIndex()
    {
        $productos = Producto::where('categoria_id', 2)->get();
        return view('productos.pantalones.index', ['productos' => $productos]);
    }
}
