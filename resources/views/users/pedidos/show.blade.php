<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del pedido') }}
        </h2>
    </x-slot>
    @php
        $rutaCompleta = $productos->imagen;
        $nombreArchivo = basename(str_replace('\\', '/', $rutaCompleta));
        $rutaDeseada = '';

        if ($productos->categoria_id == 1) {
            $rutaDeseada = 'camisetas/' . $nombreArchivo;
        } elseif ($productos->categoria_id == 2) {
            $rutaDeseada = 'sudaderas/' . $nombreArchivo;
        } elseif ($productos->categoria_id == 3) {
            $rutaDeseada = 'pantalones/' . $nombreArchivo;
        }
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 flex items-center justify-between">
                    <div class="text-2xl pt-6">
                        {{ __('Detalles del pedido') }}
                    </div>
                    <div class="flex items-center justify-end mt-4 w-20 ml-auto">
                        <a href="{{ route('pedidos.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Volver</a>
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-xl font-semibold">
                        {{ __('Información del Pedido') }}
                    </div>
                    <div class="mt-4">
                        <p><strong>ID de Seguimiento:</strong> {{ $pedido->id }}</p>
                        <p><strong>Estado del Pedido:</strong> {{ ucfirst($pedido->estado) }}</p>
                        <p><strong>Pedido Realizado el Día:</strong> {{ $pedido->created_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="text-xl font-semibold mt-6 flex row-auto">
                        {{ __('Producto') }}
                    </div>
                    <div class="mt-4 p-4 border rounded-lg shadow-sm bg-gray-50">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <img src="{{ Storage::url('public/' . $rutaDeseada) }}" alt="{{ $productos->nombre }}"
                                    class="w-80 h-80 object-cover rounded-lg">
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold pb-2 pt-2">{{ $productos->nombre }}</h3>
                                <p class="pb-2 pt-2"><strong>Precio:</strong> {{ $productos->precio }}€</p>
                                <p class="pb-2 pt-2"><strong>Talla:</strong> {{ $productos->talla ?? 'N/A' }}</p>
                                <p class="pb-2 pt-2"><strong>Color:</strong> {{ $productos->color ?? 'N/A' }}</p>
                                <p class="pb-2 pt-2"><strong>Descripción:</strong> {{ $productos->descripcion }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</x-app-layout>
