@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($pantalones as $pantalon)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ $pantalon->image }}" class="card-img-top" alt="pantalon Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $pantalon->name }}</h5>
                    <p class="card-text">{{ $pantalon->description }}</p>
                    <a href="{{ route('pantalon.purchase', $pantalon->id) }}" class="btn btn-primary">Buy Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection