<!-- resources/views/product/checkout-cancel.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedido Cancelado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 flex items-center justify-between">
                    <div class="text-2xl pt-6">
                        {{ __('Pedido Cancelado') }}
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-xl font-semibold">
                        {{ __('Su pedido ha sido cancelado') }}
                    </div>
                    <div class="mt-4">
                        <p>{{ __('Lamentamos que no haya podido completar su compra. Si tiene alguna duda, por favor contacte con nuestro servicio de atención al cliente.') }}
                        </p>
                    </div>
                    <div class="flex items-center justify-end mt-4 w-20 ml-auto">
                        <a href="{{ route('carrito.index') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</x-app-layout>
