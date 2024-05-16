{{-- crear un formulario para crear una direccion --}}
<x-app-layout>
<form action="{{ route('direcciones.store') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto p-10">
    @csrf
        <div class="mb-4">

            <label for="calle" class="block text-gray-700 text-sm font-bold mb-2" required>Calle</label>
            <input type="text" name="calle" id="calle" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="numero" class="block text-gray-700 text-sm font-bold mb-2" required>Número</label>
            <input type="text" name="numero" id="numero" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="piso" class="block text-gray-700 text-sm font-bold mb-2" required>Piso</label>
            <input type="text" name="piso" id="piso" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="puerta" class="block text-gray-700 text-sm font-bold mb-2">Puerta</label>
            <input type="text" name="puerta" id="puerta" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="codigo_postal" class="block text-gray-700 text-sm font-bold mb-2" required>Código Postal</label>
            <input type="text" name="codigo_postal" id="codigo_postal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="ciudad" class="block text-gray-700 text-sm font-bold mb-2" required>Ciudad</label>
            <input type="text" name="ciudad" id="ciudad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="provincia" class="block text-gray-700 text-sm font-bold mb-2" required>Provincia</label>
            <input type="text" name="provincia" id="provincia" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="pais" class="block text-gray-700 text-sm font-bold mb-2" required>País</label>
            <input type="text" name="pais" id="pais" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-center">
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-black rounded-md hover:bg-blue-600">Create</button>
    </form>
</x-app-layout>