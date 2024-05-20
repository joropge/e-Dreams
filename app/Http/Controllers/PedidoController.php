<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use App\Models\Direccion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Auth\Events\Validated;


class PedidoController extends Controller
{

    public function index(): View
    {
        // $pedidos = Pedido::all();
        // return response()->json($pedidos);

        return view('pedidos.view',
            ['pedidos' => Pedido::all()]);
    }

    public function create()
    {
        return view('pedidos.create',
            ['pedidos' => Pedido::all()
        ]);
    }

    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'user_id' => 'nullable|exists:users,id',
                'direccion_id' => 'nullable|exists:direcciones,id',
                'total' => 'required|numeric',
                'estado' => 'required|in:pendiente,enviado,entregado,cancelado'

            ]);

            $pedido = Pedido::create($validated);
            return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');
        }
        catch(\Exception $e){
            return redirect()->route('pedidos.create')->withInput()->withErrors($e->getMessage());
        }

    }

    public function show(Pedido $pedido): View
    {
        $pedido->load('user', 'direccion');
        return view('pedidos.show',
        ['pedido' => $pedido]);
    }

    public function edit(Pedido $pedido)
    {
        return view('pedidos.edit', ['pedido' => $pedido]);
    }

    public function update(Request $request, Pedido $pedido)
    {
        try{
            $validated= $request->validate([
                'user_id' => 'nullable|exists:users,id',
                'direccion_id' => 'nullable|exists:direcciones,id',
                'producto_id' => 'nullable|exists:productos,id',
                'carrito_id' => 'nullable|exists:carritos,id',
                'total' => 'required|numeric',
                'estado' => 'required|in:pendiente,enviado,entregado,cancelado'
            ]);

            $pedido->update($validated);
            return redirect()->route('pedidos.show', $pedido)->with('success', 'Pedido actualizado correctamente');

        }
        catch(\Exception $e){
            return redirect()->route('pedidos.edit', $pedido)->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado correctamente');
    }

    private function applyFilters(Request $request, Builder $query): Builder
    {
        if ($request->filled('search')) {
            $query->where('estado', 'like', '%' . $request->get('search') . '%');
        }

        if ($request->filled('filter')) {
            $query->where('estado', $request->get('filter'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->get('date'));
        }

        if ($request->filled('price')) {
            $query->where('total', $request->get('price'));
        }

        if ($request->filled('user')) {
            $query->where('user_id', $request->get('user'));
        }

        if ($request->filled('direction')) {
            $query->where('direccion_id', $request->get('direction'));
        }

        if ($request->filled('state')) {
            $query->where('estado', $request->get('state'));
        }

        return $query;
    }

    public function search(Request $request)
    {
        $pedidos = $this->applyFilters($request, Pedido::query())->paginate(5);
        return view('pedidos.index', ['pedidos' => $pedidos]);
    }

    public function myIndex(){
        $user = auth()->user();
        return view('pedidos.myIndex',
        ['pedidos' => $user->pedidos]);
    }

}
