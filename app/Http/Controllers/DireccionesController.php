<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class DireccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('/admin/direcciones.index', ['direcciones' => Direccion::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Aquí puedes retornar la vista para crear una nueva dirección
        return view('/admin/direcciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'calle' => 'required|max:255',
            'numero' => 'required|max:10',
            'piso' => 'nullable|max:10',
            'puerta' => 'nullable|max:10',
            'codigo_postal' => 'required|max:5',
            'ciudad' => 'required|max:255',
            'provincia' => 'required|max:255',
            'pais' => 'required|max:255',
        ]);

        Direccion::create($validated);

        return view('/admin/direcciones.index', ['direcciones' => Direccion::all()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Direccion $direcciones): View
    {
        return view('/admin/direcciones.index', ['direcciones' => $direcciones]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Direccion $direcciones)
    {
        return view('/admin/direcciones.edit', [
            'direcciones' => $direcciones,
            'users' => User::all(),
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Direccion $direcciones)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'calle' => 'required|max:255',
            'numero' => 'required|max:10',
            'piso' => 'nullable|max:10',
            'puerta' => 'nullable|max:10',
            'codigo_postal' => 'required|max:5',
            'ciudad' => 'required|max:255',
            'provincia' => 'required|max:255',
            'pais' => 'required|max:255',
        ]);

        $direcciones->update($validated);

        return redirect()->route('/admin/direcciones.index')->with('success', 'Dirección actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direccion $direcciones)
    {
        $direcciones->delete();
        return redirect()->route('/admin/direcciones.index')->with('success', 'Dirección eliminada correctamente');
    }

    private function applyFilters(Request $request, Builder $query): Builder
    {
        if ($request->filled('search')) {
            $query->where('estado', 'like', '%' . $request->get('search') . '%');
        }

        //usuario
        if ($request->filled('user')) {
            $query->where('user_id', $request->get('user'));
        }

        //provincia
        if ($request->filled('provincia')) {
            $query->where('provincia', $request->get('provincia'));
        }

        return $query;
    }

    public function search(Request $request)
    {
        $direcciones = $this->applyFilters($request, Direccion::query())->paginate(5);
        return view('/admin/direcciones.index', ['direcciones' => $direcciones]);
    }

    public function myIndex(){
        $user = auth()->user();
        return view('/admin/direciones.myIndex',
        ['direciones' => $user->direcciones]);
    }
}
