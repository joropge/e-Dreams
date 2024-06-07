<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pantalones') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @include('productos.partials.msg')
        @foreach ($productos as $pantalon)
            @php
                // Obtener solo el nombre del archivo de la ruta completa
                $rutaCompleta = $pantalon->imagen;
                $nombreImg = basename(str_replace('\\', '/', $rutaCompleta));
            @endphp
            <div class="w-full p-3 bg-white shadow-md flex flex-col h-full">
                <div>
                    <img src="{{ Storage::url('pantalones/' . $nombreImg) }}" alt="{{ $pantalon->nombre }}"
                        class="w-full h-48 sm:h-64 md:h-80 lg:h-96 object-cover">
                </div>
                <div class="flex flex-col flex-grow items-start justify-between gap-3 pt-3">
                    <div class="card-body w-full">
                        <h3 class="text-lg font-semibold">{{ $pantalon->nombre }}</h3>
                        <h2 class="text-black-500">Talla: {{ $pantalon->talla }}</h2>
                        <p class="text-gray-500">{{ $pantalon->descripcion }}</p>
                        <p class="text-gray-500">{{ $pantalon->precio }} €</p>
                    </div>
                    <div class="w-full flex justify-start">
                        <form action="{{ route('carrito.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $pantalon->id }}">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 cursor-pointer flex items-center">
                                <span class="mr-2">Añadir</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @include('layouts.footer')
</x-app-layout>
