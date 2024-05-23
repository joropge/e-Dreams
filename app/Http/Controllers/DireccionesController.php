<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DireccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('/users/direcciones.index', ['direcciones' => Direccion::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Aquí puedes retornar la vista para crear una nueva dirección
        return view('/users/direcciones.create')->with('success', 'Dirección creada correctamente');
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

        return view('/users/direcciones.index', ['direcciones' => Direccion::all()]);
    }

    /**
     * Display the specified resource.
     */

    //NO SE USA
    public function show(Direccion $direccion): View
    {
        return view('/users/direcciones.show', ['direccion' => $direccion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Direccion $direcciones)
    {
        return view('/users/direcciones.edit', [
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

        // if ($request->hasFile('picture')) {
        //     $validated['picture'] = $request->file('picture')->store('public/photos');

        //     if ($direcciones->picture) {
        //         Storage::delete($direcciones->picture);
        //     }
        // }

        $direcciones->update($validated);

        return back()->with('success', 'Dirección actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direccion $direcciones)
    {
        $direcciones->delete();
        return redirect()->route('direcciones.index')->with('success', 'Dirección eliminada correctamente');
    }

    // private function applyFilters(Request $request, Builder $query): Builder
    // {
    //     if ($request->filled('search')) {
    //         $query->where('estado', 'like', '%' . $request->get('search') . '%');
    //     }

    //     //usuario
    //     if ($request->filled('user')) {
    //         $query->where('user_id', $request->get('user'));
    //     }

    //     //provincia
    //     if ($request->filled('provincia')) {
    //         $query->where('provincia', $request->get('provincia'));
    //     }

    //     return $query;
    // }


    // public function myIndex(){
    //     $user = auth()->user();
    //     return view('/admin/direciones.myIndex',
    //     ['direciones' => $user->direcciones]);
    // }
}
