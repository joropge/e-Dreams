{{-- recoger la informacion de una direcciones en específico por su id y visualizar los datos --}}
<x-app-layout>
<div class="container">
    <h1>Detalles de la Dirección</h1>
    <p>Usuario Id: {{ $direccion->user_id }}</p>
    <p>Calle: {{ $direccion->calle }}</p>
    <p>Número: {{ $direccion->numero }}</p>
    <p>Piso: {{ $direccion->piso }}</p>
    <p>Puerta: {{ $direccion->puerta }}</p>
    <p>Código Postal: {{ $direccion->codigo_postal }}</p>
    <p>Ciudad: {{ $direccion->ciudad }}</p>
    <p>Provincia: {{ $direccion->provincia }}</p>
    <p>País: {{ $direccion->pais }}</p>
    <a href="{{ route('direcciones.index') }}">Volver</a>
</div>
</x-app-layout>
{{-- <x-app-layout>
    @foreach ($direcciones as $direccion)
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('direcciones.edit', $direccion->id) }}" class="px-4 py-2 bg-blue-500 text-black rounded-md hover:bg-blue-600">{{ __('Editar') }}</a>
        </div>
    </div>
@endforeach
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="flex items
            -center justify-end mt-4">
                <a href="{{ route('direcciones.edit', $direcciones->id) }}" class="px-4 py-2 bg-blue-500 text-black rounded-md hover:bg-blue-600">{{ __('Editar') }}</a>
            </div>
        </div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="flex items
            -center justify-end mt-4">
                <form action="{{ route('direcciones.destroy', $direcciones->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-black rounded-md hover:bg-red-600">{{ __('Eliminar') }}</button>
                </form>
            </div>
        </div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="text-2xl">
                {{ __('Dirección') }}
            </div>
            <div class="mt-4">
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ __('Usuario Id') }}</p>
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ $direcciones->user_id }}</p>
            </div>
            <div class="mt-4">
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ __('Calle') }}</p>
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ $direcciones->calle }}</p>
            </div>
            <div class="mt-4">
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ __('Número') }}</p>
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ $direcciones->numero }}</p>
            </div>
            <div class="mt-4">
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ __('Piso') }}</p>
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ $direcciones->piso }}</p>
            </div>
            <div class="mt-4">
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ __('Puerta') }}</p>
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ $direcciones->puerta }}</p>
            </div>
            <div class="mt-4">
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ __('Código Postal') }}</p>
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ $direcciones->codigo_postal }}</p>
            </div>
            <div class="mt-4">
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ __('Ciudad') }}</p>
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ $direcciones->ciudad }}</p>
            </div>
            <div class="mt-4">
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ __('Provincia') }}</p>
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ $direcciones->provincia }}</p>
            </div>
            <div class="mt-4">
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ __('País') }}</p>
                <p class="block text
                -gray-700 text-sm font-bold mb-2">{{ $direcciones->pais }}</p>
            </div>
        </div>
    </div>
</x-app-layout> --}}







