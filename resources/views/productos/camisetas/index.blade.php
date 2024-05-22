<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Camisetas') }}
        </h2>
    </x-slot>


    <div class="grid grid-cols-3 gap-4">
        @include('productos.partials.msg')
        @foreach($productos as $camiseta)
            <div class="p-4 bg-white shadow-md">
                {{-- <img src="{{ Storage::url('camisetas/' . $camiseta->imagen) }}" alt="{{ $camiseta->nombre }}" class="card-img-top"> --}}
                <img src="{{ Storage::url('camisetas/camiseta3.jpg') }}" alt="{{ $camiseta->nombre }}" class="card-img-top">
                <div class="card-body">
                    <h3 class="text-lg font-semibold">{{ $camiseta->nombre }}</h3>
                    <p class="text-gray-500">{{ $camiseta->descripcion }}</p>
                    <p class="text-gray-500">{{ $camiseta->precio }} €</p>
                </div>
                <form action="{{route('carrito.add')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$camiseta->id}}">
                    <input type="submit" value="Añadir" class="px-4 py-2 bg-blue-500 text-black rounded-md hover:bg-blue-600">
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>