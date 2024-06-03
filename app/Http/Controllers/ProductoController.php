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
                'precio' => 'required|decimal',
                'stock' => 'required|integer',
                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
            ]);

            if ($request->hasFile('picture')) {
                $validated['picture'] = $request->file('picture')->store('public/photos');

                if ($producto->picture) {
                    Storage::delete($producto->picture);
                }
            }

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
