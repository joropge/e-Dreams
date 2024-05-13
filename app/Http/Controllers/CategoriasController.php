<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Auth\Events\Validated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('categorias.view', ['categorias' => Categoria::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Aquí puedes retornar la vista para crear una nueva categoría
        return view('categorias.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|max:250',
        ]);

        Categoria::create($validated);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categorias): View
    {
        return view('categorias.show', ['categorias' => $categorias]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categorias)
    {
        return view('categorias.edit', ['categorias' => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categorias)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|max:250',
        ]);

        $categorias->update($validated);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categorias)
    {
        $categorias->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente');
    }

    private function applyFilters(Request $request, Builder $query): Builder
    {
        if ($request->filled('search')) {
            $query->where('estado', 'like', '%' . $request->get('search') . '%');
        }

        //nombre de la categoria
        if ($request->filled('nombre')) {
            $query->where('nombre', $request->get('nombre'));
        }

        return $query;
    }

    public function search(Request $request)
    {
        $categorias = $this->applyFilters($request, Categoria::query())->paginate(5);
        return view('categorias.index', ['categorias' => $categorias]);
    }

    public function myIndex(){
        $user = auth()->user();
        return view('categorias.myIndex',
        ['categorias' => $user->categorias]);
    }
}
