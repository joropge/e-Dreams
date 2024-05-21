<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sudaderas') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-3 gap-4">
        @foreach($productos as $sudadera)
            <div class="p-4 bg-white shadow-md">
                <img src="{{ Storage::url('sudaderas/' . $sudadera->imagen) }}" alt="{{ $sudadera->nombre }}" class="card-img-top">
                <div class="card-body">
                    <h3 class="text-lg font-semibold">{{ $sudadera->nombre }}</h3>
                    <p class="text-gray-500">{{ $sudadera->descripcion }}</p>
                    <p class="text-gray-500">{{ $sudadera->precio }} €</p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>