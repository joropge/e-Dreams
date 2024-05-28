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
            if ($carrito->cantidad === 0) {
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
