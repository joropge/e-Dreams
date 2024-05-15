@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($camisetas as $camiseta)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ $camiseta->image }}" class="card-img-top" alt="T-Shirt Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $camiseta->name }}</h5>
                    <p class="card-text">{{ $camiseta->description }}</p>
                    <a href="{{ route('camisetas.purchase', $camiseta->id) }}" class="btn btn-primary">Buy Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection