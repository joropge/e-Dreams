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
use Illuminate\Support\Facades\Storage;


class PedidoController extends Controller
{

    public function index(): View
    {
        // $pedidos = Pedido::all();
        // return response()->json($pedidos);

        return view('/users/pedidos.index',
            ['pedidos' => Pedido::all()]);
    }

    public function create()
    {
        return view('/users/pedidos.create',
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
            return view('/users/pedidos.index',
            ['pedidos' => Pedido::all()
        ]);}
        
        catch(\Exception $e){
            return redirect()->route('pedidos.create')->withInput()->withErrors($e->getMessage());
        }

    }

    public function show(Pedido $pedido): View
    {
        return view('/users/pedidos.show',
            ['pedido' => $pedido]);
    }

    public function edit(Pedido $pedido)
    {
        return view('/users/pedidos.edit', [
            'pedido' => $pedido,
            'pedidos' => Pedido::all()
        ]);
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

            if ($request->hasFile('picture')) {
                $validated['picture'] = $request->file('picture')->store('public/photos');
    
                if ($pedido->picture) {
                    Storage::delete($pedido->picture);
                }
            }

            $pedido->update($validated);
            return redirect()->route('/users/pedidos.show', $pedido)->with('success', 'Pedido actualizado correctamente');

        }
        catch(\Exception $e){
            return redirect()->route('/users/pedidos.edit', $pedido)->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('/users/pedidos.index')->with('success', 'Pedido eliminado correctamente');
    }
    

    public function myIndex(){
        $user = auth()->user();
        return view('pedidos.myIndex',
        ['pedidos' => $user->pedidos]);
    }

}
