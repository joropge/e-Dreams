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
                    @php
                        // Obtener solo la parte de la ruta después de la tercera barra invertida
                        $rutaCompleta = $producto->imagen;
                        $partes = explode('\\', $rutaCompleta);
                        $rutaDeseada = implode('/', array_slice($partes, 3));
                    @endphp
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <img src="{{ Storage::url('public/' . $rutaDeseada) }}" alt="{{ $producto->nombre }}"
                            class="w-full h-auto object-cover">
                        {{-- <img src="{{ Storage::url('public/camisetas/camiseta1.jpg') }}" alt="{{ $producto->nombre }}"> --}}
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-xl font-bold">{{ $producto->nombre }}</h2>
                            <p class="text-gray-500">{{ $producto->descripcion }}</p>
                            <p class="text-gray-500">{{ $producto->precio }} €</p>
                            <form action="{{ route('carrito.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $producto->id }}">
                                <input type="submit" value="Añadir"
                                    class="px-4 py-2 bg-blue-500 text-black rounded-md hover:bg-blue-600">
                            </form>
                            @if ($producto->categoria_id === 1)
                                <a href="{{ route('camisetas.index', $producto) }}" class="text-blue-500">Ver más</a>
                            @elseif ($producto->categoria_id === 2)
                                <a href="{{ route('sudaderas.index', $producto) }}" class="text-blue-500">Ver más</a>
                            @elseif ($producto->categoria_id === 3)
                                <a href="{{ route('pantalones.index', $producto) }}" class="text-blue-500">Ver más</a>
                            @endif
                            {{-- <a href="{{ route('camisetas.index', $producto) }}" class="text-blue-500">Ver más</a> --}}
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

</x-app-layout>
