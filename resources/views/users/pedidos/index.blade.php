<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-2xl">
                        {{ __('Pedidos') }}
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-end mt-4">
                    </div>
                    <table class="min-w-full">
                        <thead>

                            <tr>

                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Productos') }}</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Total') }}</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    {{ __('Estado') }}</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                                @if ($pedido->user_id == Auth::user()->id)
                                    <tr>
                                        <td
                                            class="nameSearch px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                            @if ($pedido->producto)
                                                {{ $pedido->producto->nombre }}
                                            @else
                                                Producto no encontrado
                                            @endif
                                        </td>
                                        <td
                                            class="nameSearch px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                            {{ $pedido->total }}€</td>
                                        <td
                                            class="nameSearch px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                            {{ $pedido->estado }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                            {{-- ruta a show --}}
                                            <a href="{{ route('pedidos.show', $pedido->id) }}"
                                                class="text-blue-400 hover:text-blue-600">{{ __('Ver') }}</a>
                                            {{-- ruta a create --}}
                                            <a href="{{ route('pedidos.edit', $pedido->id) }}"
                                                class="text-blue-400 hover:text-blue-600">{{ __('Editar') }}</a>
                                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-400 hover:text-red-600">{{ __('Eliminar') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- script para la barra de búsqueda dinámica --}}

    <script src="{{ asset('/js/dynamicSearch.js') }}"></script>

</x-app-layout>
