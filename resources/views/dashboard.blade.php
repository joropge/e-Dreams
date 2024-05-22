<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página Principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($productos as $producto)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        {{-- <img src="{{ Storage::url('public/' . $camiseta->imagen ) }}" alt="{{ $producto->nombre }}" class="card-img-top"> --}}
                        <img src="{{ Storage::url('public/camisetas/camiseta1.jpg' ) }}" alt="{{ $producto->nombre }}" class="card-img-top">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-xl font-bold">{{ $producto->nombre }}</h2>
                            <p class="text-gray-500">{{ $producto->descripcion }}</p>
                            <p class="text-gray-500">{{ $producto->precio }} €</p>
                            <a href="{{ route('productos.show', $producto) }}" class="text-blue-500">Ver más</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

</x-app-layout>
