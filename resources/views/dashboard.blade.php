<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página Principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @include('productos.partials.msg')

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $randomProductos = $productos->random(9);
                @endphp

                @foreach ($randomProductos as $producto)

                    @php
                        $rutaCompleta = $producto['imagen'];
                        $nombreArchivo = basename($rutaCompleta);
                        $rutaDeseada = '';

                        if ($producto['categoria_id'] == 1) {
                            $rutaDeseada = 'camisetas/' . $nombreArchivo;
                        } elseif ($producto['categoria_id'] == 2) {
                            $rutaDeseada = 'sudaderas/' . $nombreArchivo;
                        } elseif ($producto['categoria_id'] == 3) {
                            $rutaDeseada = 'pantalones/' . $nombreArchivo;
                        }
                    @endphp
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                        <img src="{{ Storage::url('public/' . $rutaDeseada) }}" alt="{{ $producto->nombre }}"
                            class="w-full h-48 object-cover">
                        <div class="p-2 bg-white border-b border-gray-200 h-auto flex flex-col justify-between">
                            <div>
                                <h2 class="text-xl font-bold">{{ $producto->nombre }}</h2>
                                <p class="text-gray-500">{{ $producto->descripcion }}</p>
                                <p class="text-gray-500">{{ $producto->precio }} €</p>
                            </div>
                            <div class="flex justify-between items-end mt-4">
                                <form action="{{ route('carrito.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $producto->id }}">
                                    <input type="submit" value="Añadir"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 cursor-pointer" />
                                </form>
                                @if ($producto->categoria_id === 1)
                                    <a href="{{ route('camisetas.index', $producto) }}" class="text-blue-500">Ver más</a>
                                @elseif ($producto->categoria_id === 2)
                                    <a href="{{ route('sudaderas.index', $producto) }}" class="text-blue-500">Ver más</a>
                                @elseif ($producto->categoria_id === 3)
                                    <a href="{{ route('pantalones.index', $producto) }}" class="text-blue-500">Ver más</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                @endforeach
            </div>

        </div>
    </div>

</x-app-layout>
