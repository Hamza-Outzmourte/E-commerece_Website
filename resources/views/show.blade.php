@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p><strong>Prix :</strong> {{ number_format($product->price, 2) }} €</p>
    <p><strong>Stock :</strong> {{ $product->stock }}</p>

    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" width="200">
    @endif

    <div class="mt-3">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</div>
@endsection

