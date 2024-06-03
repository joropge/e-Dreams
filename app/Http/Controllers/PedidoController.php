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
        $user = Auth::user();
        $pedidos = Pedido::where('user_id', $user->id)->with('productos')->get();

        return view('users.pedidos.index', compact('pedidos'));
    }

public function create(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|integer',
        'producto_id' => 'required|integer',
        'direccion_id' => 'required|integer',
        'cantidad' => 'required|integer',
        'total' => 'required|numeric',
        'estado' => 'required|string',
        'nombreProducto' => 'required|string',
    ]);

    Pedido::create($validatedData);

    return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');
}

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'nullable|exists:users,id',
                'direccion_id' => 'nullable|exists:direcciones,id',
                'total' => 'required|numeric',
                'estado' => 'required|in:pendiente,enviado,entregado,cancelado'

            ]);

            $pedido = Pedido::create($validated);
            return view(
                '/users/pedidos.index',
                [
                    'pedidos' => Pedido::all()
                ]
            );
        } catch (\Exception $e) {
            return redirect()->route('pedidos.create')->withInput()->withErrors($e->getMessage());
        }
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

    //No se usa
    public function edit(Pedido $pedido)
    {
        return view('/users/pedidos.edit', [
            'pedido' => $pedido,
            'pedidos' => Pedido::all()
        ]);
    }

    public function update(Request $request, Pedido $pedido)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'nullable|exists:users,id',
                'direccion_id' => 'nullable|exists:direcciones,id',
                'producto_id' => 'nullable|exists:productos,id',
                'carrito_id' => 'nullable|exists:carritos,id',
                'total' => 'required|numeric',
                'estado' => 'required|in:pendiente,enviado,entregado,cancelado'
            ]);

            if ($request->hasFile('picture')) {
                $validated['picture'] = $request->file('picture')->store('public/photos');

                if ($pedido->picture) {
                    Storage::delete($pedido->picture);
                }
            }

            $pedido->update($validated);
            return redirect()->route('/users/pedidos.show', $pedido)->with('success', 'Pedido actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('/users/pedidos.edit', $pedido)->withInput()->withErrors($e->getMessage());
        }
    }
    

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('users.pedidos.index')->with('success', 'Pedido eliminado correctamente');
    }

    //No se usa
    public function myIndex()
    {
        $user = auth()->user();
        return view(
            'pedidos.myIndex',
            ['pedidos' => $user->pedidos]
        );
    }

    public function getProductIdsByUser($userId)
    {
        // Obtengo todos los pedidos del usuario especificado

        $pedidos = Pedido::where('user_id', $userId)->with('productos')->get();
        $productIds = $pedidos->pluck('productos.*.id')->flatten()->unique();

        // Pasar los ids de productos a una vista
        return view('users.pedidos.index', ['pedidos' => $pedidos, 'productIds' => $productIds]);
    }

    public function getUserProducts($userId)
    {
        $userProducts = Pedido::select('user_id', 'producto_id', DB::raw('COUNT(*) as cantidad'))
            ->where('user_id', $userId)
            ->groupBy('user_id', 'producto_id')
            ->having('cantidad', '>', 1)
            ->get();

        return $userProducts;
    }

}
