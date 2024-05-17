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
                {{-- barra de búsqueda dinámica funcional con js--}}
                <!-- Search input field -->
                <h1 class="text-xl font-semibold mb-4">Dynamic Search</h1>
                <input type="text" id="search" class="w-full border-2 border-gray-300 bg-white" placeholder="Search">
                <div class="flex items-center justify-end mt-4">                </div>
            </div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="flex items-center justify-end mt-4">
                </div>
                <table class="min-w-full">
                    <thead>
                        {{-- 'user_id', 'total', --}}
                        <tr>
                                
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">{{ __('Id') }}</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">{{ __('Usuario Id') }}</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">{{ __('Total') }}</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300"></th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carritos as $carrito)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                    <div class="text-sm leading-5 text-blue-900">{{ $carrito->id }}</div>
                                    {{-- <div class="text-sm leading-5 text-gray-900">{{ $carrito->user_id}}</div> --}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{ $carrito->user_id }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{ $carrito->total }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                    {{-- ruta a show --}}
                                    <a href="{{ route('carrito.show', $carrito->id) }}" class="text-blue-400 hover:text-blue-600">{{ __('Ver') }}</a>
                                    {{-- ruta a create --}}
                                    <a href="{{ route('carrito.edit', $carrito->id) }}" class="text-blue-400 hover:text-blue-600">{{ __('Editar') }}</a>
                                    <form action="{{ route('carrito.destroy', $carrito->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600">{{ __('Eliminar') }}</button>
                                    </form>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex items-center justify-end mt-4"></div>                
                </div>
        </div>
    </div>
</div>
</x-app-layout>