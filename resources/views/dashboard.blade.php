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
                $productos = App\Models\Producto::all();
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
                                    <input type="hidden" name="cantidad" value="1">
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 cursor-pointer float-right flex items-center">
                                        <span class="mr-2">Añadir</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>
                                    </button>
                                </form>
                                @if ($producto->categoria_id === 1)
                                    <a href="{{ route('camisetas.index', $producto) }}" class="text-blue-500">Ver
                                        más</a>
                                @elseif ($producto->categoria_id === 2)
                                    <a href="{{ route('sudaderas.index', $producto) }}" class="text-blue-500">Ver
                                        más</a>
                                @elseif ($producto->categoria_id === 3)
                                    <a href="{{ route('pantalones.index', $producto) }}" class="text-blue-500">Ver
                                        más</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

</x-app-layout>
