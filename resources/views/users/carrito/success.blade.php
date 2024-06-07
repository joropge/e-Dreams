<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Muchas Gracias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 flex items-center justify-between">
                    <div class="text-2xl pt-6">
                        {{ __('Compra Exitosa') }}
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-xl font-semibold">
                        {{ __('Muchas Gracias '.  $customer .  ', su compra se ha realizado con éxito') }}
                    </div>
                    <div class="mt-4">
                        <p>{{ __('El pedido le llegará de 2 a 7 días laborables.') }}</p>
                    </div>
                    <div class="flex items-center justify-end mt-4 w-20 ml-auto">
                        <a href="{{ route('dashboard') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</x-app-layout>
