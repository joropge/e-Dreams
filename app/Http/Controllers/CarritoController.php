<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Direccion;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        $carritos = \App\Models\Carrito::with('producto')->get();
        $user = Auth::user();
        $carritos = Carrito::where('user_id', $user->id)->with('producto')->get();


        $total = 0;
        foreach ($carritos as $carrito) {
            $total += $carrito->producto->precio * $carrito->cantidad;
        }

        return view('users.carrito.index', compact('carritos', 'total'));
    }

    public function update(Request $request, $id)
    {

        try {
            $carrito = Carrito::findOrFail($id);
            $carrito->cantidad = $request->cantidad;
            $carrito->total = $carrito->cantidad * $carrito->producto->precio;
            if ($carrito->cantidad == 0) {
                $carrito->delete();
            } else {
                $carrito->save();
            }
            $carrito->save();


            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage('Error al incrementar o disminuir la cantidad del producto')], 500);
        }
    }

    public function delete(Request $request)
    {
        $carrito = Carrito::findOrFail($request->id);
        $carrito->delete();
        return back();
    }

    public function destroy()
    {
        $user = Auth::user();
        Carrito::where('user_id', $user->id)->delete();
        return back();

        // return redirect()->route('users.carrito.index');
    }

    public function checkout(Request $request)
    {

        $user = Auth::user();
        
        $direccion = Direccion::where('user_id', $user->id)->first();
        $carrito = Carrito::where('user_id', $user->id)->with('producto')->get();
        // $productoIds = $carrito->pluck('producto_id')->toArray();
        // dd($productoIds);
        


        // Verificar si el usuario tiene una dirección
        if (!$direccion) {
            return back()->with('error', 'Por favor, añade una dirección antes de realizar la compra.');
        }

        // Verificar si el carrito está vacío
        if ($carrito->isEmpty()) {
            return back()->with('error', 'El carrito está vacío.');
        }

        $totalCarrito = 0;
        foreach ($carrito as $item) {
            $totalCarrito += $item->producto->precio * $item->cantidad;
        }

        // Pasar los elementos del carrito a la tabla de pedidos
        foreach ($carrito as $item) {
            // dd($item->producto_id);
            $pedido = new Pedido([
                'user_id' => $user->id,
                'producto_id' => $item->producto_id,
                // dd($item->producto_id),
                'direccion_id' => $direccion->id,
                'estado' => 'pendiente',
                // 'total' => $totalCarrito,
                'total' => $item->producto->precio * $item->cantidad,
            ]);
            // dd($pedido);
            $pedido->save();

        }

        // Después del checkout, vaciar el carrito
        Carrito::where('user_id', $user->id)->delete();
        //elimar el carrito de la base de datos
        // $carrito->delete();


        return back()->with('success', 'Compra realizada con éxito.');
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
        // $direccion = Direccion::find($request->id);

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
                // 'direccion_id' => $direccion->id,
            ]);

            $carritoItem->save();
        }

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }
}
