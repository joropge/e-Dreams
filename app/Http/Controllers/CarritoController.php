<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return view('/users/carrito.index', ['carritos' => Carrito::all()]);
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
        return redirect()->route('carritos.index')->with('success', 'Carrito eliminado correctamente');
    }
}
