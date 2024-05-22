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
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Nombre') }}</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Imagen') }}</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Precio') }}</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Cantidad') }}</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Total') }}</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carrito as $id => $producto)
                                @php
                                    // Obtener solo la parte de la ruta después de la tercera barra invertida
                                    $rutaCompleta = $producto['imagen'];
                                    $partes = explode('\\', $rutaCompleta);
                                    $rutaDeseada = implode('/', array_slice($partes, 3));
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-blue-900">{{ $producto['nombre'] }}</div>
                                    </td>
                                    {{-- imagen --}}

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        <img src="{{ Storage::url('public/' . $rutaDeseada) }}"
                                            alt="{{ $producto['nombre'] }}" class="w-16 h-16 object-cover">
                                    </td>


                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        {{ $producto['precio'] }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        {{ $producto['cantidad'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        {{ $producto['precio'] * $producto['cantidad'] }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        <form action="{{ route('carrito.delete') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-400 hover:text-red-600">{{ __('Eliminar') }}</button>
                                            {{-- <button type="submit"
                                                class="text-red-400 hover:text-red-600">{{ __('Eliminar') }}</button> --}}
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex items-center mt-4">
                        <div class="w-1/2">
                            <form action="{{ route('carrito.destroy') }}" method="POST" class="inline"></form>
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-400 hover:text-red-600">{{ __('Borrar carrito') }}</button>
                            </form>
                        </div>
                        <div class="w-1/2">
                            <a href="{{ route('carrito.checkout') }}" class="btn btn-primary">{{ __('Checkout') }}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
