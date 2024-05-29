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
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 overflow-x-auto">
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
                                            {{ $pedido->nombreProducto }}
                                        </td>
                                        <td
                                            class="nameSearch px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                            {{ $pedido->total }}€</td>
                                        <td
                                            class="nameSearch px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                            {{ ucfirst($pedido->estado) }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                            <div class="flex space-x-4">
                                                {{-- ruta a show --}}
                                                <a href="{{ route('pedidos.show', $pedido->id) }}"
                                                    class="text-blue-400 hover:text-blue-600"><svg
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </a>
                                                {{-- ruta a create --}}
                                                {{-- <a href="{{ route('pedidos.edit', $pedido->id) }}"
                                                class="text-blue-400 hover:text-blue-600">{{ __('Editar') }}</a> --}}
                                                @if ($pedido->estado == 'cancelado' || $pedido->estado == 'entregado')
                                                    <form action="{{ route('pedidos.destroy', $pedido->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-400 hover:text-red-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
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
    {{-- <script src="{{ asset('/js/dynamicSearch.js') }}"></script> --}}
    @include('layouts.footer')
</x-app-layout>
