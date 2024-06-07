<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Dirección') }}
        </h2>
    </x-slot>

    <div class="mt-12">
        @include('productos.partials.msg')
        <form action="{{ route('direcciones.update', $direcciones->id) }}" method="POST" class="max-w-md mx-auto">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="calle" class="block text-gray-700 text-sm font-bold mb-2">Calle<span class="text-red-500">*</span></label>
                    <input type="text" name="calle" id="calle" value="{{ ucfirst(strtolower($direcciones->calle)) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="numero" class="block text-gray-700 text-sm font-bold mb-2">Número<span class="text-red-500">*</span></label>
                    <input type="number" name="numero" id="numero" value="{{ ucfirst(strtolower($direcciones->numero)) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="piso" class="block text-gray-700 text-sm font-bold mb-2">Piso</label>
                    <input type="number" name="piso" id="piso" value="{{ ucfirst(strtolower($direcciones->piso)) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="puerta" class="block text-gray-700 text-sm font-bold mb-2">Puerta</label>
                    <input type="text" name="puerta" id="puerta" value="{{ ucfirst(strtolower($direcciones->puerta)) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" oninput="this.value = this.value.slice(0, 2).toUpperCase()">
                </div>
                <div>
                    <label for="codigo_postal" class="block text-gray-700 text-sm font-bold mb-2">Código Postal<span class="text-red-500">*</span></label>
                    <input type="text" name="codigo_postal" id="codigo_postal" value="{{ ucfirst(strtolower($direcciones->codigo_postal)) }}" required maxlength="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="ciudad" class="block text-gray-700 text-sm font-bold mb-2">Ciudad<span class="text-red-500">*</span></label>
                    <input type="text" name="ciudad" id="ciudad" value="{{ ucfirst(strtolower($direcciones->ciudad)) }}"  required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="provincia" class="block text-gray-700 text-sm font-bold mb-2">Provincia<span class="text-red-500">*</span></label>
                    <input type="text" name="provincia" id="provincia" value="{{ ucfirst(strtolower($direcciones->provincia)) }}"  required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="pais" class="block text-gray-700 text-sm font-bold mb-2">País<span class="text-red-500">*</span></label>
                    <input type="text" name="pais" id="pais" value="{{ ucfirst(strtolower($direcciones->pais)) }}"  required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="flex items-center justify-center mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Confirmar Edicion
                </button>
            </div>
            {{-- boton para volver --}}
            <div class="flex items-center justify-center mt-4">
                <a href="{{ route('direcciones.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
    
    @include('layouts.footer')

</x-app-layout>