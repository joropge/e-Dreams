<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sudaderas') }}
        </h2>
    </x-slot>


    <div class="grid grid-cols-3 gap-4">
        @include('productos.partials.msg')
        @foreach ($productos as $sudadera)
            @php
                // Obtener solo el nombre del archivo de la ruta completa
                $rutaCompleta = $sudadera->imagen;
                $nombreImg = basename(str_replace('\\', '/', $rutaCompleta));
            @endphp
            <div class="p-4 bg-white shadow-md">
                <img src="{{ Storage::url('sudaderas/' . $nombreImg) }}" alt="{{ $sudadera->nombre }} "
                class="w-full h-auto object-cover">
                {{-- <img src="{{ Storage::url('sudaderas/sudadera3.jpg') }}" alt="{{ $sudadera->nombre }}" class="w-full h-auto object-cover"> --}}
                <div class="card-body">
                    <h3 class="text-lg font-semibold">{{ $sudadera->nombre }}</h3>
                    <p class="text-gray-500">{{ $sudadera->descripcion }}</p>
                    <p class="text-gray-500">{{ $sudadera->precio }} €</p>
                </div>
                <form action="{{ route('carrito.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $sudadera->id }}">
                    <input type="submit" value="Añadir"
                        class="px-4 py-2 bg-blue-500 text-black rounded-md hover:bg-blue-600">
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>
