<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $carrito = session()->get('carrito', []);

        return view('/users/carrito.index', compact('carrito'));


        // return view('/users/carrito.index', ['carritos' => Carrito::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Aquí puedes retornar la vista para crear un nuevo carrito
        return view('/users/carrito.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $request['user_id'] = $user->id;


        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'producto_id' => 'nullable|exists:productos,id',
            'total' => 'required|numeric',
        ]);

        Carrito::create($validated);

        return redirect()->route('/users/carrito.index')->with('success', 'Carrito creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrito $carrito): View
    {
        return view('/users/carrito.show', ['carrito' => $carrito]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrito $carrito)
    {
        return view('/users/carrito.edit', ['carrito' => $carrito]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrito $carrito)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            // 'producto_id' => 'nullable|exists:productos,id',
            'pedido_id' => 'nullable|exists:pedidos,id', // 'exists' valida que el valor exista en la tabla 'pedidos
            'total' => 'required|numeric',
        ]);

        $carrito->update($validated);

        return redirect()->route('/users/carrito.index')->with('success', 'Carrito actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrito $carrito)
    {
        $carrito->delete();
        return redirect()->route('/users/carrito.index')->with('success', 'Carrito eliminado correctamente');
    }

    public function delete(Request $request)
    {
        $productId = $request->input('id');

        $carrito = session()->get('carrito');

        if (isset($carrito[$productId])) {
            unset($carrito[$productId]);
        }

        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }   



    // public function add(Request $request)
    // {
    //     $producto = Producto::find($request->producto_id);
    //     if (empty($producto)) {
    //         return redirect()->route('carrito.index')->with('error', 'Producto no encontrado');
    //         // dd($producto);  
    //         Carrito::add(
    //             $producto->id, 
    //             $producto->nombre, 
    //             1, 
    //             $producto->precio,
    //             ["imagen" => $producto->imagen]
    //         );

    //         return redirect()->route('carrito.index')->with('success', 'Producto añadido al carrito correctamente' . $producto->nombre);
    //     }

    //     // $user = auth()->user();
    //     // $request['user_id'] = $user->id;

    //     // $validated = $request->validate([
    //     //     'user_id' => 'nullable|exists:users,id',
    //     //     'producto_id' => 'nullable|exists:productos,id',
    //     //     'total' => 'required|numeric',
    //     // ]);

    //     // Carrito::create($validated);

    //     // return redirect()->route('/users/carrito.index')->with('success', 'Producto añadido al carrito correctamente');
    // }
    public function add(Request $request)
    {
        // Obtener el ID del producto desde la solicitud
        $productId = $request->input('id');

        // Obtener el carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Agregar el producto al carrito
        if (isset($carrito[$productId])) {
            $carrito[$productId]['cantidad']++;
        } else {
            $producto = \App\Models\Producto::find($productId);
            $carrito[$productId] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'imagen' => $producto->imagen
            ];
        }

        // Guardar el carrito en la sesión
        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

}
