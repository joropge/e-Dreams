<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Direccion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Auth\Events\Validated;


class PedidoController extends Controller
{
    public function index(): View
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login');
            }
            $pedidos = Pedido::where('user_id', $user->id)->with('productos')->get();

            return view('users.pedidos.index', compact('pedidos'));
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Ha ocurrido un error. Por favor, intente nuevamente.');
        }
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'producto_id' => 'required|integer',
            'direccion_id' => 'required|integer',
            // 'cantidad' => 'required|integer',
            'total' => 'required|numeric',
            'estado' => 'required|string',
            'nombreProducto' => 'required|string',
        ]);

        Pedido::create($validatedData);

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');
    }


    public function show(Pedido $pedido): View
    {
        $pedido = Pedido::where('id', $pedido->id)->with('productos')->first();
        $productos = Producto::where('id', $pedido->producto_id)->first();

        return view(
            'users.pedidos.show',
            [
                'pedido' => $pedido,
                'productos' => $productos,
            ]
        );
    }

    // public function getProductIdsByUser($userId)
    // {
    //     // Obtengo todos los pedidos del usuario especificado

    //     $pedidos = Pedido::where('user_id', $userId)->with('productos')->get();
    //     $productIds = $pedidos->pluck('productos.*.id')->flatten()->unique();

    //     // Pasar los ids de productos a una vista
    //     return view('users.pedidos.index', ['pedidos' => $pedidos, 'productIds' => $productIds]);
    // }

    // public function getUserProducts($userId)
    // {
    //     $userProducts = Pedido::select('user_id', 'producto_id', DB::raw('COUNT(*) as cantidad'))
    //         ->where('user_id', $userId)
    //         ->groupBy('user_id', 'producto_id')
    //         ->having('cantidad', '>', 1)
    //         ->get();

    //     return $userProducts;
    // }
}
