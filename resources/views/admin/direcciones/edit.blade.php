{{-- editar una direcciones con un formulario --}}
<x-app-layout>
    {{-- editar una direcciones con un formulario, los campos son:
        'user_id',
        'calle',
        'numero',
        'piso',
        'puerta',
        'codigo_postal',
        'ciudad',
        'provincia',
        'pais', --}}

    <form action="{{ route('direcciones.update', $direcciones->id) }}" method="POST" class="max-w-md mx-auto">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="calle" class="block text-gray-700 text-sm font-bold mb-2">Calle</label>
            <input type="text" name="calle" id="calle" value="{{ $direcciones->calle }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="numero" class="block text-gray-700 text-sm font-bold mb-2">Número</label>
            <input type="text" name="numero" id="numero" value="{{ $direcciones->numero }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="piso" class="block text-gray-700 text-sm font-bold mb-2">Piso</label>
            <input type="text" name="piso" id="piso" value="{{ $direcciones->piso }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="puerta" class="block text-gray-700 text-sm font-bold mb-2">Puerta</label>
            <input type="text" name="puerta" id="puerta" value="{{ $direcciones->puerta }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="codigo_postal" class="block text-gray-700 text-sm font-bold mb-2">Código Postal</label>
            <input type="text" name="codigo_postal" id="codigo_postal" value="{{ $direcciones->codigo_postal }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="ciudad" class="block text-gray-700 text-sm font-bold mb-2">Ciudad</label>
            <input type="text" name="ciudad" id="ciudad" value="{{ $direcciones->ciudad }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="provincia" class="block text-gray-700 text-sm font-bold mb-2">Provincia</label>
            <input type="text" name="provincia" id="provincia" value="{{ $direcciones->provincia }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="pais" class="block text-gray-700 text-sm font-bold mb-2">País</label>
            <input type="text" name="pais" id="pais" value="{{ $direcciones->pais }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Editar Dirección
            </button>
        </div>
    </form>
    
        
</x-app-layout>