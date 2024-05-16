<x-app-layout>
    <div class="container">
        <h1>Detalles del Carrito</h1>
        <p>Id: {{ $carrito->id }}</p>
        <p>Usuario Id: {{ $carrito->user_id }}</p>
        <p>Total: {{ $carrito->total }}</p>
        <a href="{{ route('carrito.index') }}">Volver</a>
    </div>
</x-app-layout>