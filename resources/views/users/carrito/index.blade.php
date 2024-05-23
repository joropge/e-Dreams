<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carrito') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-2xl">
                        {{ __('Carrito') }}
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Nombre') }}
                                </th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Categoria') }}
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Imagen') }}
                                </th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Precio') }}
                                </th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Cantidad') }}
                                </th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Total') }}
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carrito as $id => $producto)
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
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-blue-900">{{ $producto['nombre'] }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        <div class="w-16 h-16 overflow-hidden rounded-full">
                                            <img src="{{ Storage::url('public/' . $rutaDeseada) }}"
                                                alt="{{ $producto['nombre'] }}" class="w-full h-full object-cover">
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        {{ $producto['precio'] }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        <div class="relative">
                                            <input type="number" name="cantidad" value="{{ $producto['cantidad'] }}"
                                                min="0"
                                                class="w-16 text-center appearance-none border rounded-md py-1 px-3 bg-gray-100"
                                                oninput="this.value = Math.max(this.value, 0)"
                                                onchange="updateCantidad({{ $id }}, this.value)">
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        {{ $producto['precio'] * $producto['cantidad'] }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        <form action="{{ route('carrito.delete') }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit"
                                                class="text-red-400 hover:text-red-600">{{ __('Eliminar') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-end mt-4">
                        <div class="text-lg font-semibold">
                            {{ __('Total:') }} {{ $total }} €
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        <div class="w-1/2">
                            {{-- <form action="{{ route('carrito.destroy') }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600">{{ __('Borrar todo el carrito') }}</button>
                            </form> --}}
                            <a href="{{ route('carrito.destroy') }}" class="text-red-400 hover:text-red-600">{{ __('Borrar todo el carrito') }}</a>
                        </div>
                        <form action="{{ route('carrito.checkout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">{{ __('Checkout') }}</button>
                        </form>
                        
                        {{-- <div class="w-1/2">
                            <a href="{{ route('carrito.checkout') }}" class="btn btn-primary">{{ __('Checkout') }}</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{ asset('js/sumProductosCarrito.js') }}"></script> --}}

    <script>
        function updateCantidad(id, cantidad) {
            fetch(`{{ url('users/carrito/') }}/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        cantidad: cantidad
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</x-app-layout>
