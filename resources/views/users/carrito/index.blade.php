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
                                    {{ __('Producto') }}
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
                            @foreach ($carritos as $carrito)
                                @php
                                    $producto = $carrito->producto;

                                    $rutaCompleta = $producto->imagen;
                                    $nombreArchivo = basename($rutaCompleta);
                                    $rutaDeseada = '';

                                    if ($producto->categoria_id == 1) {
                                        $rutaDeseada = 'camisetas/' . $nombreArchivo;
                                    } elseif ($producto->categoria_id == 2) {
                                        $rutaDeseada = 'sudaderas/' . $nombreArchivo;
                                    } elseif ($producto->categoria_id == 3) {
                                        $rutaDeseada = 'pantalones/' . $nombreArchivo;
                                    }
                                @endphp
                                <tr>
                                    <td
                                        class="flex items-center gap-2 px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="w-20 h-20 overflow-hidden rounded-2xl">
                                            <img src="{{ Storage::url('public/' . $rutaDeseada) }}"
                                                alt="{{ $producto->nombre }}" class="object-cover w-full h-full">
                                        </div>
                                        <div class="text-sm leading-5 text-blue-900">{{ $producto->nombre }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        {{ $producto->precio }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        <div class="relative">
                                            <input type="number" name="cantidad" value="{{ $carrito->cantidad }}"
                                                min="0"
                                                class="w-16 text-center appearance-none border rounded-md py-1 px-3 bg-gray-100"
                                                oninput="this.value = Math.max(this.value, 0)"
                                                onchange="updateCantidad({{ $carrito->id }}, this.value)">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        {{ $producto->precio * $carrito->cantidad }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        <form action="{{ route('carrito.delete') }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $carrito->id }}">
                                            <button type="submit" class="text-red-400 hover:text-red-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
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
                            <a href="{{ route('carrito.destroy') }}"
                                class="text-red-400 hover:text-red-600">{{ __('Borrar todo el carrito') }}</a>
                        </div>
                        <form action="{{ route('carrito.checkout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">{{ __('Checkout') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        function updateCantidad(id, cantidad) {
            console.log(id, cantidad);
            fetch(`{{ url('/user/carrito') }}/${id}`, {
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
                        console.log(cantidad);
                        location.reload();
                    } else {
                        console.error('Failed to update quantity');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</x-app-layout>
