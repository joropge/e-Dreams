<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pantalones') }}
            </h2>
        </x-slot>
    
        <div class="grid grid-cols-3 gap-4">
            @foreach($productos as $pantalon)
                <div class="p-4 bg-white shadow-md">
                    <img src="{{ Storage::url('pantalones/' . $pantalon->imagen) }}" alt="{{ $pantalon->nombre }}" class="card-img-top">
                    <div class="card-body">
                        <h3 class="text-lg font-semibold">{{ $pantalon->nombre }}</h3>
                        <p class="text-gray-500">{{ $pantalon->descripcion }}</p>
                        <p class="text-gray-500">{{ $pantalon->precio }} €</p>
                    </div>
                </div>
            @endforeach
        </div>
    </x-app-layout>
</div>
