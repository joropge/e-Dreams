<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(): View
    // {
    //     $carrito = session()->get('carrito', []);

    //     return view('/users/carrito.index', compact('carrito'));
    // }
    //     public function index(): View
    // {
    //     $carrito = session()->get('carrito', []);

    //     $total = 0;
    //     foreach ($carrito as $id => $producto) {
    //         $total += $producto['precio'] * $producto['cantidad'];
    //     }

    //     return view('/users/carrito.index', compact('carrito', 'total'));
    // }



    //     /**
    //      * Show the form for creating a new resource.
    //      */
    //     public function create()
    //     {
    //         // Aquí puedes retornar la vista para crear un nuevo carrito
    //         return view('/users/carrito.create');
    //     }

    //     /**
    //      * Store a newly created resource in storage.
    //      */
    //     public function store(Request $request)
    //     {
    //         $user = auth()->user();
    //         $request['user_id'] = $user->id;


    //         $validated = $request->validate([
    //             'user_id' => 'nullable|exists:users,id',
    //             'producto_id' => 'nullable|exists:productos,id',
    //             'total' => 'required|numeric',
    //         ]);

    //         Carrito::create($validated);

    //         return redirect()->route('/users/carrito.index')->with('success', 'Carrito creado correctamente');
    //     }

    //     /**
    //      * Display the specified resource.
    //      */
    //     public function show(Carrito $carrito): View
    //     {
    //         return view('/users/carrito.show', ['carrito' => $carrito]);
    //     }

    //     /**
    //      * Show the form for editing the specified resource.
    //      */
    //     public function edit(Carrito $carrito)
    //     {
    //         return view('/users/carrito.edit', ['carrito' => $carrito]);
    //     }

    //     /**
    //      * Update the specified resource in storage.
    //      */
    //     public function update(Request $request, $id)
    //     {
    //         $carrito = session()->get('carrito');

    //         if (isset($carrito[$id])) {
    //             $cantidad = $request->cantidad;

    //             // Si la cantidad es 0, eliminar el producto del carrito
    //             if ($cantidad == 0) {
    //                 unset($carrito[$id]);
    //                 session()->put('carrito', $carrito);
    //                 return response()->json(['success' => true, 'message' => 'Producto eliminado.']);
    //             }

    //             // Si la cantidad es mayor a 0, actualizar la cantidad
    //             $carrito[$id]['cantidad'] = $cantidad;
    //             session()->put('carrito', $carrito);
    //             return response()->json(['success' => true, 'message' => 'Cantidad actualizada.']);
    //         }

    //         return response()->json(['success' => false, 'message' => 'Producto no encontrado.']);
    //     }

    //     public function checkout(Request $request)
    //     {
    //         // Obtener el usuario actual y su dirección de envío
    //         $user_id = auth()->user()->id;
    //         $direccion_id = auth()->user()->direccion_id;

    //         // Obtener los artículos del carrito del usuario actual
    //         $carrito = session()->get('carrito', []);

    //         // Iterar sobre los artículos del carrito y crear un pedido para cada uno
    //         foreach ($carrito as $producto) {
    //             Pedido::create([
    //                 'user_id' => $user_id,
    //                 'producto_id' => $producto->id,
    //                 'direccion_id' => $direccion_id,
    //                 'total' => $producto->precio,
    //                 'estado' => 'enviado', // O el estado que desees asignar inicialmente
    //             ]);
    //         }
    //         // foreach ($carrito as $producto) {
    //         //     Pedido::create([
    //         //         'user_id' => $user_id,
    //         //         'producto_id' => $producto['id'],
    //         //         'direccion_id' => $direccion_id,
    //         //         'total' => $producto['precio'],
    //         //         'estado' => 'enviado', // O el estado que desees asignar inicialmente
    //         //     ]);
    //     }



    //     /**
    //      * Remove the specified resource from storage.
    //      */
    //     public function destroyAll(Carrito $carrito)
    //     {
    //         $carrito->delete();

    //         return redirect()->route('/users/carrito.index')->with('success', 'Carrito eliminado correctamente');
    //     }

    //     public function delete(Request $request)
    //     {
    //         $productId = $request->input('id');

    //         $carrito = session()->get('carrito');

    //         if (isset($carrito[$productId])) {
    //             unset($carrito[$productId]);
    //         }

    //         session()->put('carrito', $carrito);

    //         return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    //     }

    // public function add(Request $request)
    // {
    //     // Obtener el ID del producto desde la solicitud
    //     $productId = $request->input('id');

    //     // Obtener el carrito de la sesión
    //     $carrito = session()->get('carrito', []);

    //     // Agregar el producto al carrito
    //     if (isset($carrito[$productId])) {
    //         $carrito[$productId]['cantidad']++;
    //     } else {
    //         $producto = \App\Models\Producto::find($productId);
    //         $carrito[$productId] = [
    //             'nombre' => $producto->nombre,
    //             'precio' => $producto->precio,
    //             'cantidad' => 1,
    //             'imagen' => $producto->imagen,
    //             'categoria_id' => $producto->categoria_id,
    //         ];
    //     }

    //     // Guardar el carrito en la sesión
    //     session()->put('carrito', $carrito);

    //     return redirect()->back()->with('success', 'Producto añadido al carrito.');
    // }

    public function index()
    {
        $user = Auth::user();
        $carrito = Carrito::where('user_id', $user->id)->with('producto')->get();

        $total = $carrito->sum(function ($item) {
            return $item->product->precio * $item->cantidad;
        });

        return view('users.carrito.index', compact('carrito', 'total'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $carritoItem = Carrito::where('user_id', $user->id)->where('producto_id', $id)->first();

        if ($carritoItem) {
            $carritoItem->update(['cantidad' => $request->cantidad]);
        }

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $carritoItem = Carrito::where('user_id', $user->id)->where('producto_id', $request->id)->first();

        if ($carritoItem) {
            $carritoItem->delete();
        }

        return redirect()->route('users.carrito.index');
    }

    public function destroy()
    {
        $user = Auth::user();
        Carrito::where('user_id', $user->id)->delete();

        return redirect()->route('users.carrito.index');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $carrito = Carrito::where('user_id', $user->id)->with('producto')->get();

        // Aquí iría la lógica del proceso de compra

        // Después del checkout, vaciar el carrito
        Carrito::where('user_id', $user->id)->delete();

        return redirect()->route('users.carrito.index')->with('success', 'Compra realizada con éxito');
    }

    public function add(Request $request)
    {

        // $request->validate([

        //     'producto_id' => 'required|exists:id',
        //     'cantidad' => 'required|integer|min:1',

        // ]);
        // dd($request->all());

        // Obtener el usuario autenticado
        $user = Auth::user();
        $producto = Producto::find($request->id);

        // Verificar si el producto existe
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Verificar si el producto ya existe en el carrito del usuario
        $carritoItem = Carrito::where('user_id', $user->id)
            ->where('producto_id', $producto->id)
            ->first();


        // Si el producto ya está en el carrito, actualizar la cantidad y el total
        if ($carritoItem) {
            $carritoItem->cantidad += $request->cantidad;
            $carritoItem->total = $carritoItem->cantidad * $producto->precio;
            $carritoItem->save();
        } else {
            // dd($producto->id, $request->cantidad, $producto->precio);
            // Si el producto no está en el carrito, crear uno nuevo
            $carritoItem = new Carrito([
                'user_id' => $user->id,
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'total' => $request->cantidad * $producto->precio,
            ]);
            
            $carritoItem->save();
        }

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }
}
