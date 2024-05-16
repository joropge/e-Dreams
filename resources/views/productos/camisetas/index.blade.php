
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h1>Camisetas</h1>
                @foreach($productos as $camiseta)
                    <div class="card">
                        <img src="{{ $camiseta->imagen }}" class="card-img-top" alt="{{ $camiseta->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $camiseta->nombre }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>