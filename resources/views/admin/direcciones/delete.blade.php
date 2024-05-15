<x-app-layout>
    {{-- eliminar una direccion --}}
    <form action="{{ route('direcciones.destroy', $direccion->id) }}" method="POST" class="max-w-md mx-auto">
        @csrf
        @method('DELETE')
        <div class="mb-4">
            <p class="block text-gray-700 text-sm font-bold mb-2">¿Estás seguro de que quieres eliminar esta dirección?</p>
            <p class="block text-gray-700 text-sm font-bold mb-2">{{ $direccion->calle }}</p>
            <p class="block text-gray-700 text-sm font-bold mb-2">{{ $direccion->numero }}</p>
            <p class="block text-gray-700 text-sm font-bold mb-2">{{ $direccion->piso }}</p>
            <p class="block text-gray-700 text-sm font-bold mb-2">{{ $direccion->puerta }}</p>
            <p class="block text-gray-700 text-sm font-bold mb-2">{{ $direccion->codigo_postal }}</p>
            <p class="block text-gray-700 text-sm font-bold mb-2">{{ $direccion->ciudad }}</p>
            <p class="block text-gray-700 text-sm font-bold mb-2">{{ $direccion->provincia }}</p>
            <p class="block text-gray-700 text-sm font-bold mb-2">{{ $direccion->pais }}</p>
        </div>
        <div class="flex items-center justify-center">
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Eliminar Dirección
            </button>
        </div>
    </form>
    
</x-app-layout>